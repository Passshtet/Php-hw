@extends('layouts.app')

@section('title', 'Админ-панель')

@section('content')
    <h1>Админ-панель</h1>

    <ul style="list-style: none; display: flex; gap: 16px; flex-wrap: wrap;">
        <li><a href="{{ route('admin.users') }}" class="btn btn-primary">Пользователи</a></li>
        <li><a href="{{ route('admin.categories') }}" class="btn btn-primary">Категории</a></li>
        <li><a href="{{ route('admin.products') }}" class="btn btn-primary">Товары</a></li>
        <li><a href="{{ route('admin.orders') }}" class="btn btn-primary">Заказы</a></li>
        <li><a href="{{ route('admin.feedback') }}" class="btn btn-primary">Обратная связь</a></li>
    </ul>
@endsection
