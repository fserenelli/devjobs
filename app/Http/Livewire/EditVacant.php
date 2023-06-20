<?php

namespace App\Http\Livewire;

use App\Models\Salary;
use App\Models\Vacant;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class EditVacant extends Component
{
    public $vacant_id;
    public $title;
    public $salary;
    public $category;
    public $company;
    public $last_day;
    public $description;
    public $image;
    public $new_image;

    use WithFileUploads;

    protected $rules = [
        'title' => 'required|string',
        'salary' => 'required',
        'category' => 'required',
        'company' => 'required',
        'last_day' => 'required',
        'description' => 'required',
        'new_image' => 'nullable|image|max:1024'
    ];


    public function mount(Vacant $vacant)
    {
        $this->vacant_id = $vacant->id;
        $this->title = $vacant->title;
        $this->salary = $vacant->salary_id;
        $this->category = $vacant->category_id;
        $this->company = $vacant->company;
        $this->last_day = Carbon::parse($vacant->last_day)->format('Y-m-d');
        $this->description = $vacant->description;
        $this->image = $vacant->image;
    }

    public function editVacant(Vacant $vacant)
    {
        $data = $this->validate();

        if ($this->new_image) {
            $imageStore = $this->new_image->store('public/vacant');
            $data['image'] = str_replace('public/vacant/', '', $imageStore);
        }

        $vacant = Vacant::find($this->vacant_id);

        $vacant->title = $data['title'];
        $vacant->salary_id = $data['salary'];
        $vacant->category_id = $data['category'];
        $vacant->company = $data['company'];
        $vacant->last_day = $data['last_day'];
        $vacant->description = $data['description'];
        $vacant->image = $data['image'] ?? $vacant->image;

        $vacant->save();

        session()->flash('message', 'Vacant Edited');

        return redirect()->route('vacants.index');
    }

    public function render()
    {
        $salaries = Salary::all();
        $categories = Category::all();

        return view('livewire.edit-vacant', [
            'salaries' => $salaries,
            'categories' => $categories,
        ]);
    }
}
