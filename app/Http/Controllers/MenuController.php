<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Menu::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'ingredients' => 'string|nullable',
            'price' => 'required|numeric|between:1,99999.99',
            'image' => 'nullable|image'
        ]);
    
        // Set default value for 'ingredients' if it's null
        if (empty($validatedData['ingredients'])) {
            $validatedData['ingredients'] = "Made with eggs, lettuce, salt, oil and other ingredients.";
        }
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validatedData['image'] = 'images/' . $imageName;
        } else {
            $validatedData['image'] = 'images/600x400.png';
        }
    
        // Create the menu item
        $menu = Menu::create($validatedData);
    
        return response()->json(["msg" => "Menu Item Added Successfully", "Menu Item" => $menu], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Menu::where('id', $id)->first();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return response()->json(["msg"=>"Menu Item Deleted Successfully"], 200);
    }
}




//