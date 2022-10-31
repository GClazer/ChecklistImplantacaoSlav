<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User;
use Error;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('auth.user');
    }

    public function login(Request $request)
    {

        try {
            Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        } catch (\Throwable $th) {
            report($th);
            return false;
        }
            

    }

    public function store(Request $request)
    {

        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        
        User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
            ]
        );
    }

    public function logout(){

        if(Auth::check()){
            Auth::logout();
        }

        return redirect('/');

    }
}
