@extends('layouts.app')

@section('title', 'Пользователи')

@section('content')
    <h1>Пользователи</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>ФИО</th>
                <th>Email</th>
                <th>Роль</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-sm">Редактировать</a>
                        <form action="{{ route('admin.users.delete', $user) }}" method="POST" class="inline-form"
                              onsubmit="return confirm('Удалить пользователя?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-16"><a href="{{ route('admin.dashboard') }}">← Назад</a></div>
@endsection
