@extends('layouts.app')

@section('title', 'Товары')

@section('content')
    <h1>Товары</h1>

    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-16">Добавить товар</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Категория</th>
                <th>Цена</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? '—' }}</td>
                    <td>{{ number_format($product->price, 0, '.', ' ') }} руб.</td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary btn-sm">Редактировать</a>
                        <form action="{{ route('admin.products.delete', $product) }}" method="POST" class="inline-form"
                              onsubmit="return confirm('Удалить товар?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-16"><a href="{{ route('admin.dashboard') }}">← Назад</a></div>
@endsection
