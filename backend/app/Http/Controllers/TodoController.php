<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        return view('todo.index')
            ->with('todos', Todo::where('is_done', false)->orderBy('deadline', 'ASC')->get());
    }

    public function create()
    {
        return view('todo.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:20',
            'description' => 'required',
            'deadline' => 'required'
        ]);

        Todo::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'deadline' => $request->input('deadline'),
            'is_done' => false,
        ]);

        return redirect('/todo')->with('message', '投稿に成功しました');
    }
    
    public function edit($id)
    {
        return view('todo.edit')
        ->with('todo', Todo::find($id));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:20',
            'description' => 'required',
            'deadline' => 'required'
        ]);

        $is_done = $request->input('is_done') == 'on' ? true : false;

        Todo::find($id)->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'deadline' => $request->input('deadline'),
            'is_done' => $is_done,
        ]);

        return redirect('/todo')->with('message', '編集に成功しました');
    }

    public function delete($id)
    {
        Todo::find($id)->delete();
        return redirect('/todo')->with('message', 'タスクを削除しました');
    }

    public function complete($id)
    {
        Todo::find($id)->update([
            'is_done' => true
        ]);
        return redirect('/todo')->with('message', 'タスクを完了しました');
    }

    public function getCompleteTodos()
    {
        return view('todo.index')
            ->with('todos', Todo::where('is_done', true)->get());
    }
}
