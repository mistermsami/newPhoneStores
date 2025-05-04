<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cities;

class RotanewCity extends Component
{
    public $newcity;
    public function addCity(){
        Cities::create([
            'city_name' => $this->newcity,
        ]);
        $this->dispatch('cityAdded');
        session()->flash('newcitysuccess', value: 'City added successfully!');
        $this->dispatch('closecitymodal');

        // // Optionally, reset the new city input
        $this->newcity = '';


    }
    public function render()
    {
        return view('livewire.rotanew-city');
    }
}
