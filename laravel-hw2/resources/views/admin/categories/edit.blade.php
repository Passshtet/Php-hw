@extends('layouts.app')

@section('title', 'Редактировать категорию')

@section('content')
    <h1>Редактировать категорию</h1>

    <form method="POST" action="{{ route('admin.categories.update', $category) }}" style="max-width: 500px;">
        @csrf
        @method('PUT')

        <label for="name">Название</label>
        <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required>

        <label for="description">Описание</label>
        <textarea name="description" id="description">{{ old('description', $category->description) }}</textarea>

        <label for="parent_id">Родительская категория</label>
        <select name="parent_id" id="parent_id">
            <option value="">— нет —</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{ $category->parent_id == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>

        <div class="mt-16">
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="{{ route('admin.categories') }}">Отмена</a>
        </div>
    </form>
@endsection
