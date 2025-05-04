<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Regions;
use App\Models\Addresses;

class RotanewAddress extends Component
{
    public $regionSelected, $newaddress, $newpostcode;
    protected $listeners = ['RegionAdded' => 'refreshRegions'];
    public function refreshRegions()
    {
        $this->render();
    }
    public function addAddress()
    {
        Addresses::create([
            'region_id' => $this->regionSelected,
            'rota_address' => $this->newaddress,
            'postcode' => $this->newpostcode,
        ]);
        $this->dispatch('addressAdded');
        session()->flash('newcaddresssuccess', value: 'Address and PostCode added successfully!');
        $this->dispatch('closeaddressmodal');

        // // Optionally, reset the new city input
        $this->regionSelected = '';
        $this->newaddress = '';
        $this->newpostcode = '';
    }
    public function render()
    {
        $allregions = Regions::all();
        return view('livewire.rotanew-address', ['allregions' => $allregions]);
    }
}
