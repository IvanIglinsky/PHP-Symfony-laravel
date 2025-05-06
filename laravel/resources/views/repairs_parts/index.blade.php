@extends('layouts.app')

@section('content')
    <h1>Запчастини в ремонті</h1>

    <form method="GET" action="{{ route('repair_parts.index') }}">
        <input type="number" name="repair_id" placeholder="Repair ID" value="{{ request('repair_id') }}">
        <input type="number" name="part_id" placeholder="Part ID" value="{{ request('part_id') }}">
        <input type="number" name="quantity" placeholder="Кількість" value="{{ request('quantity') }}">
        <select name="itemsPerPage">
            <option value="5" {{ request('itemsPerPage') == 5 ? 'selected' : '' }}>5</option>
            <option value="10" {{ request('itemsPerPage') == 10 ? 'selected' : '' }}>10</option>
            <option value="25" {{ request('itemsPerPage') == 25 ? 'selected' : '' }}>25</option>
        </select>
        <button type="submit">Фільтрувати</button>
    </form>

    <table>
        <thead>
        <tr><th>ID</th><th>Repair ID</th><th>Part ID</th><th>Кількість</th></tr>
        </thead>
        <tbody>
        @foreach ($repairParts as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->repair_id }}</td>
                <td>{{ $item->part_id }}</td>
                <td>{{ $item->quantity }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $repairParts->appends(request()->query())->links() }}
@endsection
