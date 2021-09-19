<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\Models\Template;


class TemplateController extends Controller
{
    public function index()
    {
        $templates = DB::table('templates')
                        ->join('question_categories', 'templates.question_category_id', '=', 'question_categories.id')
                        ->select('templates.*', 'question_categories.name')
                        ->get();
        return view('template.index')
            ->with('templates', $templates);
    }
}
