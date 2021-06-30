<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        return view('dashboard')
            ->with('todos', Todo::orderBy('id', 'DESC')->get());
    }

    public function create()
    {
        return view('todo.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        Todo::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return redirect('/dashboard')->with('message', '投稿に成功しました');
    }
}
