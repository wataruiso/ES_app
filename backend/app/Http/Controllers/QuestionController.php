<?php

namespace App\Http\Controllers;

use \App\Models\Question;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index()
    {
        $entries_id = Auth::user()->entries->pluck('id');
        if(!count($entries_id)) $questions = [];
        else $questions = Question::select(['questions.*', 'companies.name as company_name'])
                                    ->join('entries', 'questions.entry_id', '=', 'entries.id')
                                    ->join('companies', 'entries.company_id', '=', 'companies.id')
                                    ->whereIn('questions.entry_id', $entries_id)
                                    ->sortable('company_name')
                                    ->paginate(10);
                          
        return view('question.index')
            ->with('questions', $questions);
    }
}
