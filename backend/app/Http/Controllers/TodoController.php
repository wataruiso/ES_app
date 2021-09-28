<?php

namespace App\Http\Controllers;

use \App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        return view('todo.index')
            ->with('todos', Todo::orderBy('is_done', 'ASC')->orderBy('start_at', 'ASC')->get());
    }
}
