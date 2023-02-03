<?php

namespace App\Http\Controllers;

use App\Dog;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dog.index', ['pitbulls' => Dog::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();
        if (!$user->hasRole('Admin')) {
            return redirect()->route('dogs');
        }
        return view('dog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();
        if (!$user->hasRole('Admin')) {
            return redirect()->route('pitbulls');
        }
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'type' => 'required',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:6144'
        ]);

        $imageName = time().'.'.$request->image->extension();

        // Public Folder
        $request->image->move(public_path('img'), $imageName);
        $input = $request->all();
        unset($input['image']);
        $input['image_path'] = 'img/' . $imageName;
        $pitbull = Dog::create($input);
        Log::error('dog created ' . $pitbull->id);
        return back()->with('success', 'Pitbull added successfully!')
            ->with(['image' => $imageName, 'pitbull' => $pitbull]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dog  $dog
     * @return \Illuminate\Http\Response
     */
    public function show(Dog $dog)
    {
        return view('dog.show', ['pitbull' => $dog]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dog  $dog
     * @return \Illuminate\Http\Response
     */
    public function edit(Dog $dog)
    {
        return view('dog.create', compact($dog));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dog  $dog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dog $dog)
    {
        return redirect()->route('dogs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dog  $dog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dog $dog)
    {
        return redirect()->route('dogs');
    }
}
