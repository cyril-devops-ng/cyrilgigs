<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //show register/create form
    public function create(){
        return view('users.register');
    }
    //store new users
    /**
     * Summary of store
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function store(Request $request){
        $formFields = $request->validate(
            [
                'name'=> ['required' , 'min:3'],
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'password'=> 'required|confirmed|min:6'
            ]
        );

        //hash password
        $formFields['password'] = bcrypt($formFields['password']);

        //create user
        $user = User::create($formFields);

        //login
        auth()->login($user);

        return redirect('/listings')->with('message', 'User created and logged in');
    }

    //logout user
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/listings')->with('message','You have been logged out');
    }

    //show login formr
    public function login(Request $request){
        return view('users.login');
    }

    //Authenticate user
    public function authenticate(Request $request){
        $formFields = $request->validate(
            [
                'email' => ['required', 'email'],
                'password'=> 'required'
            ]
        );

        //hash password
        // $formFields['password'] = bcrypt($formFields['password']);

        //login
        if(auth()->attempt($formFields)){
            $request->session()->regenerate();
            return redirect('/listings')->with('message', 'You are now logged in');
        }else{
            return back()->withErrors(['email'=>'Invalid credentials'])->onlyInput('email');
        }
        
    }

}
