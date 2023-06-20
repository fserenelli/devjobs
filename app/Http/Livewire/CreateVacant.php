<?php

namespace App\Http\Livewire;

use App\Models\Salary;
use Livewire\Component;
use App\Models\Category;
use App\Models\Vacant;
use Livewire\WithFileUploads;

class CreateVacant extends Component
{
    public $title;
    public $salary;
    public $category;
    public $company;
    public $last_day;
    public $description;
    public $image;

    use WithFileUploads;

    protected $rules = [
        'title' => 'required|string',
        'salary' => 'required',
        'category' => 'required',
        'company' => 'required',
        'last_day' => 'required',
        'description' => 'required',
        'image' => 'required|image|max:1024'
    ];

    public function createVacant()
    {
        $data = $this->validate();

        $imageStore = $this->image->store('public/vacant');
        $data['image'] = str_replace('public/vacant/', '', $imageStore);

        Vacant::create([
            'title' => $data['title'],
            'salary_id' => $data['salary'],
            'category_id' => $data['category'],
            'company' => $data['company'],
            'last_day' => $data['last_day'],
            'description' => $data['description'],
            'image' => $data['image'],
            'user_id' => auth()->user()->id
        ]);

        session()->flash('message', 'Vacant Published');

        return redirect()->route('vacants.index');
    }

    public function render()
    {
        $salaries = Salary::all();
        $categories = Category::all();

        return view('livewire.create-vacant', [
            'salaries' => $salaries,
            'categories' => $categories,
        ]);
    }
}
