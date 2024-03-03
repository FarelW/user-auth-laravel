<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    function signin(){
        if (Auth::check()) {
            return redirect(route("home"));
        }
        return view("signin");
    }

    function signup(){
        if (Auth::check()) {
            return redirect(route("home"));
        }
        return view("signup");
    }

    function signinPost(Request $request){
        $request->validate([
            "email"=> "required",
            "password"=> "required",
        ]);

        $credential = $request->only("email","password");
        if (Auth::attempt(($credential))) {
            return redirect()->intended(route("home"))->with("success","Signin succesful");
        }

        return redirect()->intended(route("signin"))->with("error","Signin failed");
    }

    function signupPost(Request $request){
        $request->validate([
            "email"=> "required|email|unique:users,email",
            "name"=> "required|unique:users,name",
            "password"=> "required",
            "age"=>"required|numeric",
            "phone_number" => "required|digits:12",
            "address" => "required",
        ]);

        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'age' => $request->age,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'createdAt'=>now(),
            'updatedAt'=>now(),
        ]);

        if (!$user) {
            return redirect()->intended(route("signup"))->with("error","Signup failed");
        }

        return redirect()->intended(route("signin"))->with("success","Signup succesful");
    }

    function signout(){
        Session::flush();
        Auth::logout();
        return redirect()->intended(route("home"))->with("success","Signout succesful");
    }

    function updateuser(Request $request){
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->intended(route("home"))->with("error", "User not found.");
        }

        $request->validate([
            "name"=> "required|unique:users,name,". $user->id,
            "age"=>"required|numeric",
            "phone_number" => "required|digits:12",
            "address" => "required",
        ]);
        

        $user->fill($request->all());
        $user->updatedAt = now();
        $user->save();

        return redirect()->intended(route("home"))->with("success","Update data succesful");
    }
}
