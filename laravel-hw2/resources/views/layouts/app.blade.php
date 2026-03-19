<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Интернет-магазин')</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: sans-serif; background: #f5f5f5; }
        a { color: #2563eb; text-decoration: none; }
        a:hover { text-decoration: underline; }

        /* Навигация */
        nav { background: #1e293b; color: #fff; padding: 12px 24px; display: flex; justify-content: space-between; align-items: center; }
        nav .logo { font-size: 18px; font-weight: bold; color: #fff; }
        nav .links { display: flex; gap: 16px; align-items: center; }
        nav .links a { color: #cbd5e1; }
        nav .links a:hover { color: #fff; }
        nav .links form { display: inline; }
        nav .links button { background: none; border: none; color: #cbd5e1; cursor: pointer; font-size: 14px; }
        nav .links button:hover { color: #fff; }

        /* Контент */
        .container { max-width: 1000px; margin: 24px auto; padding: 0 16px; }
        h1, h2 { margin-bottom: 16px; }

        /* Сообщения */
        .success { background: #d1fae5; color: #065f46; padding: 10px 16px; border-radius: 4px; margin-bottom: 16px; }
        .error { background: #fecaca; color: #991b1b; padding: 10px 16px; border-radius: 4px; margin-bottom: 16px; }
        .validation-errors { color: #991b1b; margin-bottom: 16px; }
        .validation-errors ul { margin-left: 20px; }

        /* Формы */
        label { display: block; margin-top: 10px; font-weight: bold; }
        input, textarea, select { width: 100%; padding: 8px; margin-top: 4px; border: 1px solid #ccc; border-radius: 4px; }
        textarea { resize: vertical; height: 80px; }
        .btn { display: inline-block; padding: 8px 20px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; text-decoration: none; color: #fff; }
        .btn-primary { background: #2563eb; }
        .btn-primary:hover { background: #1d4ed8; }
        .btn-danger { background: #dc2626; }
        .btn-danger:hover { background: #b91c1c; }
        .btn-sm { padding: 4px 12px; font-size: 12px; }

        /* Таблицы */
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #f0f0f0; }

        /* Карточки товаров */
        .products-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 16px; }
        .product-card { background: #fff; border: 1px solid #ddd; border-radius: 6px; padding: 16px; }
        .product-card h3 { margin-bottom: 8px; }
        .product-card .price { font-size: 18px; font-weight: bold; color: #16a34a; }
        .product-card .category { color: #666; font-size: 13px; }
        .product-card img { width: 100%; height: 150px; object-fit: cover; border-radius: 4px; margin-bottom: 8px; }
        .product-card .rating { color: #eab308; }

        /* Поиск */
        .search-bar { display: flex; gap: 8px; margin-bottom: 20px; }
        .search-bar input { flex: 1; }
        .search-bar select { width: 200px; }

        /* Разное */
        .mt-16 { margin-top: 16px; }
        .mb-16 { margin-bottom: 16px; }
        .inline-form { display: inline; }
    </style>
</head>
<body>

<nav>
    <a href="{{ route('catalog.index') }}" class="logo">Стройинструмент</a>
    <div class="links">
        <a href="{{ route('catalog.index') }}">Каталог</a>
        <a href="{{ route('feedback.create') }}">Обратная связь</a>

        @auth
            @if (auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}">Админ</a>
            @endif

            <a href="{{ route('orders.index') }}">Мои заказы</a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Выйти ({{ auth()->user()->name }})</button>
            </form>
        @else
            <a href="{{ route('login') }}">Войти</a>
            <a href="{{ route('register') }}">Регистрация</a>
        @endauth
    </div>
</nav>

<div class="container">
    {{-- Сообщения --}}
    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif
    @if ($errors->any())
        <div class="validation-errors">
            <ul>
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</div>

</body>
</html>
