<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \App\Models\Entry;
use \App\Models\Todo;
use \App\Models\Company;
use \App\Models\EntryCategory;
use Illuminate\Support\Facades\Auth;

class CreateEntry extends Component
{
    public $company;
    public $category;
    public $deadline;

    protected $rules = [
        'company' => 'required',
        'category' => 'required',
        'deadline' => 'date|after_or_equal:today',
    ];

    public function mount()
    {
        $this->deadline = \Util::getInitialDatetime();
    }

    public function render()
    {
        return view('livewire.entry.create');
    }

    public function save()
    {
        $this->validate();
        $company = new Company();
        $entry_category = new EntryCategory();
        
        $entry = Entry::create([
            'user_id' => Auth::id(),
            'company_id' => $company->getCompanyId($this->company),
            'category_name' => $this->category,
            'entry_category_id' => $entry_category->getEntryCategoryId($this->category),
            'deadline' => $this->deadline,
        ]);

        Todo::create([
            'user_id' => Auth::id(),
            'entry_id' => $entry->id,
            'title' => $this->company . '-' . $this->category . 'ES締切',
            'start_at' => $this->deadline,
            'end_at' => $this->deadline,
            'is_done' => false,
        ]);

        $this->reset();
        return redirect()->to("/entry");
    }
}
