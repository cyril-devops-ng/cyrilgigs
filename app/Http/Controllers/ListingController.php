<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //Show all listinigs
    public function index(){
        //dd(request('tag'));
        return view('listings.index', [
            // 'listings' => Listing::latest()->filter(request(['tag' , 'search']))->get()
            // 'listings' => Listing::latest()->filter(request(['tag' , 'search']))->simplePaginate(2)
            'listings' => Listing::latest()->filter(request(['tag' , 'search']))->paginate(2)

        ]);
    }

    //show single listing
    public function show(Listing $listing){
        return view('listings.show',[
            'listings'=>$listing
        ]);
    }

    //show creeate form
    public function create(){
        return view('Listings.create');
    }

    //store listing data
    public function store(Request $request){
        // dd($request->all());
        $formFields = $request->validate([
            'title'=>'required',
            'company' => ['required', Rule::unique('Listings','company')],
            'location' => 'required',
            'website' => 'required',
            'email'=>['required', 'email'],
            'tags'=>'required',
            'description'=>'required'
        ]
        );

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
            // dd($formFields);
        }

        $formFields['user_id'] = auth()->id();
        Listing::create($formFields);

        return redirect('/listings')->with('message','Listing created succsssfully');
    }

    //show edit form
    public function edit(Listing $listing){
        // dd($listing);
        return view('Listings.edit', ['listing'=>$listing]);
    }

    //update listing data
    public function update(Request $request, Listing $listing){
        // dd($request->all());
        //check logged in user is owner
        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }
        $formFields = $request->validate([
            'title'=>'required',
            'company' => ['required',],
            'location' => 'required',
            'website' => 'required',
            'email'=>['required', 'email'],
            'tags'=>'required',
            'description'=>'required'
        ]
        );

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
            // dd($formFields);
        }
        $listing->update($formFields);

        return back()->with('message','Listing updated succsssfully');
    }

    //Delete listing data
    public function destroy(Listing $listing){
        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }
        $listing->delete();

        return redirect('/listings')->with('message', 'Listing deleted successfully!');
    }

    //manage listing
    public function manage(){
        return view('Listings.manage',[
            'listings' => auth()->user()->listings()->get()
        ]);
    }
}
