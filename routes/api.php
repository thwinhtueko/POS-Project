<?php

use App\Http\Controllers\API\RouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
* // get all data
* // localhost:8000/api/data/all
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//GET
Route::get('data/all', [RouteController::class, 'Api']);

/*
* // category list
* // localhost:8000/api/category/list (GET)
*
* // create category
* // localhost:8000/api/category/create (POST) in body
* // Key**
* // name => name
*
* // contact list
* // localhost:8000/api/contact/list (GET)
*
* // create contact
* // localhost:8000/api/contact/create (POST) in body
* // Key**
* // name => name, email => email, message => message
*
* // delete category
* // localhost:8000/api/category/delete/{id} (GET)
* // Key ** id => category id
*
* // details category
* // localhost:8000/api/category/edit/ (POST)
* // Key **
* // id => category_id
*
* // Update category
* // localhost:8000/api/category/update/ (POST)
* // Key **
* // id => category_id, name => name
*/

//POST
//category list & create
Route::get('category/list', [RouteController::class, 'categoryList']);
Route::post('category/create', [RouteController::class, 'categoryCreate']);

//contact list & create
Route::get('contact/list', [RouteController::class, 'contactList']);
Route::post('contact/create', [RouteController::class, 'contactCreate']);


//delete category
Route::get('category/delete/{id}', [RouteController::class, 'categoryDelete']);

//edit category
Route::post('category/edit', [RouteController::class, 'editCategory']);

//update category
Route::post('category/update', [RouteController::class, 'categoryUpdate']);
