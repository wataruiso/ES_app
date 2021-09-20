<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateTodo extends Component
{
    public $title;
    public $description;
    public $start_at;
    public $end_at;
    public $is_done;

    public function mount()
    {
        $this->start_at = \Util::getInitialDatetime();
        $this->end_at = \Util::getInitialDatetime();
    }

    public function render()
    {
        return view('livewire.todo.create');
    }
}
