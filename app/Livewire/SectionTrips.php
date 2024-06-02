<?php

namespace App\Livewire;

use App\Models\Trip;
use Livewire\Component;

class SectionTrips extends Component
{
    public $trips;


    public function render()
    {
        $this->trips = Trip::where('date_of_trip','>' ,\Carbon\Carbon::today())->orderBy('date_of_trip')->take(9)->get();
        return view('livewire.section-trips');
    }
}
