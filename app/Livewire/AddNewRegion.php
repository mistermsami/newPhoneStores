<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Rota;
use App\Models\Addresses;
use App\Models\Cities;
use App\Models\Regions;
class AddNewRegion extends Component
{
    public $userSelected, $citySelected, $regionSelected;
    public $newaddress, $newpostcode;
    public $regions = [];

    protected $listeners = ['cityAdded' => 'refreshCities', 'RegionAdded' => 'refreshRegions'];
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
        // Debug form submission
        // dd($this->regionSelected, $this->newaddress, $this->newpostcode);

        $validatedData = $this->validate([
            'citySelected' => 'required|not_in:0',
            'regionSelected' => 'required|not_in:0',
            'newaddress' => 'required',
            'newpostcode' => 'required',
        ]);

        // Check if address already exists
        if (Addresses::where('postcode', $this->newpostcode)
            ->exists())
        {
            session()->flash('erralreadyexist', 'Postcode already exists!');
        } else {
            try {
                // Insert new address
                $newAddress = Addresses::create([
                    'region_id' => $this->regionSelected,
                    'rota_address' => $this->newaddress,
                    'postcode' => $this->newpostcode,
                ]);

                if ($newAddress) {
                    session()->flash('success', 'Data saved successfully!');
                    $this->reset(['regionSelected', 'newaddress', 'newpostcode', 'citySelected']);
                    $this->dispatch('newDetailsadded');  // Proper dispatch
                }
            } catch (\Exception $e) {
                session()->flash('erralreadyexist', 'something went wrong');  // Display error message
                // session()->flash('erralreadyexist', $e->getMessage());  // Display error message
            }
        }
    }


    public function render()
    {
        $cities = Cities::all();
        return view('livewire.add-new-region', ['cities' => $cities]);
    }
}

