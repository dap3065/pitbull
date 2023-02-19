<?php

namespace App\Http\Controllers;

use App\Service;
use App\User;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('service.index', ['services' => Service::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /** @var User $user */
        $user = auth()->user();
        if (!$user->hasRole('Admin')) {
            return redirect()->route('services');
        }
        $service = new Service();
        return view('service.create', ['service' => $service]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /** @var User $user */
        $user = auth()->user();
        if (!$user->hasRole('Admin')) {
            return redirect()->route('services');
        }
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ]);

        $input = $request->all();
        $input['description'] = trim($input['description']);
        $service = Service::create($input);
        return back()->with('success', 'Service added successfully!')
            ->with(['service' => $service]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view('service.show', ['service' => $service]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        return view('service.create', ['service' => $service]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ]);

        $input = $request->all();
        $input['description'] = trim($input['description']);
        $service->update($input);
        return back()->with('success', 'Service updated successfully!')
            ->with(['service' => $service]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {

        $service->delete();
        return redirect()->route('services');
    }
}
