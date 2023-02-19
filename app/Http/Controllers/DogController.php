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
            return redirect()->route('pitbulls');
        }
        $dog = new Dog();
        return view('dog.create', ['pitbull' => $dog]);
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
        Log::error(ini_get('upload_max_filesize') . ' max upload size');
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'type' => 'required',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:6144'
        ]);
        Log::error('Made it pass validation');
        $imageName = time().'.'.$request->image->extension();

        // Public Folder
        $request->image->move(public_path('img'), $imageName);
        $input = $request->all();
        $input['description'] = trim($input['description']);
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
        return view('dog.create', ['pitbull' => $dog]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dog  $dog
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Dog $dog)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'type' => 'required',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:6144'
        ]);
        Log::error('Made it pass validation');
        $input = $request->all();
        $input['description'] = trim($input['description']);
        if ($request->image) {
            $imageName = time().'.'.$request->image->extension();

            // Public Folder
            $request->image->move(public_path('img'), $imageName);
            $input['image_path'] = 'img/' . $imageName;
            unlink(public_path() . '/' . $dog->image_path);
        }
        unset($input['image']);
        $pitbull = $dog->update($input);
        return redirect()->route('pitbulls')
            ->with('success', 'Pitbull updated successfully!')
            ->with(['pitbull' => $pitbull]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dog  $dog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dog $dog)
    {
        unlink(public_path() . '/' . $dog->image_path);
        $dog->delete();
        return redirect()->route('dogs');
    }
}
