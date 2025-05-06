<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'number_plate' => 'required|string|max:20|unique:cars,number_plate',
            // додай інші поля за потребою
        ]);

        Car::create($request->all());

        return redirect()->route('cars.index')->with('success', 'Авто додано!');
    }

    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'number_plate' => 'required|string|max:20|unique:cars,number_plate,' . $car->id,
        ]);

        $car->update($request->all());

        return redirect()->route('cars.index')->with('success', 'Авто оновлено!');
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Авто видалено!');
    }
}
