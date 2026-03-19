@extends('layouts.app')

@section('title', 'Редактировать пользователя')

@section('content')
    <h1>Редактировать пользователя</h1>

    <form method="POST" action="{{ route('admin.users.update', $user) }}" style="max-width: 400px;">
        @csrf
        @method('PUT')

        <label for="name">ФИО</label>
        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>

        <label for="role">Роль</label>
        <select name="role" id="role">
            <option value="buyer" {{ $user->role === 'buyer' ? 'selected' : '' }}>Покупатель</option>
            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Администратор</option>
        </select>

        <div class="mt-16">
            <button type="submit" class="btn btn-primary">Сохранить</button>
            <a href="{{ route('admin.users') }}">Отмена</a>
        </div>
    </form>
@endsection
