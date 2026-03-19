<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'score'      => 'required|integer|min:1|max:5',
        ]);


        Rating::updateOrCreate(
            [
                'user_id'    => auth()->id(),
                'product_id' => $validated['product_id'],
            ],
            ['score' => $validated['score']]
        );

        return back()->with('success', 'Оценка сохранена.');
    }
}
