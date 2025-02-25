<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suggestion;

class SuggestionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Suggestion::create($request->only('name', 'email', 'message'));

        return redirect()->back()->with('success', 'Cảm ơn bạn đã gửi góp ý!');
    }


    // Phương thức index để hiển thị danh sách góp ý trong chế độ admin
    public function index()
    {
        $suggestions = Suggestion::latest()->paginate(10);
        return view('suggestions.index', compact('suggestions'));
    }
}
