<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\Models\Entry;
use \App\Models\QuestionCategory;
use \App\Models\Company;
use \App\Models\Question;
use \App\Models\Todo;
use \App\Models\Template;
use Illuminate\Validation\Rule;

class EntryController extends Controller
{
    public function index()
    {
        $entries = DB::table('entries')
        ->join('companies', 'entries.company_id', '=', 'companies.id')
        ->join('entry_categories', 'entries.entry_category_id', '=', 'entry_categories.id')
        ->select('entries.*', 'companies.name', 'entry_categories.name as category')
        ->get();
        return view('entry.index')
            ->with('entries', $entries);
    }

    public function create()
    {
        $companies = Company::all();
        $question_categories = QuestionCategory::where('name', '!=', 'その他')->get();
        return view('entry.create')->with([
            "companies" => $companies,
            "question_categories" => $question_categories,
        ]);
    }
    
    public function edit(Request $request, $id)
    {
        $entry = Entry::find($id);
        return view('entry.edit')->with([
            'entry' => $entry,
        ]);
    }

    public function update(Request $request, $id)
    {
        $entry = Entry::find($id);
        $company_old = Company::where('id', $entry->company_id)->first();
        
        $request->validate([
            'company' => [
                'required',
                'max:20',
                Rule::unique('companies', 'name')->ignore($company_old, 'name')
            ],
        ]);
        
        $company_name = $request->input('company');
        $deadline = $request->input('deadline');
        
        $company_old->update([
            'name' => $company_name,
        ]);
        
        $entry->update([
            'deadline' => $deadline,
        ]);

        $questions = $entry->questions;
        $description_content = sprintf('設問数:%d', count($questions)) . "\n";

        foreach ($questions as $index => $question) { 
            $index++;
            $question_form_name = sprintf('question%d', $index);
            $word_count = sprintf('word_count%d', $index);
            $answer = sprintf('answer%d', $index);

            $question_name = $request->input($question_form_name);
            $word_count_value = $request->input($word_count);
            $answer_value = $request->input($answer);

            $description_content .= sprintf('%s: %d字', $question_name, $word_count_value) . "\n";

            $request->validate([
                $question_form_name => 'required',
                $word_count => 'required|gt:0'
            ]);
            
            $question_category = QuestionCategory::where('name', $question_name)->firstOr(function(){
                return QuestionCategory::where('name', 'その他')->first();
            });
            
            $question->update([
                'name' => $question_name,
                'question_category_id' => $question_category->id,
                'word_count' => $word_count_value,
                'answer' => $answer_value,
            ]);

            $question_name_for_template = $question_name . '-' . $word_count_value;

            $template = Template::where('name', $question_name_for_template)->first();
            if($template) {
                $template->update([
                    'answer' => $answer_value,
                ]);
            }

        }

        Todo::where('entry_id', $id)->update([
            'title' => $company_name . ' ES',
            'description' => $description_content,
            'time_to_start' => $deadline,
        ]);

        return redirect('/entry')->with('message', '編集に成功しました');
    }

    public function delete($id)
    {
        Entry::find($id)->delete();
        return redirect('/entry')->with('message', 'ESを削除しました');
    }

}
