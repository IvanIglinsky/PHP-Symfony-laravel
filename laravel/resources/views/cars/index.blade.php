@extends('layouts.app')

@section('content')
    <h1>Авто</h1>

    <form method="GET" action="{{ route('cars.index') }}">
        <input type="text" name="brand" placeholder="Марка" value="{{ request('brand') }}">
        <input type="text" name="model" placeholder="Модель" value="{{ request('model') }}">
        <input type="text" name="license_plate" placeholder="Номер" value="{{ request('license_plate') }}">
        <select name="itemsPerPage">
            <option value="5" {{ request('itemsPerPage') == 5 ? 'selected' : '' }}>5</option>
            <option value="10" {{ request('itemsPerPage') == 10 ? 'selected' : '' }}>10</option>
            <option value="25" {{ request('itemsPerPage') == 25 ? 'selected' : '' }}>25</option>
        </select>
        <button type="submit">Фільтрувати</button>
    </form>

    <table>
        <thead>
        <tr><th>ID</th><th>Марка</th><th>Модель</th><th>Номер</th></tr>
        </thead>
        <tbody>
        @foreach ($cars as $car)
            <tr>
                <td>{{ $car->id }}</td>
                <td>{{ $car->brand }}</td>
                <td>{{ $car->model }}</td>
                <td>{{ $car->license_plate }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $cars->appends(request()->query())->links() }}
@endsection
