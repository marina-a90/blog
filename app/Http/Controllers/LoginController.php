<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function logout() 
    {
        auth()->logout();
        return redirect()->route('posts.index');
    }

    public function create() 
    {
        return view('auth.login');
    }

    public function store(Request $request) 
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!auth()->attempt($request->only(['email', 'password']))) {
            return redirect()->back()->withErrors([
                'message' => 'Wrong login credentials.'
            ]);
        }
        return redirect()->route('posts.index');
    }

}
