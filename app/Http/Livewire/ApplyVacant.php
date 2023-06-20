<?php

namespace App\Http\Livewire;

use App\Models\Vacant;
use App\Notifications\NewCandidate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ApplyVacant extends Component
{
    public $cv;
    public $vacant;

    protected $rules = [
        'cv' => 'required|mimes:pdf',
    ];

    use WithFileUploads;

    public function mount(Vacant $vacant)
    {
        $this->vacant = $vacant;
    }

    public function apply()
    {
        $this->validate();

        $cvStore = $this->cv->store('public/cv');
        $data['cv'] = str_replace('public/cv/', '', $cvStore);

        $this->vacant->candidates()->create([
            'user_id' => auth()->user()->id,
            'cv' => $data['cv']
        ]);

        $this->vacant->recruiter->notify(new NewCandidate($this->vacant->id, $this->vacant->title, auth()->user()->id));

        session()->flash('message', 'You apply vacant!');

        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.apply-vacant');
    }
}
