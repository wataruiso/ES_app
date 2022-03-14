<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \App\Models\Company;
use \App\Models\EntryCategory;

class EditEntry extends Component
{
    public $entry;
    public $company;
    public $category;
    public $deadline;

    protected $rules = [
        'company' => 'required',
        'category' => 'required',
        'deadline' => 'date|after_or_equal:today',
    ];

    public function mount($entry)//entryテーブルの外部キーをバリューに変換し、フォームに反映する
    {
        $this->company = $this->getCompany()->name; 
        $this->category = $entry->category_name; 
        $this->deadline = \Util::getFormDatetime($entry->deadline);
    }

    public function save()//フォームのバリューからidを検索し、それをentryテーブルの外部キーに挿入
    {
        $this->validate();
        $company = new Company();
        $entry_category = new EntryCategory();

        $this->entry->company_id = $company->getCompanyId($this->company);
        $this->entry->category_name = $this->category;
        $this->entry->entry_category_id = $entry_category->getEntryCategoryId($this->category);
        $this->entry->deadline = $this->deadline;

        $this->entry->save();

        $todo = $this->entry->todo;
        if($todo) {
            $todo->update([
                'title' => $this->company . '-' . $this->category . 'ES締切',
                'start_at' => $this->deadline,
                'end_at' => $this->deadline,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.entry.edit');
    }

    public function delete()
    {
        $this->entry->delete();
        return redirect()->to("/entry");
    }
    
    public function getCompany()
    {
       return Company::find($this->entry->company_id);
    }

}
