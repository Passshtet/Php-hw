@extends('layouts.app')

@section('title', 'Редактировать товар')

@section('content')
    <h1>Редактировать товар</h1>

    <form method="POST" action="{{ route('admin.products.update', $product) }}" style="max-width: 500px;">
        @csrf
        @method('PUT')

        <label for="name">Название</label>
        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required>

        <label for="description">Описание</label>
        <textarea name="description" id="description">{{ old('description', $product->description) }}</textarea>

        <label for="price">Цена (руб.)</label>
        <input type="number" name="price" id="price" step="0.01" min="0" value="{{ old('price', $product->price) }}" required>

        <label for="category_id">Категория</label>
        <select name="category_id" id="category_id" required>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>

        <label for="image_url">Ссылка на изображение</label>
        <input type="text" name="image_url" id="image_url" value="{{ old('image_url', $product->image_url) }}">

        <div class="mt-16">
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="{{ route('admin.products') }}">Отмена</a>
        </div>
    </form>
@endsection
