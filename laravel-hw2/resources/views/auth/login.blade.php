@extends('layouts.app')

@section('title', 'Вход')

@section('content')
    <h1>Вход</h1>

    <form method="POST" action="{{ route('login') }}" style="max-width: 400px;">
        @csrf

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>

        <label for="password">Пароль</label>
        <input type="password" name="password" id="password" required>

        <div class="mt-16">
            <button type="submit" class="btn btn-primary">Войти</button>
        </div>

        <p class="mt-16">Нет аккаунта? <a href="{{ route('register') }}">Зарегистрироваться</a></p>
    </form>
@endsection
