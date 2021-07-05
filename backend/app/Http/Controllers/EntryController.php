<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Entry;
use \App\Models\QuestionCategory;
use \App\Models\Company;
use \App\Models\Question;

class EntryController extends Controller
{
    public function index()
    {
        return view('entry.index')
            ->with('entries', Entry::orderBy('deadline', 'ASC')->join('companies', 'entries.company_id', '=', 'companies.id')->get());
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
            'company' => 'required|max:20',
        ]);

        $company_name = $request->input('company');
        
        $company = Company::firstOrCreate([
            'name' => $company_name,
        ]);
        
        $entry = Entry::create([
            'company_id' => $company->id,
            'deadline' => $request->input('deadline'),
        ]);
        
        for ($i = 1; $i <= $request->input('question_num'); $i++) { 

            $question = sprintf('question%d', $i);
            $word_count = sprintf('word_count%d', $i);
            $answer = sprintf('answer%d', $i);

            $question_name = $request->input($question);

            $request->validate([
                $question => 'required',
            ]);
            
            $question_category = QuestionCategory::where('name', $question_name)->firstOr(function(){
                return QuestionCategory::where('name', 'その他')->first();
            });
               
            $created = Question::create([
                'name' => $question_name,
                'entry_id' => $entry->id,
                'question_category_id' => $question_category->id,
                'word_count' => $request->input($word_count),
                'answer' => $request->input($answer),
            ]);

        }

        return redirect('/entry')->with('message', 'success');
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
