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

    public function mount($todo)
    {
        $this->title = $todo->title;
        $this->description = $todo->description;
        $this->entry_id = $todo->entry_id;
        $this->start_at = $todo->start_at;
        $this->end_at = $todo->end_at;
        $this->is_done = $todo->is_done;
    }

    public function render()
    {
        return view('livewire.todo.edit');
    }
}
