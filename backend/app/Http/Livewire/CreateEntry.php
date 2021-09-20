<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \App\Models\Entry;
use \App\Models\Company;
use \App\Models\EntryCategory;

class CreateEntry extends Component
{
    public $company;
    public $category;
    public $deadline;

    protected $rules = [
        'company' => 'required',
        'category' => 'required',
        'deadline' => 'required|date|after_or_equal:today',
    ];

    public function mount()
    {
        $this->deadline = \Util::getInitialDateTime();
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
        
        Entry::create([
            'company_id' => $company->getCompanyId($this->company),
            'category_name' => $this->category,
            'entry_category_id' => $entry_category->getEntryCategoryId($this->category),
            'deadline' => $this->deadline,
        ]);

        $this->reset();
        return redirect()->to("/entry");
    }
}
