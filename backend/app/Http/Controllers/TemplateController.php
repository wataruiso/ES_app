<?php

namespace App\Http\Controllers;

use \App\Models\Template;
use Illuminate\Support\Facades\Auth;


class TemplateController extends Controller
{
    public function index()
    {
        $templates = Template::select('templates.*', 'template_questions.word_count', 'question_categories.name')
                        ->join('template_questions', 'templates.template_question_id', '=', 'template_questions.id')
                        ->join('question_categories', 'template_questions.question_category_id', '=', 'question_categories.id')
                        ->where('templates.user_id', Auth::id())
                        ->get();
        return view('template.index')
            ->with('templates', $templates);
    }
}
