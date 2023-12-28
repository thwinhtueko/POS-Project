<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //category -> list
    public function list()
    {
        $Categories = Category::when(request('Key'), function ($query) {
            $query->where('name', 'like', '%' . request('Key') . '%');
        })->orderBy('id', 'desc')->paginate(4);
        return view('admin.category.list', compact('Categories'));
    }

    //redirect category page
    public function createPage()
    {
        return view('admin.category.create');
    }

    //Create Category Page
    public function create(Request $request)
    {
        $this->categoryValidationCheck($request);
        //create Data
        $data = $this->requestCategoryData($request);
        Category::create($data);

        return redirect()->route('category#list');
    }

    //Delete Category
    public function delete($id)
    {
        Category::where('id', $id)->delete();
        return back();
    }

    //Category Edit
    public function edit($id)
    {
        $Category = Category::where('id', $id)->first();
        return view('admin.category.edit', compact('Category'));
    }

    //Category Update
    public function update(Request $request)
    {
        $this->categoryValidationCheck($request);
        //create Data
        $data = $this->requestCategoryData($request);
        Category::where('id', $request->categoryId)->update($data);
        return redirect()->route('category#list');
    }


    //Category Validation Check
    private function categoryValidationCheck($request)
    {
        Validator::make($request->all(), [
            'categoryName' => 'required|unique:categories,name,' . $request->categoryId
        ], [
            'categoryName.required' => 'add your category',
            'category.unique' => 'your category is already have been taken'
        ])->validate();
    }

    //create category item
    private function requestCategoryData($request)
    {
        return  [
            'name' => $request->categoryName
        ];
    }
}
