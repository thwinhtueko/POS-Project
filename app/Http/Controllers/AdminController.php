<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    //redirect passwordChange Page
    public function passwordChangePage()
    {
        return view('admin.account.passwordChange');
    }

    //password Change
    public function passwordChange(Request $request)
    {
        $this->passwordChangeValidation($request);
        $data = User::select('password')->where('id', Auth::user()->id)->first();

        $dbPassword = $data->password;

        if (Hash::check($request->oldPassword, $dbPassword)) {
            user::where('id', Auth::user()->id)->update([
                'password' => Hash::make($request->newPassword)
            ]);

            return back()->with(['success' => 'password change success']);
        } else {
            return back()->with(['ErrorMessage' => 'Check your Password again']);
        }
    }

    //Validation Check
    private function passwordChangeValidation($request)
    {
        Validator::make($request->all(), [
            'oldPassword' => 'required|min:8',
            'newPassword' => 'required|min:8',
            'confirmPassword' => 'required|min:8|same:newPassword'
        ])->validate();
    }


    //redirect adminProfile page
    public function profile()
    {
        return view('admin.account.adminProfile');
    }

    //redirect admin list page
    public function list()
    {
        $admin = User::when('Key', function ($query) {
            $query->orWhere('name', 'like', '%' . request('Key') . '%');
        })
            ->where('role', 'admin')
            ->orderBy('name', 'asc')->paginate(3);

        $admin->appends(request()->all());
        return view('admin.account.list', compact('admin'));
    }

    //admin list delete
    public function delete($id)
    {
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Admin Account deleted....']);
    }

    //redirect admin change role page
    public function change($id)
    {
        $roleData = User::where('id', $id)->first();

        return view('admin.account.change', compact('roleData'));
    }

    //role update
    public function updateRole(Request $request, $id)
    {

        $roleData = $this->updateRoleData($request);
        User::where('id', $id)->update($roleData);
        return redirect()->route('admin#list');
    }

    //private role update
    private function updateRoleData($request)
    {
        return [
            'role' => $request->role
        ];
    }

    //redirect EditProfile Page
    public function editProfile()
    {
        return view('admin.account.editProfile');
    }

    //Update Profile
    public function update($id, Request $request)
    {
        $this->accountUpdateValidation($request);

        $data = $this->accountUpdate($request);

        //for Image
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

        user::where('id', $id)->update($data);

        return redirect()->route('profile#details')->with(['successMessage' => 'Update Profile Success']);
    }


    //Role change using ajax
    public function roleChange(Request $request)
    {
        User::where('id', $request->roleId)->update([
            'role' => $request->currentRole
        ]);
    }

    //account update validation check
    private function accountUpdateValidation($request)
    {
        Validator::make($request->all(), [
            'name' => 'required|min:4',
            'email' => 'required',
            'image' => 'mimes:png,jpg,jpeg|file',
            'phone' => 'required|max:15',
            'gender' => 'required',
            'address' => 'required',
        ])->validate();
    }

    //account update
    private function accountUpdate($request)
    {
        return  [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'updated_at' => Carbon::now(),
        ];
    }
}
