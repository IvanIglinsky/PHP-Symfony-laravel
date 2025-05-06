@extends('layouts.app')

@section('content')
    <h1>Клієнти</h1>

    <form method="GET" action="{{ route('clients.index') }}">
        <input type="text" name="name" placeholder="Ім’я" value="{{ request('name') }}">
        <input type="text" name="phone" placeholder="Телефон" value="{{ request('phone') }}">
        <input type="text" name="email" placeholder="Email" value="{{ request('email') }}">
        <select name="itemsPerPage">
            <option value="5" {{ request('itemsPerPage') == 5 ? 'selected' : '' }}>5</option>
            <option value="10" {{ request('itemsPerPage') == 10 ? 'selected' : '' }}>10</option>
            <option value="25" {{ request('itemsPerPage') == 25 ? 'selected' : '' }}>25</option>
        </select>
        <button type="submit">Фільтрувати</button>
    </form>

    <table>
        <thead>
        <tr>
            <th>ID</th><th>Ім’я</th><th>Телефон</th><th>Email</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($clients as $client)
            <tr>
                <td>{{ $client->id }}</td>
                <td>{{ $client->name }}</td>
                <td>{{ $client->phone }}</td>
                <td>{{ $client->email }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $clients->appends(request()->query())->links() }}
@endsection
