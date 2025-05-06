<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        // Отримати itemsPerPage з запиту або стандартне значення 10
        $itemsPerPage = $request->input('itemsPerPage', 10);

        // Отримати всі фільтри з запиту
        $query = \App\Models\Client::query();

        // Фільтрація по кожному полю
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        // Пагінація
        $clients = $query->paginate($itemsPerPage)->appends($request->all());

        return view('clients.index', compact('clients', 'itemsPerPage'));
    }


    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            // додай інші поля за потребою
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')->with('success', 'Клієнт створений!');
    }

    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')->with('success', 'Клієнт оновлений!');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Клієнт видалений!');
    }
}
