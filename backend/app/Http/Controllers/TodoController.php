<?php

namespace App\Http\Controllers;

use \App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::where('user_id', Auth::id())
        ->orderBy('is_done', 'ASC')
        ->orderBy('start_at', 'ASC')
        ->get();
        return view('todo.index')
            ->with('todos', $todos);
    }
}
