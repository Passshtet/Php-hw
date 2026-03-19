@extends('layouts.app')

@section('title', 'Заказы')

@section('content')
    <h1>Все заказы</h1>

    @if ($orders->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Номер</th>
                    <th>Покупатель</th>
                    <th>Дата</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->user->name ?? '—' }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-primary btn-sm">Подробнее</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Заказов пока нет.</p>
    @endif

    <div class="mt-16"><a href="{{ route('admin.dashboard') }}">← Назад</a></div>
@endsection
