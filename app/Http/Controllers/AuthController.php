<?php

namespace App\Http\Controllers;

use PDO;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //redirect login
    public function loginPage()
    {
        return view('login');
    }

    // redirect register
    public function registerPage()
    {
        return view('register');
    }

    //redirect dashboard check user & admin
    public function dashboard()
    {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('category#list');
        }
        return redirect()->route('user#home');
    }
}
