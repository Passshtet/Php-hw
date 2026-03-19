@extends('layouts.app')

@section('title', 'Заказ ' . $order->order_number)

@section('content')
    <h1>Заказ {{ $order->order_number }}</h1>

    <p><strong>Покупатель:</strong> {{ $order->user->name ?? '—' }} ({{ $order->user->email ?? '' }})</p>
    <p><strong>Дата:</strong> {{ $order->order_date }}</p>

    <h2 class="mt-16">Позиции заказа</h2>
    <table>
        <thead>
            <tr>
                <th>Товар</th>
                <th>Количество</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'удалён' }}</td>
                    <td>{{ $item->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-16"><a href="{{ route('admin.orders') }}">← Назад к заказам</a></div>
@endsection
