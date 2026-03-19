@extends('layouts.app')

@section('title', 'Новый товар')

@section('content')
    <h1>Новый товар</h1>

    <form method="POST" action="{{ route('admin.products.store') }}" style="max-width: 500px;">
        @csrf

        <label for="name">Название</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>

        <label for="description">Описание</label>
        <textarea name="description" id="description">{{ old('description') }}</textarea>

        <label for="price">Цена (руб.)</label>
        <input type="number" name="price" id="price" step="0.01" min="0" value="{{ old('price') }}" required>

        <label for="category_id">Категория</label>
        <select name="category_id" id="category_id" required>
            <option value="">— выберите —</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>

        <label for="image_url">Ссылка на изображение</label>
        <input type="text" name="image_url" id="image_url" value="{{ old('image_url') }}" placeholder="https://...">

        <div class="mt-16">
            <button type="submit" class="btn btn-primary">Добавить</button>
            <a href="{{ route('admin.products') }}">Отмена</a>
        </div>
    </form>
@endsection
