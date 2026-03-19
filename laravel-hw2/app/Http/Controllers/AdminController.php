<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function dashboard()
    {
        return view('admin.dashboard');
    }


    public function users()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role'  => 'required|in:admin,buyer',
        ]);

        $user->update($validated);

        return redirect()->route('admin.users')->with('success', 'Пользователь обновлён.');
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Пользователь удалён.');
    }


    public function categories()
    {
        $categories = Category::with('parent')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function createCategory()
    {
        $categories = Category::all();
        return view('admin.categories.create', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id'   => 'nullable|exists:categories,id',
        ]);

        Category::create($validated);

        return redirect()->route('admin.categories')->with('success', 'Категория создана.');
    }

    public function editCategory(Category $category)
    {
        $categories = Category::where('id', '!=', $category->id)->get();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    public function updateCategory(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id'   => 'nullable|exists:categories,id',
        ]);

        $category->update($validated);

        return redirect()->route('admin.categories')->with('success', 'Категория обновлена.');
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories')->with('success', 'Категория удалена.');
    }


    public function products()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    public function createProduct()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image_url'   => 'nullable|string|max:500',
        ]);

        Product::create($validated);

        return redirect()->route('admin.products')->with('success', 'Товар добавлен.');
    }

    public function editProduct(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image_url'   => 'nullable|string|max:500',
        ]);

        $product->update($validated);

        return redirect()->route('admin.products')->with('success', 'Товар обновлён.');
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Товар удалён.');
    }


    public function orders()
    {
        $orders = Order::with('user', 'items.product')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function showOrder(Order $order)
    {
        $order->load('user', 'items.product');
        return view('admin.orders.show', compact('order'));
    }


    public function feedback()
    {
        $messages = Feedback::latest()->get();
        return view('admin.feedback.index', compact('messages'));
    }
}
