@extends('layouts.app')

@section('title', 'Новый заказ')

@section('content')
    <h1>Создать заказ</h1>

    <form method="POST" action="{{ route('orders.store') }}">
        @csrf

        <div id="items-container">
            <div class="order-item" style="display: flex; gap: 8px; margin-bottom: 8px; align-items: end;">
                <div style="flex: 1;">
                    <label>Товар</label>
                    <select name="items[0][product_id]" required>
                        <option value="">— выберите товар —</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">
                                {{ $product->name }} — {{ number_format($product->price, 0, '.', ' ') }} руб.
                            </option>
                        @endforeach
                    </select>
                </div>
                <div style="width: 100px;">
                    <label>Кол-во</label>
                    <input type="number" name="items[0][quantity]" value="1" min="1" required>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-primary btn-sm" onclick="addItem()">+ Добавить товар</button>

        <div class="mt-16">
            <button type="submit" class="btn btn-primary">Оформить заказ</button>
        </div>
    </form>

    <script>
        var itemIndex = 1;
        function addItem() {
            var container = document.getElementById('items-container');
            var html = '<div class="order-item" style="display: flex; gap: 8px; margin-bottom: 8px; align-items: end;">'
                + '<div style="flex: 1;"><label>Товар</label>'
                + '<select name="items[' + itemIndex + '][product_id]" required>'
                + '<option value="">— выберите товар —</option>'
                + '@foreach ($products as $product)<option value="{{ $product->id }}">{{ $product->name }} — {{ number_format($product->price, 0, ".", " ") }} руб.</option>@endforeach'
                + '</select></div>'
                + '<div style="width: 100px;"><label>Кол-во</label>'
                + '<input type="number" name="items[' + itemIndex + '][quantity]" value="1" min="1" required>'
                + '</div></div>';
            container.insertAdjacentHTML('beforeend', html);
            itemIndex++;
        }
    </script>
@endsection
