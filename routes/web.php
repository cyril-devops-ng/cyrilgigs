<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Listing;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//All listings
// Route::get('/listings',function(){
//     return view('listings', [
//         'listings' => Listing::all()
//     ]);
// });

//Single listings
// Route::get('/listing/{id}',function($id){
//     return view('listing',[
//         'heading'=> 'Listing '.$id,
//         'listings' => Listing::find($id)
//     ]);
// });
// Route::get('/listing/{listing}',function(Listing $listing){
//     return view('listing',[
//         'listings'=>$listing
//     ]);
// });

//common resource routes
//index - show all
//show - show single
//create - show create form
//store - save create form 
//edit - show edit form
//update - save edit form
//destroy - delete 

//Index - show all listings
Route::get('/listings', [ListingController::class, 'index']);
//Store Listing data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');
//Show single listing
Route::get('/listing/{listing}', [ListingController::class, 'show']);
//manage listings
Route::get('/listings/manage',[ListingController::class, 'manage'])->middleware('auth');
//Show create form
Route::get('/listings/create', [ListingController::class, 'create' ])->middleware('auth');
//Shohw edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');
//Updadte listing data
Route::put('/listings/{listing}', [ListingController:: class , 'update'])->middleware('auth');
//Delete listing data
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');
//show register/creeate form
Route::get('/register',[UserController::class, 'create'])->middleware('guest');
//Store new user
Route::post('/users',[UserController::class, 'store']);
//log user out
Route::post('/logout',[UserController::class, 'logout'])->middleware('auth');
//show login form
Route::get('/login',[UserController::class, 'login'])->name('login')->middleware('guest');
//login user
Route::post('/users/authenticate', [UserController::class, 'authenticate']);


Route::get('/', function () {
    return view('welcome');
});
Route::get('/hello',function(){
    return response('<h1>hello world, my name is Cyril</h1>')
    ->header('Content-Type','text/plain')
    ->header('foo','bar');
});

Route::get('/posts/{id}',function($id){
    ddd($id);
    return response('Post '.$id);
})->where( 'id' , '[0-9]+');

Route::get('/search',function(Request $request){
    return $request->name . ' in '  .$request->city;
});