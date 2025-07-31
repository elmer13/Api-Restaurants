<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="API RESTful Laravel Documentation",
 *     version="1.0.0",
 *     description="Project Restaurants API Laravel 12 Documentation",
 *     @OA\Contact(
 *         email="egarciayavi@hotmail.com"
 *     )
 * )
*/
class RestaurantController extends Controller
{
    /**
    * @OA\Get(
    *     path="/api/restaurants",
    *     summary="Get all restaurants",
    *     description="Return a list of restaurants.",
    *     security={{"bearerAuth": {}}},
    *     @OA\Response(
    *         response=200,
    *         description="Restaurants List.",
    *         @OA\JsonContent(
    *             type="object",
    *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Restaurant"))
     *         )
    *     )
    * )
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
     * @OA\Post(
     *     path="/api/restaurants",
     *     summary="Create a new restaurant",
     *     description="Let create a new restaurant with the ",
     *     security={{"bearerAuth": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Restaurant")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Restaurant created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Restaurant")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     )
     * )
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
    * @OA\Get(
    *     path="/api/restaurants/{id}",
    *     summary="To get an specific restaurant",
    *     description="Return a specific restaurant using its ID",
    *     security={{"bearerAuth": {}}},
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         description="ID of the restaurant",
    *         required=true,
    *         @OA\Schema(type="integer", example=1)
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Restaurant found",
    *         @OA\JsonContent(ref="#/components/schemas/Restaurant")
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="Restaurant not found"
    *     )
    * )
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
     * @OA\Put(
     *     path="/api/restaurants/{id}",
     *     summary="Update a restaurant",
     *     description="Update a restaurant using its ID",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the restaurant",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Restaurant")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Restaurant updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Restaurant")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Restaurant not found"
     *     )
     * )
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
     * @OA\Delete(
     *     path="/api/restaurants/{id}",
     *     summary="Delete a restaurant",
     *     description="Delete a restaurant using its ID from the database",
     *     security={{"bearerAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Restaurant ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description=""
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Restaurant not found"
     *     )
     * )
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
