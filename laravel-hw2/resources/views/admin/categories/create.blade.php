@extends('layouts.app')

@section('title', 'Новая категория')

@section('content')
    <h1>Новая категория</h1>

    <form method="POST" action="{{ route('admin.categories.store') }}" style="max-width: 500px;">
        @csrf

        <label for="name">Название</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>

        <label for="description">Описание</label>
        <textarea name="description" id="description">{{ old('description') }}</textarea>

        <label for="parent_id">Родительская категория</label>
        <select name="parent_id" id="parent_id">
            <option value="">— нет —</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>

        <div class="mt-16">
            <button type="submit" class="btn btn-primary">Создать</button>
            <a href="{{ route('admin.categories') }}">Отмена</a>
        </div>
    </form>
@endsection
