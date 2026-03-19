@extends('layouts.app')

@section('title', 'Категории')

@section('content')
    <h1>Категории</h1>

    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-16">Добавить категорию</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Описание</th>
                <th>Родительская</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>{{ $category->parent->name ?? '—' }}</td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary btn-sm">Редактировать</a>
                        <form action="{{ route('admin.categories.delete', $category) }}" method="POST" class="inline-form"
                              onsubmit="return confirm('Удалить категорию?')">
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
