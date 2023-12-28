<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //redirect product listPage
    public function list()
    {
        $pizza = Product::select('products.*', 'categories.name as category_name')
            ->when('Key', function ($query) {
                $query->where('products.name', 'like', '%' . request('Key') . '%');
            })

            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->orderBy('products.created_at', 'desc')
            ->paginate(3);

        $pizza->appends(request()->all());
        return view('admin.product.list', compact('pizza'));
    }

    // redirect create product page
    public function createPage()
    {
        $category = Category::select('id', 'name')->get();
        return view('admin.product.create', compact('category'));
    }

    //product create
    public function create(Request $request)
    {
        $this->productValidationCheck($request, 'create');
        $data = $this->productCreate($request);

        if ($request->hasFile('image')) {

            $fileName = uniqid('pizza_') . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);

            $data['image'] = $fileName;
        }

        product::create($data);

        return redirect()->route('product#list');
    }

    //private product create
    private function productCreate(Request $request)
    {
        return [
            'category_id' => $request->category,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'waiting_time' => $request->waitingTime,
        ];
    }

    //product delete
    public function delete($id)
    {
        Product::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Product Delete Success..']);
    }

    //product edit
    public function edit($id)
    {
        $product = product::select('products.*', 'categories.name as category_name')
            ->leftJoin('categories', 'products.category_id', 'categories.id')
            ->where('products.id', $id)->first();
        return view('admin.product.edit', compact('product'));
    }

    //product update Page
    public function updatePage($id)
    {
        $upProduct = Product::where('id', $id)->first();
        $category = Category::get();

        return view('admin.product.update', compact('upProduct', 'category'));
    }

    //product update
    public function update(Request $request)
    {
        $this->productValidationCheck($request, 'update');
        $data = $this->productCreate($request);

        if ($request->hasFile('image')) {
            $oldImage = Product::where('id', $request->pizzaId)->first(); //image check
            $oldImage = $oldImage->image;

            if ($oldImage != null) {   //delete old image
                Storage::delete('public/' . $oldImage);
            }

            $fileName = uniqid('pizza_') . $request->file('image')->getClientOriginalName(); //store image
            $request->file('image')->storeAs('public', $fileName);

            $data['image'] = $fileName;
        }

        Product::where('id', $request->pizzaId)->update($data);

        return redirect()->route('product#list');
    }

    //product Validation Check
    private function productValidationCheck($request, $action)
    {
        $ValidationRules = [
            'name' => 'required|min:5|unique:products,name,' . $request->pizzaId,
            'category' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|file',
            'price' => 'required',
            'waitingTime' => 'required'
        ];

        $ValidationRules['image'] = $action == 'create' ? 'required|mimes:png,jpg,jpeg|file' : 'mimes:png,jpg,jpeg|file';

        Validator::make($request->all(), $ValidationRules)->validate();
    }
}
