<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cities;
use App\Models\Regions;
use Illuminate\Support\Facades\Validator;

class RotanewRegion extends Component
{
    public $newregion, $citySelected;

    protected $listeners = ['cityAdded' => 'refreshCities'];
    public function refreshCities(){
        $this->render();
    }
    public function addRegion()
    {
        // $validatedData = $this->validate([
        //         'newregion' => 'required',
        //         'citySelected' => 'required,'
        //     ]);
        Regions::create([
            'region_name' => $this->newregion,
            'city_id' => $this->citySelected,
        ]);
        $this->dispatch('RegionAdded');
        session()->flash('newcregionsuccess', value: 'Region added successfully!');
        $this->dispatch('closeregionmodal');

        // // Optionally, reset the new city input
        $this->newregion = '';
        $this->citySelected = '';
    }
    public function render()
    {
        $allcities = Cities::all();
        return view('livewire.rotanew-region', ['allcities' => $allcities]);
    }
}
