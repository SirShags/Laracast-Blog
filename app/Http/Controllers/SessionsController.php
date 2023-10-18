<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create() {
        return view('sessions.create');
    }

    //login user based on user credentials then redirect with a success flash message
    public function store() {
        // validating user credentials, could also use 'exist:users,email' but it brings up a security risk
        $attributes = request()->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'max:255', 'min:7']
        ]);

        //auth failed 2 ways
        // way 1:
        // return back()
        //     ->withInput() //flashes back email to user
        //     ->withErrors(['email' => 'Your provided credentials could not be verified']); // custom error message

        //way 2:
        throw ValidationException::withMessages([
            'email' => 'Your provided credentials could not be verified'
        ]);

        // attempt to authenticate and log in the user based on provided credentials
        if(auth()->attempt($attributes)) {
            //protect against session fixation
            session()->regenerate();

            //redirect with flash message
            return redirect('/')->with('success', 'Welcome Back!');
        }
    }

    public function destroy() {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
