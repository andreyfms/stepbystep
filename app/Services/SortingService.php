<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Collection;

class SortingService
{
    public function sortByPriority(Collection $categories)
    {
        return $categories->sortByDesc(function ($category) {
            return $this->priorityToNumber($category->priority);
        });
    }

    private function priorityToNumber($priority)
    {
        switch ($priority) {
            case 'high':
                return 3;
            case 'medium':
                return 2;
            default:
                return 1;
        }
    }
}
