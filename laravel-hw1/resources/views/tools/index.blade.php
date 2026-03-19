<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Строительные инструменты</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 40px auto; padding: 0 20px; }
        h1 { text-align: center; }
        form { margin-bottom: 30px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input, textarea, select { width: 100%; padding: 8px; margin-top: 4px; box-sizing: border-box; }
        textarea { resize: vertical; height: 80px; }
        .buttons { margin-top: 16px; display: flex; gap: 10px; }
        .buttons button { padding: 10px 24px; cursor: pointer; }
        .success { color: green; font-weight: bold; margin-bottom: 16px; }
        .error { color: red; font-weight: bold; margin-bottom: 16px; }
        .validation-errors { color: red; margin-bottom: 16px; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f0f0f0; }
        .no-results { color: #666; margin-top: 10px; }
    </style>
</head>
<body>

<h1>Строительные инструменты</h1>

{{-- Сообщения об успехе / ошибке --}}
@if (session('success'))
    <div class="success">{{ session('success') }}</div>
@endif

@if (session('error'))
    <div class="error">{{ session('error') }}</div>
@endif

{{-- Ошибки валидации --}}
@if ($errors->any())
    <div class="validation-errors">
        <ul>
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Форма ввода данных --}}
<form method="POST" action="{{ route('tools.store') }}" id="toolForm">
    @csrf

    <label for="name">Название</label>
    <input type="text" name="name" id="name" value="{{ old('name', $old['name'] ?? '') }}">

    <label for="description">Описание</label>
    <textarea name="description" id="description">{{ old('description', $old['description'] ?? '') }}</textarea>

    <label for="category">Категория</label>
    <input type="text" name="category" id="category"
           value="{{ old('category', $old['category'] ?? '') }}"
           placeholder="например: ручной, электрический, измерительный">

    <label for="price">Цена (руб.)</label>
    <input type="number" name="price" id="price" step="0.01" min="0"
           value="{{ old('price', $old['price'] ?? '') }}">

    <label for="brand">Бренд</label>
    <input type="text" name="brand" id="brand" value="{{ old('brand', $old['brand'] ?? '') }}">

    <label for="in_stock">В наличии</label>
    <select name="in_stock" id="in_stock">
        <option value="">— не выбрано —</option>
        <option value="1" {{ old('in_stock', $old['in_stock'] ?? '') == '1' ? 'selected' : '' }}>Да</option>
        <option value="0" {{ old('in_stock', $old['in_stock'] ?? '') === '0' ? 'selected' : '' }}>Нет</option>
    </select>

    <div class="buttons">
        {{-- Кнопка «Сохранить» — отправляет POST-запрос --}}
        <button type="submit">Сохранить</button>

        {{-- Кнопка «Найти» — отправляет GET-запрос на маршрут поиска --}}
        <button type="button" id="searchBtn">Найти</button>
    </div>
</form>

{{-- Результаты поиска --}}
@if (isset($results))
    <h2>Результаты поиска</h2>
    @if (count($results) > 0)
        <table>
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Категория</th>
                    <th>Цена</th>
                    <th>Бренд</th>
                    <th>В наличии</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $tool)
                    <tr>
                        <td>{{ $tool['name'] }}</td>
                        <td>{{ $tool['description'] }}</td>
                        <td>{{ $tool['category'] }}</td>
                        <td>{{ $tool['price'] }} руб.</td>
                        <td>{{ $tool['brand'] }}</td>
                        <td>{{ $tool['in_stock'] ? 'Да' : 'Нет' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="no-results">Сущность с заданными параметрами не найдена.</p>
    @endif
@endif

<script>
    // Кнопка «Найти» — меняем action и method формы на GET /search
    document.getElementById('searchBtn').addEventListener('click', function () {
        var form = document.getElementById('toolForm');
        form.method = 'GET';
        form.action = '{{ route("tools.search") }}';
        // Убираем CSRF-токен для GET-запроса
        var csrf = form.querySelector('input[name="_token"]');
        if (csrf) csrf.disabled = true;
        form.submit();
    });
</script>

</body>
</html>
