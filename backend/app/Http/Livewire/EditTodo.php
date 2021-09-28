<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Carbon;

class EditTodo extends Component
{
    public $todo;
    public $title;
    public $description;
    public $entry_id;
    public $start_at;
    public $end_at;
    public $is_done;

    protected $rules = [
        'title' => 'required',
        'start_at' => 'date|after_or_equal:today',
    ];

    public function mount($todo)
    {
        $this->title = $todo->title;
        $this->description = $todo->description;
        $this->entry_id = $todo->entry_id;
        $this->start_at = \Util::getFormDatetime($todo->start_at);
        $this->end_at = \Util::getFormDatetime($todo->end_at);
        $this->is_done = $todo->is_done;
    }

    public function render()
    {
        return view('livewire.todo.edit');
    }

    public function save()
    {
        $this->validate();

        $this->todo->title = $this->title;
        $this->todo->description = $this->description;
        $this->todo->entry_id = $this->entry_id;
        $this->todo->start_at = $this->start_at;
        $this->todo->end_at = $this->end_at;
        $this->todo->is_done = $this->is_done;

        $this->todo->save();
    }

    
    public function saveStartAt()
    {
        $this->end_at = \Util::fixEnd($this->start_at, $this->end_at);
        $this->save();
    }
    
    public function saveEndAt()
    {
        $this->start_at = \Util::fixStart($this->start_at, $this->end_at);
        $this->save();
    }

    public function delete()
    {
        $this->todo->delete();
        return redirect()->to("/todo");
    }
}
