<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;
use Flasher\Toastr\Prime\Toastr;

class FormTask extends Component
{
    use WithPagination;

    public $categories;
    public $editing = false;
    public $descriptionTaskId = false;
    public $confirmingTaskDeletion = false;
    public $taskToDelete = null;

    public $form = [
        'id' => null,
        'category_id' => null,
        'description' => null,
        'name' => null,
    ];

    protected $rules = [
        'form.name' => 'required|string|max:255|unique:tasks,name',
        'form.category_id' => 'required|exists:categories,id',
        'form.description' => 'nullable|string',
    ];

    protected $messages = [
        'form.name.required' => 'O campo título é obrigatório.',
        'form.name.unique' => 'Já existe uma tarefa com esse título.',
        'form.category_id.required' => 'O campo categoria é obrigatório.',
        'form.category_id.exists' => 'Categoria inválida.',
    ];

    public function save()
    {

        if ($this->form['id']) {
            Task::find($this->form['id'])->update($this->form);
            toastr()->success('Tarefa atualizada com sucesso.');
        } else {
            $this->validate();
            Task::create($this->form);
            toastr()->success('Tarefa criada com sucesso.');
        }

        $this->cleanData();
    }

    public function update(Task $task)
    {
        $this->form = $task->toArray();
        $this->editing = true;
    }

    public function cleanData()
    {
        $this->form = [
            'id' => null,
            'category_id' => null,
            'description' => null,
            'name' => null,
        ];
        $this->editing = false;
    }

    public function doneTask(Task $task)
    {
        $task->update(['done' => !$task->done]);
        toastr()->success('Tarefa finalizada com sucesso!');
    }

    public function toggleDescription($task_id)
    {
        $this->descriptionTaskId = $this->descriptionTaskId === $task_id ? null : $task_id;
    }

    public function confirmDelete(Task $task)
    {
        $this->confirmingTaskDeletion = true;
        $this->taskToDelete = $task;
    }

    public function delete()
    {
        if ($this->taskToDelete) {
            $this->taskToDelete->delete();
            toastr()->success('Tarefa deletada com sucesso.');
            $this->confirmingTaskDeletion = false;
            $this->taskToDelete = null;
        }
        $this->mount();
    }

    public function mount()
    {
        $this->categories = Category::with('tasks')->get();
    }

    public function render()
    {
        return view('livewire.form-task');
    }
}
