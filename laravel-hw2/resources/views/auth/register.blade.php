@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
    <h1>Регистрация</h1>

    <form method="POST" action="{{ route('register') }}" style="max-width: 400px;">
        @csrf

        <label for="name">ФИО</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>

        <label for="password">Пароль</label>
        <input type="password" name="password" id="password" required>

        <label for="password_confirmation">Подтверждение пароля</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>

        <div class="mt-16">
            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        </div>

        <p class="mt-16">Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a></p>
    </form>
@endsection
