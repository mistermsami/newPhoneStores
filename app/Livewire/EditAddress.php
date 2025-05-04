<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cities;
use App\Models\Regions;
use App\Models\Addresses;

class EditAddress extends Component
{
    public $userSelected, $citySelected, $regionSelected, $cityName;
    public $newaddress, $newpostcode;
    public $regions = [];
    public $thisaddress_id; // Add this to hold the address being edited

    protected $listeners = ['cityAdded' => 'refreshCities', 'RegionAdded' => 'refreshRegions'];

    // Listen to address_id to load the data if editing
    public function mount()
    {

        // dd($this->thisaddress_id);
        if ($this->thisaddress_id) {
            // Load existing data for editing
            $address = Addresses::find($this->thisaddress_id);
            if ($address) {
                $this->citySelected = $address->Regions->Cities->city_id;
                $this->cityName = $address->Regions->Cities->city_name;
                $this->regionSelected = $address->region_id;
                $this->newaddress = $address->rota_address;
                $this->newpostcode = $address->postcode;

                // Load regions for selected city
                $this->searchRegions();
            }
        }
    }

    public function refreshCities()
    {
        $this->render();
    }

    public function refreshRegions()
    {
        $this->searchRegions();
    }

    public function searchRegions()
    {
        if ($this->citySelected) {
            $this->regions = Regions::where('city_id', $this->citySelected)->get();
        }
    }

    public function saveRota()
    {
        $editthisaddress = Addresses::where('address_id', $this->thisaddress_id);
        // Validate form input
        $validatedData = $this->validate([
            'regionSelected' => 'required|not_in:0',
            'newaddress' => 'required',
            'newpostcode' => 'required',
        ]);

        try {
            // Update or create address record
            $address = $editthisaddress->update([
                    'region_id' => $this->regionSelected,
                    'rota_address' => $this->newaddress,
                    'postcode' => $this->newpostcode,
                ]
            );

            session()->flash('success', 'Data ' . ($this->thisaddress_id ? 'updated' : 'saved') . ' successfully!');
            $this->reset(['regionSelected', 'newaddress', 'newpostcode', 'citySelected']);
            $this->dispatch('newDetailsadded'); // Trigger an event
            return view('rota.viewregions');

        } catch (\Exception $e) {
            session()->flash('erralreadyexist', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $cities = Cities::all();
        return view('livewire.edit-address', ['cities' => $cities]);
    }
}

