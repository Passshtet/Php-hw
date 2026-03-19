@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <h1>{{ $product->name }}</h1>

    <p><strong>Категория:</strong> {{ $product->category->name ?? '—' }}</p>
    <p><strong>Цена:</strong> {{ number_format($product->price, 0, '.', ' ') }} руб.</p>
    <p><strong>Описание:</strong> {{ $product->description ?: 'нет описания' }}</p>

    @if ($product->image_url)
        <div class="mt-16">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" style="max-width: 400px; border-radius: 6px;">
        </div>
    @endif

    {{-- Средняя оценка --}}
    <div class="mt-16">
        <strong>Оценка:</strong>
        @php $avg = $product->avgRating(); @endphp
        <span class="rating">
            @for ($i = 1; $i <= 5; $i++)
                {{ $i <= round($avg) ? '★' : '☆' }}
            @endfor
        </span>
        ({{ $avg }} из 5, {{ $product->ratings->count() }} оценок)
    </div>

    {{-- Оценить товар (только авторизованные) --}}
    @auth
        <div class="mt-16">
            <h2>Оценить товар</h2>
            <form method="POST" action="{{ route('rating.store') }}" style="display: flex; gap: 8px; align-items: center;">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <select name="score" style="width: 100px;">
                    @for ($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}">{{ $i }} ★</option>
                    @endfor
                </select>
                <button type="submit" class="btn btn-primary btn-sm">Оценить</button>
            </form>
        </div>
    @endauth

    {{-- Недавно просмотренные товары --}}
    @if (isset($recentProducts) && $recentProducts->count() > 1)
        <div class="mt-16">
            <h2>Недавно просмотренные</h2>
            <div class="products-grid">
                @foreach ($recentProducts as $recent)
                    @if ($recent->id !== $product->id)
                        <div class="product-card">
                            <h3><a href="{{ route('catalog.show', $recent) }}">{{ $recent->name }}</a></h3>
                            <p class="price">{{ number_format($recent->price, 0, '.', ' ') }} руб.</p>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif

    <div class="mt-16">
        <a href="{{ route('catalog.index') }}">← Назад к каталогу</a>
    </div>
@endsection
