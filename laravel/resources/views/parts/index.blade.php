@extends('layouts.app')

@section('content')
    <h1>Запчастини</h1>

    <form method="GET" action="{{ route('parts.index') }}">
        <input type="text" name="name" placeholder="Назва" value="{{ request('name') }}">
        <input type="number" name="price" placeholder="Ціна" value="{{ request('price') }}">
        <select name="itemsPerPage">
            <option value="5" {{ request('itemsPerPage') == 5 ? 'selected' : '' }}>5</option>
            <option value="10" {{ request('itemsPerPage') == 10 ? 'selected' : '' }}>10</option>
            <option value="25" {{ request('itemsPerPage') == 25 ? 'selected' : '' }}>25</option>
        </select>
        <button type="submit">Фільтрувати</button>
    </form>

    <table>
        <thead>
        <tr><th>ID</th><th>Назва</th><th>Ціна</th></tr>
        </thead>
        <tbody>
        @foreach ($parts as $part)
            <tr>
                <td>{{ $part->id }}</td>
                <td>{{ $part->name }}</td>
                <td>{{ $part->price }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $parts->appends(request()->query())->links() }}
@endsection
