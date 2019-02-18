<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
// use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create() 
    {
        return view('auth.register');
    }

    public function store(Request $request) 
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users,email', // email mora biti unique - proverava u users tabeli, kolonu email
            'name' => 'required',
            'password' => 'required|min:6',
            'age' => 'required|integer|min:1'
        ]);

        $data = $request->only([
            'email', 'name', 'password'
        ]);

        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        auth()->login($user);

        return redirect()->route('posts.index');
    }
}
