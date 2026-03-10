<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;

class FastDashboard extends Component
{
    public $task_name, $priority = 'Medium', $search = '';

    protected $rules = [
        'task_name' => 'required|min:3',
        'priority' => 'required'
    ];

    public function addTask()
    {
        $this->validate();

        Task::create([
            'task_name' => $this->task_name,
            'priority' => $this->priority,
        ]);

        $this->reset(['task_name', 'priority']);
        session()->flash('message', 'Tugas berhasil ditambahkan secara instan!');
    }

    public function deleteTask($id)
    {
        Task::find($id)->delete();
    }

    public function render()
    {
        return view('livewire.fast-dashboard', [
            'tasks' => Task::where('task_name', 'like', '%'.$this->search.'%')
                           ->orderBy('created_at', 'desc')
                           ->get()
        ]);
    }
}