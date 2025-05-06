@extends('layouts.app')

@section('content')
    <h1>Ремонти</h1>

    <form method="GET" action="{{ route('repairs.index') }}">
        <input type="number" name="client_id" placeholder="Клієнт ID" value="{{ request('client_id') }}">
        <input type="text" name="description" placeholder="Опис" value="{{ request('description') }}">
        <input type="date" name="repair_date" value="{{ request('repair_date') }}">
        <select name="itemsPerPage">
            <option value="5" {{ request('itemsPerPage') == 5 ? 'selected' : '' }}>5</option>
            <option value="10" {{ request('itemsPerPage') == 10 ? 'selected' : '' }}>10</option>
            <option value="25" {{ request('itemsPerPage') == 25 ? 'selected' : '' }}>25</option>
        </select>
        <button type="submit">Фільтрувати</button>
    </form>

    <table>
        <thead>
        <tr><th>ID</th><th>Клієнт ID</th><th>Опис</th><th>Дата</th></tr>
        </thead>
        <tbody>
        @foreach ($repairs as $repair)
            <tr>
                <td>{{ $repair->id }}</td>
                <td>{{ $repair->client_id }}</td>
                <td>{{ $repair->description }}</td>
                <td>{{ $repair->repair_date }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $repairs->appends(request()->query())->links() }}
@endsection
