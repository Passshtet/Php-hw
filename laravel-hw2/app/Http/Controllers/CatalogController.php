<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{

    public function index(Request $request)
    {
        $query = Product::with('category', 'ratings');


        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }


        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        $products = $query->paginate(12);
        $categories = Category::all();


        return view('catalog.index', compact('products', 'categories'));
    }


    public function show(Product $product)
    {
        $product->load('category', 'ratings');


        $recent = session()->get('recent_products', []);

        $recent = array_diff($recent, [$product->id]);

        array_unshift($recent, $product->id);

        $recent = array_slice($recent, 0, 10);
        session()->put('recent_products', $recent);


        $recentProducts = Product::whereIn('id', $recent)->get()
            ->sortBy(function ($p) use ($recent) {
                return array_search($p->id, $recent);
            })->values();

        return view('catalog.show', compact('product', 'recentProducts'));
    }
}
