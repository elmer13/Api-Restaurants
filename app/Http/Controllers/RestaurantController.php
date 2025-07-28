<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurants = Restaurant::orderBy('id','desc')->get();
        return view('restaurants.index', compact('restaurants'));   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:20'
        ]);

        $restaurant = Restaurant::create($validated);
        return redirect('/api/restaurants');
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        return view('restaurants.show', compact('restaurant'));   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        return view('restaurants.edit', compact('restaurant'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $validated = $request->validate([
            'name' => 'string',
            'address' => 'string',
            'phone' => 'nullable|string|max:20'
        ]);

        $restaurant->update($validated);
        return redirect("/api/restaurants/{$restaurant->id}");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return redirect('/api/restaurants');
    }
}
