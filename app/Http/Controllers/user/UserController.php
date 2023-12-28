<?php

namespace App\Http\Controllers\user;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //redirect user home page
    public function home()
    {
        $category = Category::get();
        $product = Product::orderBy('created_at', 'desc')->paginate(6);
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $history = Order::where('user_id', Auth::user()->id)->get();

        return view('user.main.home', compact('category', 'product', 'cart', 'history'));
    }

    //redirect password change page
    public function changePage()
    {
        return view('user.password.change');
    }

    //user password change
    public function passwordChange(Request $request)
    {
        $this->passwordChangeValidation($request);

        $userData = User::select('password')->where('id', Auth::user()->id)->first();
        $dbPassword = $userData->password;

        if (Hash::check($request->oldPassword, $dbPassword)) {
            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($request->newPassword)
            ]);

            return back()->with(['success' => 'password change success']);
        } else {

            return back()->with(['Error' => 'Check your Password again']);
        }
    }

    //redirect user account page
    public function details()
    {
        return view('user.profile.account');
    }

    //user account update
    public function update(Request $request, $id)
    {
        $this->AccountUpdateValidation($request);
        $data = $this->userAccountUpdate($request);

        if ($request->hasFile('image')) {
            $oldImage = user::where('id', $id)->first(); //image check
            $oldImage = $oldImage->image;

            if ($oldImage != null) {   //delete old image
                Storage::delete('public/' . $oldImage);
            }

            $fileName = uniqid('thk_') . $request->file('image')->getClientOriginalName(); //store image
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }

        User::where('id', $id)->update($data);

        return back()->with(['success' => 'User Account updated....']);
    }

    //user account update
    private function userAccountUpdate($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'updated_at' => Carbon::now(),
        ];
    }

    //user account validation check
    private function AccountUpdateValidation($request)
    {
        validator::make($request->all(), [
            'name' => 'required|min:4',
            'email' => 'required',
            'image' => 'mimes:png,jpg,jpeg|file',
            'phone' => 'required|max:15',
            'gender' => 'required',
            'address' => 'required',
        ])->validate();
    }

    //password change validation check
    private function passwordChangeValidation($request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required|min:8',
            'newPassword' => 'required|min:8',
            'confirmPassword' => 'required|min:8|same:newPassword'
        ])->validate();
    }


    //category filter
    public function filter($filterId)
    {
        $category = Category::get();

        $product = Product::where('category_id', $filterId)->orderBy('created_at', 'desc')->paginate(4);
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $history = Order::where('user_id', Auth::user()->id)->get();

        return view('user.main.home', compact('category', 'product', 'cart', 'history'));
    }

    //pizza details
    public function detail($id)
    {
        $data = Product::where('id', $id)->first();
        $pizza = Product::get();
        return view('user.main.details', compact('data', 'pizza'));
    }

    //redirect cartList Page
    public function List()
    {
        $cartList = Cart::select('carts.*', 'products.name as pizza_name', 'products.price as pizza_price', 'products.image as pizza_image')
            ->where('carts.user_id', Auth::user()->id)
            ->leftJoin('products', 'products.id', 'carts.product_id')
            ->get();

        $subTotal = 0;
        foreach ($cartList as $L) {
            $subTotal += $L->pizza_price * $L->qty;
        };

        return view('user.main.cart', compact('cartList', 'subTotal'));
    }

    //redirect order history page
    public function history()
    {
        $history = Order::where('user_id', Auth::user()->id)->paginate('4');

        return view('user.main.history', compact('history'));
    }

    //direct user list page
    public function page()
    {
        $userData = User::where('role', 'user')->get();

        return view('admin.user.list', compact('userData'));
    }

    //User role change
    public function roleChange(Request $request)
    {

        User::where('id', $request->userId)->update([
            'role' => $request->currentRole
        ]);
    }

    //delete user
    public function delete($id)
    {
        User::where('id', $id)->delete();
        return back();
    }

    //user profile edit
    public function userProfile($id)
    {
        $profile = User::where('role', 'user')->where('id', $id)->get();

        return view('admin.user.userEdit', compact('profile'));
    }

    //user profile update
    public function profile($id, Request $request)
    {
        $this->userProfileValidationCheck($request);
        $data = $this->userProfileUpdate($request);

        //user profile photo update
        if ($request->hasFile('image')) {
            $dbImage = User::where('id', $id)->first(); //check db image
            $dbImage = $dbImage->image;

            if ($dbImage != null) {
                Storage::delete('public/' . $dbImage);  //delete old image
            }

            $fileName = uniqid('user_') . $request->file('image')->getClientOriginalName();  //save new image
            $request->file('image')->storeAs('public', $fileName);

            $data['image'] = $fileName;
        }

        User::where('id', $id)->update($data);

        return redirect()->route('user#list');
    }


    //user profile Validation Check
    private function userProfileValidationCheck($request)
    {
        Validator::make(request()->all(), [

            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'image' => 'mimes:png,jpg,jpeg|file:200',

        ], [
            'name.required' => 'Please...Fill your name',
            'email.required' => 'Please....Fill your email',
            'phone.required' => 'Please...Fill your phone',
            'address.required' => 'Please...Fill your address'

        ])->validate();
    }

    //user profile update data
    private function userProfileUpdate($request)
    {
        return [

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ];
    }
}
