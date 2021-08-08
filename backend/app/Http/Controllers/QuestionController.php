<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Question;
use \App\Models\QuestionCategory;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::select(['questions.*', 'companies.name as company_name'])
                                ->join('entries', 'questions.entry_id', '=', 'entries.id')
                                ->join('companies', 'entries.company_id', '=', 'companies.id')
                                ->sortable('company_name')
                                ->paginate(10);
                          
        return view('question.index')
            ->with('questions', $questions);
    }
}
