<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Carbon\Carbon;

class RouteController extends Controller
{
    //For Api
    public function Api()
    {
        $category = Category::get();
        $product = Product::get();
        $user = User::get();
        $order = Order::get();
        $contact = Contact::get();

        $data = [
            'product' => $product,
            'category' => $category,
            'user' => $user,
            'order' => $order,
            'contact' => $contact
        ];

        return response()->json($data, 200);
    }

    //POST
    //category List
    public function CategoryList()
    {
        $category = Category::get();

        return response()->json($category, 200);
    }

    //create category
    public function categoryCreate(Request $request)
    {
        $data = $this->createCategory($request);

        $response = Category::create($data);
        Category::get();

        return response()->json($response, 200);
    }

    private function createCategory(Request $request)
    {
        return [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'update_at' => Carbon::now(),
        ];
    }


    //contact list
    public function contactList()
    {
        $contact = Contact::get();

        return response()->json($contact, 200);
    }

    //create contact
    public function contactCreate(Request $request)
    {
        $data = $this->createContact($request);

        $response = Contact::create($data);

        return response()->json($response, 200);
    }

    private function createContact($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];
    }


    //Delete Category
    public function categoryDelete($id)
    {
        $data = Category::where('id', $id)->first();

        if (isset($data)) {
            Category::where('id', $id)->delete();

            return response()->json(['status' => true, 'message' => 'delete success', 'delete data' => $data], 200);
        }
        return response()->json(['status' => false, 'message' => 'Wrong Category ID'], 500);
    }

    //edit category
    public function editCategory(Request $request)
    {
        $data = Category::where('id', $request->category_id)->first();

        if (isset($data)) {
            Category::where('id', $request->category_id)->first();

            return response()->json(['Data' => $data, 'status' => true], 200);
        }

        return response()->json(['status' => false, 'message' => 'Wrong Category ID'], 500);
    }


    //category update
    public function categoryUpdate(Request $request)
    {
        $data = Category::where('id', $request->category_id)->first();

        if (isset($data)) {
            Category::where('id', $request->category_id)->first();
            
            $updateData = $this->UpdateCategory($request);
            Category::where('id', $request->category_id)->update($updateData);

            return response()->json(['status' => true, 'data' => $updateData, 'message' => 'category update success'], 200);
        }

        return response()->json(['status' => false, 'message' => 'Wrong Category ID'], 500);
    }

    //update category
    private function UpdateCategory($request)
    {
        return [
            'name' => $request->name,
        ];
    }
}
