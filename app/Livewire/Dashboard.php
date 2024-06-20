<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Task;
use App\Services\SortingService;
use Livewire\Component;

class Dashboard extends Component
{

    public $categories;
    public $updateNameTask;
    public $viewDescription = null;
    public $taskDescription = '';
    public $newTaskName = [];
    public $editingTask = null;

    public function mount()
    {
        $this->categories = Category::with('tasks')->get()->sortBy(function($category) {
            switch ($category->priority) {
                case 'high':
                    return 1;
                case 'medium':
                    return 2;
                case 'low':
                    return 3;
            }
        });
    }

    public function render()
    {
        return view('livewire.dashboard');
    }

    //Task
    public function showDescription(Task $task)
    {
        if ($this->viewDescription === $task->id) {
            $this->viewDescription = null;
        } else {
            $this->viewDescription = $task->id;
            $this->taskDescription = $task->description;
        }
    }

    public function editTask(Task $task)
    {
        $this->editingTask = $task->id;
        $this->updateNameTask = $task->name;
    }

    public function updateTask(Task $task)
    {
        $task->update(['name' => $this->updateNameTask]);
        $this->editingTask = null;
        toastr()->success('Tarefa atualizada com sucesso!');
    }

    public function doneTask(Task $task)
    {
        $task->update(['done' => !$task->done]);
        $this->mount();
    }

    public function addTask($categoryId, $index)
    {
        Task::create([
            'name' => $this->newTaskName[$index],
            'category_id' => $categoryId,
            'done' => false,
        ]);

        $this->mount();
        $this->newTaskName[$index] = '';

        toastr()->success('Tarefa adicionada com sucesso!');
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();
        $this->mount();
    }

    public function deleteTask(Task $task)
    {
        $task->delete();
        $this->mount();
        toastr()->success('Tarefa removida com sucesso!');
    }
}
