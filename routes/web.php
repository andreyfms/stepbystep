<?php

use App\Livewire\FormTask;
use App\Livewire\FormCategory;
use App\Livewire\Dashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', Dashboard::class)->name('home');

Route::get('/tasks', FormTask::class)->name('tasks');

Route::get('/categories', FormCategory::class)->name('categories');
