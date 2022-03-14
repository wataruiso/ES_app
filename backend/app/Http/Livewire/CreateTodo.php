<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class CreateTodo extends Component
{
    public $title;
    public $description;
    public $start_at;
    public $end_at;

    protected $rules = [
        'title' => 'required',
        'start_at' => 'date|after_or_equal:today',
    ];

    public function mount()
    {
        $this->start_at = \Util::getInitialDatetime();
        $this->end_at = \Util::getInitialDatetime();
    }

    public function render()
    {
        return view('livewire.todo.create');
    }

    public function save()
    {
        $this->validate();

        Todo::create([
            'user_id' => Auth::id(),
            'title' => $this->title,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'description' => $this->description,
            'is_done' => false,
        ]);

        $this->reset();
        return redirect()->to("/todo");
    }

    public function fixStartAt()
    {
        $this->start_at = \Util::fixStart($this->start_at, $this->end_at);
    }

    public function fixEndAt()
    {
        $this->end_at = \Util::fixEnd($this->start_at, $this->end_at);
    }
}
