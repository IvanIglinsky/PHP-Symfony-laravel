<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Illuminate\Http\Request;

class PartController extends Controller
{
    public function index()
    {
        $parts = Part::all();
        return view('parts.index', compact('parts'));
    }

    public function create()
    {
        return view('parts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
        ]);

        Part::create($request->all());

        return redirect()->route('parts.index')->with('success', 'Запчастина додана!');
    }

    public function show(Part $part)
    {
        return view('parts.show', compact('part'));
    }

    public function edit(Part $part)
    {
        return view('parts.edit', compact('part'));
    }

    public function update(Request $request, Part $part)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
        ]);

        $part->update($request->all());

        return redirect()->route('parts.index')->with('success', 'Запчастина оновлена!');
    }

    public function destroy(Part $part)
    {
        $part->delete();
        return redirect()->route('parts.index')->with('success', 'Запчастина видалена!');
    }
}
