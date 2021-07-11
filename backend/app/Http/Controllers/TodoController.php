<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Todo;

class TodoController extends Controller
{
    public function index()
    {
        return view('todo.index')
            ->with('todos', Todo::where('is_done', false)->orderBy('time_to_start', 'ASC')->get());
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
            'time_to_start' => 'required',
            'time_to_end' => 'required'
        ]);

        Todo::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'time_to_start' => $request->input('time_to_start'),
            'time_to_end' => $request->input('time_to_end'),
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
        $todo = Todo::find($id);

        $request->validate([
            'title' => 'required|max:20',
            'time_to_start' => 'required',
        ]);

        if(!$todo->entry_id) {
            $request->validate([
                'time_to_end' => 'required',
            ]);
        }
        
        $todo->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'time_to_start' => $request->input('time_to_start'),
            'time_to_end' => $request->input('time_to_end'),
            'is_done' => $request->boolean('is_done'),
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

    public function editEntry($id)
    {
        $entry_id = Todo::find($id)->entry_id;
        $path = sprintf('/entry/%d/edit', $entry_id);
        return redirect($path);
    }
}
