@extends('layouts.app')

@section('title', 'Обратная связь')

@section('content')
    <h1>Обратная связь</h1>

    <form method="POST" action="{{ route('feedback.store') }}" style="max-width: 500px;">
        @csrf

        <label for="name">Имя</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>

        <label for="message">Сообщение</label>
        <textarea name="message" id="message" required>{{ old('message') }}</textarea>

        <div class="mt-16">
            <button type="submit" class="btn btn-primary">Отправить</button>
        </div>
    </form>
@endsection
