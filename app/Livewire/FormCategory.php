<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Task;
use Livewire\Component;
use Flasher\Toastr\Prime\Toastr;


class FormCategory extends Component
{
    public $form = [
        'id' => null,
        'name' => null,
        'priority' => null,
    ];
    public $editing = false;
    public $showTasks = null;

    public $categories = [];
    public $confirmingDeletion = false;
    public $categoryToDelete = null;


    protected $rules = [
        'form.name' => 'required|string|max:255|unique:categories,name',
        'form.priority' => 'required|in:high,medium,low',
    ];

    protected $messages = [
        'form.name.required' => 'O título é obrigatório.',
        'form.name.string' => 'O título deve ser um texto.',
        'form.name.unique' => 'Já existe uma categoria com esse título.',
        'form.name.max' => 'O título não pode ter mais que 255 caracteres.',
        'form.priority.required' => 'A prioridade é obrigatória.',
        'form.priority.in' => 'A prioridade deve ser alta, média ou baixa.',
    ];


    public function save()
    {
        $this->validate();

        if ($this->editing) {
            Category::find($this->form['id'])->update($this->form);
            toastr()->success('Categoria atualizada com sucesso!');
        } else {
            Category::create($this->form);
            toastr()->success('Categoria criada com sucesso!');
        }

        $this->cleanData();
        $this->mount();
    }

    public function delete()
    {
        if ($this->categoryToDelete) {
            $this->categoryToDelete->delete();
            toastr()->success('Categoria deletada com sucesso.');
            $this->confirmingDeletion = false;
            $this->categoryToDelete = null;
        }
        $this->mount();
    }
    public function confirmDelete(Category $category)
    {
        $this->confirmingDeletion = true;
        $this->categoryToDelete = $category;
    }

    public function edit(Category $category)
    {
        $this->form = $category->toArray();
        $this->editing = true;
    }

    public function show($categoryId)
    {
        if ($this->showTasks === $categoryId) {
            $this->showTasks = null;
        } else {
            $this->showTasks = $categoryId;
        }
    }

    public function cleanData()
    {
        $this->form = [
            'id' => null,
            'name' => null,
            'priority' => null,
        ];
        $this->editing = false;
    }

    public function mount()
    {
        $this->categories = Category::with('tasks')->get();
    }

    public function render()
    {
        return view('livewire.form-category');
    }
}
