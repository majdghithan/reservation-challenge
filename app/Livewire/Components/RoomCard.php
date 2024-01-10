<?php

namespace App\Livewire\Components;

use Livewire\Component;

class RoomCard extends Component
{
    public $room;
    public $price;

    public function mount($room): void
    {
        $this->price = $this->room->current_price;
    }
    public function render()
    {
        return view('livewire.components.room-card');
    }
}
