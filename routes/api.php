<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/posts/{id}',function($id){
    return response()->json([
        'posts' => [
            [
                'title' => 'Post ' .  ( new NumberFormatter( "en", NumberFormatter::SPELLOUT ))->format( $id ) 
            ]
        ]
    ]);
})->where('id', '[0-9]+');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});