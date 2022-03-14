<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Entry;
use Illuminate\Support\Facades\Auth;

class EntryController extends Controller
{
    public function index()
    {
        $entries = Entry::select('entries.*', 'companies.name', 'entry_categories.name as category')
        ->join('companies', 'entries.company_id', '=', 'companies.id')
        ->join('entry_categories', 'entries.entry_category_id', '=', 'entry_categories.id')
        ->where('entries.user_id', Auth::id())
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
