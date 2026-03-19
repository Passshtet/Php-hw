@extends('layouts.app')

@section('title', 'Мои заказы')

@section('content')
    <h1>Мои заказы</h1>

    <a href="{{ route('orders.create') }}" class="btn btn-primary mb-16">Создать заказ</a>

    @if ($orders->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Номер заказа</th>
                    <th>Дата</th>
                    <th>Товары</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>
                            @foreach ($order->items as $item)
                                {{ $item->product->name ?? 'удалён' }} × {{ $item->quantity }}<br>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>У вас пока нет заказов.</p>
    @endif
@endsection
