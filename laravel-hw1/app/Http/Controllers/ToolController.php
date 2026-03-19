<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ToolController extends Controller
{

    private string $filePath = 'tools.json';

    /**
     * Главная страница — форма ввода
     */
    public function index()
    {
        return view('tools.index');
    }

    /**
     * Сохранение инструмента в файл
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'category'    => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'brand'       => 'required|string|max:255',
            'in_stock'    => 'required|boolean',
        ]);


        $tools = $this->readFromFile();


        $tools[] = $validated;


        $saved = $this->writeToFile($tools);

        if ($saved) {
            return redirect()->route('tools.index')
                ->with('success', 'Инструмент успешно сохранён.');
        }

        return redirect()->route('tools.index')
            ->with('error', 'Ошибка сохранения данных.');
    }

    /**
     * Поиск инструментов по введённым параметрам
     */
    public function search(Request $request)
    {
        $tools = $this->readFromFile();
        $results = $tools;


        if ($request->filled('name')) {
            $results = array_filter($results, function ($tool) use ($request) {
                return mb_stripos($tool['name'], $request->input('name')) !== false;
            });
        }

        if ($request->filled('description')) {
            $results = array_filter($results, function ($tool) use ($request) {
                return mb_stripos($tool['description'], $request->input('description')) !== false;
            });
        }

        if ($request->filled('category')) {
            $results = array_filter($results, function ($tool) use ($request) {
                return mb_stripos($tool['category'], $request->input('category')) !== false;
            });
        }

        if ($request->filled('price')) {
            $results = array_filter($results, function ($tool) use ($request) {
                return (float) $tool['price'] == (float) $request->input('price');
            });
        }

        if ($request->filled('brand')) {
            $results = array_filter($results, function ($tool) use ($request) {
                return mb_stripos($tool['brand'], $request->input('brand')) !== false;
            });
        }

        if ($request->filled('in_stock')) {
            $results = array_filter($results, function ($tool) use ($request) {
                return (int) $tool['in_stock'] == (int) $request->input('in_stock');
            });
        }

        $results = array_values($results);

        return view('tools.index', ['results' => $results, 'old' => $request->all()]);
    }

    /**
     * Чтение данных из JSON-файла
     */
    private function readFromFile(): array
    {
        if (!Storage::exists($this->filePath)) {
            return [];
        }

        $content = Storage::get($this->filePath);
        $data = json_decode($content, true);

        return is_array($data) ? $data : [];
    }

    /**
     * Запись данных в JSON-файл
     */
    private function writeToFile(array $data): bool
    {
        return Storage::put(
            $this->filePath,
            json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );
    }
}
