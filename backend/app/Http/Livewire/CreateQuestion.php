<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \App\Models\QuestionCategory;
use \App\Models\Question;

class CreateQuestion extends Component
{
    public $entry_id;
    public $name;
    public $word_count;

    protected $rules = [
        'name' => 'required',
        'word_count' => 'required|numeric|min:20',
    ];

    public function render()
    {
        return view('livewire.question.create');
    }

    public function save()
    {
        $this->validate();
        $question_category = new QuestionCategory();
        $entry_id = $this->entry_id;

        Question::create([
            'name' => $this->name,
            'word_count' => $this->word_count,
            'question_category_id' => $question_category->getQuestionCategoryId($this->name),
            'entry_id' => $this->entry_id,
        ]);

        $this->reset();
        return redirect()->to("/entry/${entry_id}/edit");

    }

}
