<?php

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
Route::get('/listings',function(){
    return view('listings', [
        'heading' => 'Latest listings',
        'listings' => Listing::all()
    ]);
});

//Single listings
Route::get('/listing/{id}',function($id){
    return view('listing',[
        'heading'=> 'Listing '.$id,
        'listings' => Listing::find($id)
    ]);
});

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