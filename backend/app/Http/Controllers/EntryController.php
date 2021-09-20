<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\Models\Entry;

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

    public function edit(Request $request, $id)
    {
        $entry = Entry::find($id);
        return view('entry.edit')->with([
            'entry' => $entry,
        ]);
    }

}
