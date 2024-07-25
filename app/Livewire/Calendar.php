<?php

namespace App\Livewire;
use App\Models\Booking;
use Carbon\Carbon;

use Livewire\Component;

class Calendar extends Component
{
        public $events = [];

    public function mount()
    {
        $this->loadEvents();
    }

    public function loadEvents()
    {
        $this->events = Booking::select('start', 'end', 'keperluan')->get();
    }
    public function render()
    {
        return view('livewire.calendar');
    }
}
