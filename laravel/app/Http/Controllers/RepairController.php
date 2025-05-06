<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use Illuminate\Http\Request;

class RepairController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $repairs = Repair::all();
        return view('repairs.index', compact('repairs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('repairs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Валідація вхідних даних
        $request->validate([
            'client_id' => 'required|exists:clients,id', // Припускаємо, що є зв'язок з клієнтом
            'car_id' => 'required|exists:cars,id',       // І зв'язок з машиною
            'description' => 'required|string',
            'cost' => 'required|numeric|min:0',
            'repair_date' => 'required|date',
        ]);

        // Створення нового запису
        Repair::create($request->all());

        return redirect()->route('repairs.index')->with('success', 'Ремонт доданий!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Repair $repair)
    {
        return view('repairs.show', compact('repair'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Repair $repair)
    {
        return view('repairs.edit', compact('repair'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Repair $repair)
    {
        // Валідація вхідних даних
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'car_id' => 'required|exists:cars,id',
            'description' => 'required|string',
            'cost' => 'required|numeric|min:0',
            'repair_date' => 'required|date',
        ]);

        // Оновлення запису
        $repair->update($request->all());

        return redirect()->route('repairs.index')->with('success', 'Ремонт оновлений!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Repair $repair)
    {
        $repair->delete();

        return redirect()->route('repairs.index')->with('success', 'Ремонт видалено!');
    }
}
