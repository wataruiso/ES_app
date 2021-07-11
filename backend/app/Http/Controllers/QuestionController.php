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
        // $questions = DB::table('questions')
        //                     ->join('entries', 'questions.entry_id', '=', 'entries.id')
        //                     ->join('companies', 'entries.company_id', '=', 'companies.id')
        //                     ->select('questions.*', 'companies.name')
        //                     ->get();

        return view('question.index')
            ->with('questions', Question::sortable()->paginate(10));
    }
}
