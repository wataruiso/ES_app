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
        $this->deadline = date('Y-m-d') . 'T00:00';
    }

    public function render()
    {
        return view('livewire.entry.create');
    }

    public function getCompanyId()
    {
       $company = Company::where('name', $this->company)->first();
       if(!$company) $company = Company::create(['name' => $this->company]);
       return $company->id;
    }

    public function getCategoryId()
    {
        $category = EntryCategory::where('name', $this->category)->first();
       return $category ? $category->id : EntryCategory::where('name', 'その他')->first()->id;
    }

    public function save()
    {
        $this->validate();
        
        Entry::create([
            'company_id' => $this->getCompanyId(),
            'category_name' => $this->category,
            'entry_category_id' => $this->getCategoryId(),
            'deadline' => $this->deadline,
        ]);

        $this->reset();
        return redirect()->to("/entry");
    }
}
