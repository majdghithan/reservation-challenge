<?php

namespace App\Livewire;

use App\Models\Building;
use Livewire\Attributes\Title;
use Livewire\Component;

class Home extends Component
{
    #[Title('Home Page')]
    public function render(): \Illuminate\View\View
    {
        $buildings = Building::with('rooms', 'propertyType')->orderBy('created_at', 'DESC')->simplePaginate(4);
        return view('livewire.home', compact('buildings'));
    }


}
