<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\user\ajaxController;
use App\Http\Controllers\user\UserController;
use App\Models\Contact;

//login & register

Route::middleware(['admin_auth'])->group(function () {
    Route::redirect('/', 'loginPage');
    Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});

Route::middleware([
    'auth', 'verified',
])->group(function () {

    //Dashboard -> admin & user -> Check
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    //admin -> category
    Route::middleware(['admin_auth'])->group(function () {

        Route::group(['prefix' => 'category'], function () {
            Route::get('list', [CategoryController::class, 'list'])->name('category#list');

            //Category Create Page
            Route::get('createPage', [CategoryController::class, 'createPage'])->name('category#createPage');

            //Create Category
            Route::post('category/create', [CategoryController::class, 'create'])->name('category#create');

            //Delete Category
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');

            //Edit Category
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category#edit');

            //Update Category
            Route::post('update', [CategoryController::class, 'update'])->name('category#update');
        });

        //admin -> passwordChange
        Route::prefix('admin')->group(function () {
            //passwordChange Page
            Route::get('passwordChangePage', [AdminController::class, 'passwordChangePage'])->name('admin#passwordChangePage');

            //passwordChange
            Route::post('passwordChange', [AdminController::class, 'passwordChange'])->name('admin#passwordChange');

            //admin -> profilePage
            Route::get('profile', [AdminController::class, 'profile'])->name('profile#details');

            //EditProfile
            Route::get('editProfile', [AdminController::class, 'editProfile'])->name('edit#Profile');

            //updateProfile
            Route::post('update/{id}', [AdminController::class, 'update'])->name('admin#update');

            //admin list page
            Route::get('list', [AdminController::class, 'list'])->name('admin#list');

            //admin list delete
            Route::get('delete/{id}', [AdminController::class, 'delete'])->name('admin#delete');

            //admin change role
            Route::get('changeRole{id}', [AdminController::class, 'change'])->name('admin#changeRole');

            //admin role update
            Route::post('updateRole{id}', [AdminController::class, 'updateRole'])->name('admin#updateRole');

            //admin role change using Ajax
            Route::get('ajax/role', [AdminController::class, 'roleChange'])->name('ajax#role');
        });

        //admin -> product
        Route::prefix('product')->group(function () {
            //Product listPage
            Route::get('list', [ProductController::class, 'list'])->name('product#list');

            //create Page
            Route::get('create', [ProductController::class, 'createPage'])->name('product#createPage');

            //create Product
            Route::post('create', [ProductController::class, 'create'])->name('product#create');

            //delete Product
            Route::get('delete/{id}', [ProductController::class, 'delete'])->name('product#delete');

            //edit product
            Route::get('edit/{id}', [ProductController::class, 'edit'])->name('product#edit');

            //update product Page
            Route::get('update{id}', [ProductController::class, 'updatePage'])->name('product#updatePage');

            //update product
            Route::post('update', [ProductController::class, 'update'])->name('product#update');
        });

        Route::prefix('order')->group(function () {
            //order page
            Route::get('home', [OrderController::class, 'orderPage'])->name('order#home');
            Route::get('status', [OrderController::class, 'orderStatus'])->name('order#status');
            Route::get('change/status', [OrderController::class, 'change'])->name('change#order');
            Route::get('listInfo/{orderCode}', [OrderController::class, 'info'])->name('order#info');
        });

        Route::prefix('user')->group(function () {
            //user page
            Route::get('list', [UserController::class, 'page'])->name('user#list');
            Route::get('role/change', [UserController::class, 'roleChange'])->name('user#roleChange');
            Route::get('remove/{id}', [UserController::class, 'delete'])->name('user#remove');
            Route::get('edit/{id}', [UserController::class, 'userProfile'])->name('contact#edit');
            Route::post('update/{id}', [UserController::class, 'profile'])->name('user#updateProfile');
        });

        Route::prefix('contact')->group(function () {
            //admin read message
            Route::get('page', [ContactController::class, 'list'])->name('admin#contact');
            Route::get('message/{id}', [ContactController::class, 'delete'])->name('contact#delete');
            Route::get('read{id}', [ContactController::class, 'message'])->name('contact#readMessage');
        });
    });

    Route::middleware('user_auth')->group(function () {

        Route::prefix('user')->group(function () {
            //user -> home
            Route::get('home', [UserController::class, 'home'])->name('user#home');

            //category filter
            Route::get('filter{id}', [UserController::class, 'filter'])->name('user#filter');

            //user order history page
            Route::get('history', [UserController::class, 'history'])->name('order#history');
        });

        //pizza -> details
        Route::prefix('pizza')->group(function () {
            Route::get('details/{id}', [UserController::class, 'detail'])->name('user#details');
            Route::get('cartList', [UserController::class, 'List'])->name('cart#List');
        });

        Route::prefix('password')->group(function () {
            //password -> password change page
            Route::get('change', [UserController::class, 'changePage'])->name('password#changePage');

            //password change
            Route::post('change', [UserController::class, 'passwordChange'])->name('password#change');
        });

        Route::prefix('account')->group(function () {
            //user -> account page
            Route::get('profile', [UserController::class, 'details'])->name('user#profile');

            //account update
            Route::post('update/{id}', [UserController::class, 'update'])->name('account#update');
        });

        //Ajax Product
        Route::prefix('ajax')->group(function () {
            Route::get('pizza', [ajaxController::class, 'list'])->name('pizza#list');
            Route::get('cart', [ajaxController::class, 'addCart'])->name('cart#add');
            Route::get('checkout', [ajaxController::class, 'checkout'])->name('order#checkout');
            Route::get('clear/cart', [ajaxController::class, 'clear'])->name('clear#cart');
            Route::get('current/clear', [ajaxController::class, 'clearCurrentProduct'])->name('current#clear');
            Route::get('view', [ajaxController::class, 'count'])->name('ajax#viewCount');
        });

        //user->contact
        Route::prefix('contact')->group(function () {
            Route::get('user', [ContactController::class, 'page'])->name('user#contactPage');
            Route::post('message/{id}', [ContactController::class, 'sendMessage'])->name('contact#message');
        });
    });
});
