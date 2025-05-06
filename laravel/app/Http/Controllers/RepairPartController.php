<?php

namespace App\Http\Controllers;

use App\Models\RepairPart;
use Illuminate\Http\Request;

class RepairPartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $itemsPerPage = $request->input('itemsPerPage', 10);

        $query = \App\Models\RepairPart::query();

        if ($request->filled('repair_id')) {
            $query->where('repair_id', $request->repair_id);
        }
        if ($request->filled('part_id')) {
            $query->where('part_id', $request->part_id);
        }
        if ($request->filled('quantity')) {
            $query->where('quantity', $request->quantity);
        }

        $repairParts = $query->paginate($itemsPerPage)->appends($request->all());

        return view('repair_parts.index', compact('repairParts', 'itemsPerPage'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('repairParts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Валідація вхідних даних
        $request->validate([
            'repair_id' => 'required|exists:repairs,id',  // Припускаємо, що є зв'язок з ремонтом
            'part_name' => 'required|string',
            'quantity' => 'required|numeric|min:1',
            'cost' => 'required|numeric|min:0',
        ]);

        // Створення нового запису
        RepairPart::create($request->all());

        return redirect()->route('repairParts.index')->with('success', 'Запчастина додана до ремонту!');
    }

    /**
     * Display the specified resource.
     */
    public function show(RepairPart $repairPart)
    {
        return view('repairParts.show', compact('repairPart'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RepairPart $repairPart)
    {
        return view('repairParts.edit', compact('repairPart'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RepairPart $repairPart)
    {
        // Валідація вхідних даних
        $request->validate([
            'repair_id' => 'required|exists:repairs,id',
            'part_name' => 'required|string',
            'quantity' => 'required|numeric|min:1',
            'cost' => 'required|numeric|min:0',
        ]);

        // Оновлення запису
        $repairPart->update($request->all());

        return redirect()->route('repairParts.index')->with('success', 'Запчастина оновлена!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RepairPart $repairPart)
    {
        $repairPart->delete();

        return redirect()->route('repairParts.index')->with('success', 'Запчастина видалена!');
    }
}
