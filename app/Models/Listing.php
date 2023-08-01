<?php
namespace App\Models;

class Listing{
    public static function all(){
        return [
            [
                'id' => 1,
                'title'=>'Title one',
                'description'=>'Description one'
            ],
            [
                'id' => 2,
                'title'=>'Title two',
                'description'=>'Description two'
            ]
            ];
    }

    public static function find($id){
        $listings = self::all();
        foreach ($listings as $listing) {
            if($listing['id'] == $id){
                return $listing;
            }
        }
    }
}