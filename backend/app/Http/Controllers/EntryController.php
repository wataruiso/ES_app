<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Entry;
use \App\Models\QuestionCategory;
use \App\Models\Company;

class EntryController extends Controller
{
    public function index()
    {
        return view('entry.index')
            ->with('entries', Entry::orderBy('id', 'DESC')->get());
    }

    public function create()
    {
        $companies = Company::all();
        $question_categories = QuestionCategory::all();
        return view('entry.create')->with([
            "companies" => $companies,
            "question_categories" => $question_categories,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:20',
            'description' => 'required'
        ]);

        Todo::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return redirect('/dashboard')->with('message', '投稿に成功しました');
    }
    
    public function edit($id)
    {
        return view('todo.edit')
        ->with('todo', Todo::find($id));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        Todo::find($id)->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return redirect('/dashboard')->with('message', '編集に成功しました');
    }

    public function delete($id)
    {
        Todo::find($id)->delete();
        return redirect('/dashboard')->with('message', 'タスクを削除しました');
    }
}
