@extends('layouts.app')

@section('title', 'Обратная связь')

@section('content')
    <h1>Сообщения обратной связи</h1>

    @if ($messages->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Дата</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Сообщение</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $msg)
                    <tr>
                        <td>{{ $msg->created_at->format('d.m.Y H:i') }}</td>
                        <td>{{ $msg->name }}</td>
                        <td>{{ $msg->email }}</td>
                        <td>{{ $msg->message }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Сообщений пока нет.</p>
    @endif

    <div class="mt-16"><a href="{{ route('admin.dashboard') }}">← Назад</a></div>
@endsection
