<?php

namespace App\Livewire;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class HeaderNavbar extends Component
{
    public $locale;

    public function render()
    {
        $this->locale = Session::get('locale') ?? 'en';
        return view('livewire.header-navbar');
    }
}
