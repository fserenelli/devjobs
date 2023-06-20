<?php

namespace App\Http\Livewire;

use App\Models\Salary;
use Livewire\Component;
use App\Models\Category;

class FilterVacants extends Component
{
    public $term;
    public $category;
    public $salary;

    public function formData()
    {
        $this->emit('searchTerm', $this->term, $this->category, $this->salary);
    }

    public function render()
    {
        $salaries = Salary::all();
        $categories = Category::all();

        return view('livewire.filter-vacants', [
            'salaries' => $salaries,
            'categories' => $categories
        ]);
    }
}
