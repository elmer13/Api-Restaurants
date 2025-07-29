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

        if ($this->isApiRequest()) {
            return response()->json($restaurants);
        }

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
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:20|regex:/^\+?[0-9\s\-]+$/'
        ],[
            'name.required' => 'The restaurant name is required',
            'address.required' => 'The address is required',
            'phone.max' => 'The phone number must not exceed 20 characters',
            'phone.regex' => 'The phone number must start with + followed by numbers, or just numbers'
        ]);

       $restaurant = Restaurant::create($request->all());

        if ($this->isApiRequest()) {
            return response()->json([
                'message' => 'Restaurant successfully created for API',
                'data' => $restaurant
            ], 201);
        }


        return redirect()->route('restaurants.index')->with('success', 'Restaurant successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        if ($this->isApiRequest()) {
            return response()->json($restaurant);
        }
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
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:20|regex:/^\+?[0-9\s\-]+$/'
        ],[
            'name.required' => 'The restaurant name is required',
            'address.required' => 'The address is required',
            'phone.max' => 'The phone number must not exceed 20 characters',
            'phone.regex' => 'The phone number must start with + followed by numbers, or just numbers'
        ]);

        $restaurant->update($request->all());

        if ($this->isApiRequest()) {
            return response()->json([
                'message' => 'Restaurant successfully updated for API',
                'data' => $restaurant
            ], 201);
        }

        return redirect()->route('restaurants.show', $restaurant)->with('success', 'Restaurant successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();

        if ($this->isApiRequest()) {
            return response()->json(['message' => 'Restaurant deleted']);
        }
        
        return redirect()->route('restaurants.index');
    }

    protected function isApiRequest()
    {
        return request()->wantsJson() || request()->is('api/*') || strpos(request()->getRequestUri(), '/api/') === 0;
    }      
}
