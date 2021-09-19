<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \App\Models\QuestionCategory;

class EditQuestion extends Component
{
    //レコード
    public $question;
    //カラム
    public $name;
    public $word_count;
    public $answer;

    protected $rules = [
        'name' => 'required',
        'word_count' => 'required|numeric|min:20',
    ];

    public function mount($question)
    {
        $this->name = $question->name;
        $this->word_count = $question->word_count;
        $this->answer = $question->answer;
    }

    public function render()
    {
        return view('livewire.question.edit');
    }

    //question(name, word_count)
    public function getQuestionCategory()
    {
        return QuestionCategory::where('name', $this->name)->first();
    }

    public function save()
    {
        $this->validate();

        $question_category = $this->getQuestionCategory();
        $question_category_id = $question_category ? $question_category->id : QuestionCategory::where('name', 'その他')->first()->id;

        $this->question->name = $this->name;
        $this->question->question_category_id = $question_category_id;
        $this->question->word_count = $this->word_count;
        $this->question->save();
    }

    public function delete()
    {
        $id = $this->question->entry_id;
        $this->question->delete();
        return redirect()->to("/entry/${id}/edit");
    }
    
    //question(answer)
    public function getAnswerLength()
    {
        return mb_strlen($this->answer);
    }
    
    public function removeSpace()
    {
        $this->answer = preg_replace('/(\s|　)+/', '', $this->answer);
        $this->saveAnswer();
    }

    public function convertIntoZen()
    {
        $this->answer = mb_convert_kana($this->answer, "AK");
        $this->saveAnswer();
    }

    public function saveAnswer()
    {
        $this->question->answer = $this->answer;
        $this->question->save();
        $this->emit('answer-saved');
    }

    //template
    public function getTemplate()
    {
        $question_category = $this->getQuestionCategory();
        if(!$question_category) return false; 
        $templates = $question_category->templates;
        return $templates->where('word_count', $this->word_count)->first();
    }

    public function insertTemplate()
    {
        $this->answer = $this->getTemplate()->answer;
        $this->saveAnswer();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function updateTemplate()
    {
        $template = $this->getTemplate();
        if($template) {
            $template->answer = $this->answer;
            $template->save();
        }
    }
    
}