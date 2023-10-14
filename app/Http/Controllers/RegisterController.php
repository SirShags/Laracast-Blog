<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //create a new user
    public function create() {
        return view('register.create');
    }

    //store the new users information
    public function store() {
        $attributes = request()->validate([
            'name' => ['required', 'max:255', 'min:3'],
            'username' => ['required', 'max:255', 'min:3'],
            'email' => ['required', 'email', 'max:255', 'min:10'],
            'password' => ['required', 'max:255', 'min:7']
        ]);

        User::create($attributes);

        return redirect('/');
    }
}
