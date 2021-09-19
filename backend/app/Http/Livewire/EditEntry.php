<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \App\Models\Company;
use \App\Models\EntryCategory;
use Illuminate\Support\Carbon;


class EditEntry extends Component
{
    public $entry;
    public $company;
    public $category;
    public $deadline;

    protected $rules = [
        'company' => 'required',
        'category' => 'required',
        'deadline' => 'required|date|after_or_equal:today',
    ];

    protected $casts = [
        'deadline' => 'dateTime:Y-m-d\TH:i'
    ];

    public function mount($entry)//entryテーブルの外部キーをバリューに変換し、フォームに反映する
    {
        $this->company = $this->getCompany()->name; 
        $this->category = $entry->category_name; 
        $this->deadline = Carbon::parse($entry->deadline)->format('Y-m-d\TH:i');
    }

    public function save()//フォームのバリューからidを検索し、それをentryテーブルの外部キーに挿入
    {
        $this->validate();

        $this->entry->company_id = $this->getCompanyId();
        $this->entry->category_name = $this->category;
        $this->entry->entry_category_id = $this->getCategoryId();
        $this->entry->deadline = $this->deadline;

        $this->entry->save();
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

    public function getTitleDeadline()
    {
       return Carbon::parse($this->entry->deadline)->format('Y-m-d H:i');
    }
    
    public function getCompany()
    {
       return Company::find($this->entry->company_id);
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

}
