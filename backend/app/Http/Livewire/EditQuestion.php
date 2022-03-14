<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \App\Models\QuestionCategory;
use \App\Models\Template;
use Illuminate\Support\Facades\Auth;

class EditQuestion extends Component
{
    //レコード
    public $question;
    //カラム
    public $name;
    public $word_count;
    public $answer;
    //モデル
    public $question_category;

    protected $rules = [
        'name' => 'required',
        'word_count' => 'required|numeric|min:20',
    ];

    public function mount($question)
    {
        $this->name = $question->name;
        $this->word_count = $question->word_count;
        $this->answer = $question->answer;
        $this->question_category = new QuestionCategory();
    }

    public function render()
    {
        return view('livewire.question.edit');
    }

    public function save()
    {
        $this->validate();

        $this->question->name = $this->name;
        $this->question->question_category_id = $this->question_category->getQuestionCategoryId($this->name);
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
    public function getTemplateQuestion()
    {
        $question_category = $this->question_category->getQuestionCategory($this->name);
        if(!$question_category) return false; 
        $template_question = $question_category->templateQuestions->where('word_count', $this->word_count)->first();
        return $template_question;
    }

    public function getTemplate()
    {
        return $this->getTemplateQuestion() ? $this->getTemplateQuestion()->template : false;
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
        }else {
            Template::create([
                'user_id' => Auth::id(),
                'template_question_id' => $this->getTemplateQuestion()->id,
                'answer' => $this->answer,
            ]);
        }
    }
    
}
