<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{
    public function index()
    {
        $dishes = Dish::all();
        return view('admin.dishes.index', compact('dishes'));
    }

    public function create()
    {
        return view('admin.dishes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_available' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('dishes', 'public');
            $validated['image'] = $imagePath;
        }

        Dish::create($validated);

        return redirect()->route('admin.dishes.index')->with('success', 'Dish created successfully');
    }

    public function edit(Dish $dish)
    {
        return view('admin.dishes.edit', compact('dish'));
    }

    public function update(Request $request, Dish $dish)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_available' => 'boolean'
        ]);

        if ($request->hasFile('image')) {
            if ($dish->image) {
                Storage::disk('public')->delete($dish->image);
            }
            $imagePath = $request->file('image')->store('dishes', 'public');
            $validated['image'] = $imagePath;
        }

        $dish->update($validated);

        return redirect()->route('admin.dishes.index')->with('success', 'Dish updated successfully');
    }

    public function toggleAvailability(Dish $dish)
    {
        $dish->update(['is_available' => !$dish->is_available]);
        return back()->with('success', 'Dish availability updated successfully');
    }

    public function destroy(Dish $dish)
    {
        // Delete the dish image if it exists
        if ($dish->image) {
            Storage::disk('public')->delete($dish->image);
        }
        
        // Delete the dish
        $dish->delete();
        
        return redirect()->route('admin.dishes.index')
            ->with('success', 'Dish deleted successfully');
    }
} 