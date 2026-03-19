@extends('layouts.app')

@section('title', 'Каталог')

@section('content')
    <h1>Каталог товаров</h1>

    {{-- Поиск и фильтр --}}
    <form method="GET" action="{{ route('catalog.index') }}" class="search-bar">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Поиск по названию...">
        <select name="category_id">
            <option value="">Все категории</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Найти</button>
    </form>

    {{-- Сетка товаров --}}
    @if ($products->count() > 0)
        <div class="products-grid">
            @foreach ($products as $product)
                <div class="product-card">
                    @if ($product->image_url)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                    @endif
                    <h3><a href="{{ route('catalog.show', $product) }}">{{ $product->name }}</a></h3>
                    <p class="category">{{ $product->category->name ?? '—' }}</p>
                    <p class="price">{{ number_format($product->price, 0, '.', ' ') }} руб.</p>
                    <p class="rating">
                        @php $avg = $product->avgRating(); @endphp
                        @for ($i = 1; $i <= 5; $i++)
                            {{ $i <= round($avg) ? '★' : '☆' }}
                        @endfor
                        ({{ $avg }})
                    </p>
                </div>
            @endforeach
        </div>

        <div class="mt-16">{{ $products->withQueryString()->links() }}</div>
    @else
        <p>Товары не найдены.</p>
    @endif
@endsection
