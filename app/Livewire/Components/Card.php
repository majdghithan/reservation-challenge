<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Card extends Component
{

    public $building;

    public function mount($building): void
    {
        $this->building = $building;
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.components.card');
    }
}
