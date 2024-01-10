<?php

namespace App\Livewire;

use App\Models\Building;
use Livewire\Component;

class ShowBuilding extends Component
{

    public Building $building;

    public function mount(): void
    {
        $this->building->load('rooms');
    }
    public function render(): \Illuminate\View\View
    {
        return view('livewire.show-building');
    }
}
