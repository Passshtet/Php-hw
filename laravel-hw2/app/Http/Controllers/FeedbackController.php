<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{

    public function create()
    {
        return view('feedback.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string|max:2000',
        ]);

        Feedback::create($validated);

        return redirect()->route('feedback.create')->with('success', 'Сообщение отправлено.');
    }
}
