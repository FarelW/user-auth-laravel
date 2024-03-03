<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get("/", function(){
    return view("home");
})->name("home"); 

Route::get('/signup', [UserController::class,'signup'])->name('signup');
Route::post('/signup', [UserController::class,'signupPost'])->name('signup.post');

Route::get('/signin', [UserController::class,'signin'])->name('signin') ;
Route::post('/signin', [UserController::class,'signinPost'])->name('signin.post');

Route::get('/signout', [UserController::class,'signout'])->name("signout");

Route::post('/updateuser', [UserController::class,'updateuser'])->name('updateuser');

Route::fallback(function () {
    return redirect()->route('home');
});