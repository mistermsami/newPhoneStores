<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Cities;
use App\Models\Regions;
use App\Models\Addresses;
use App\Models\Rota;
use Illuminate\Support\Facades\Validator;

class RotaCreate extends Component
{
    public $userSelected, $citySelected, $regionSelected, $addressSelected, $postcodeSelected, $dateAssigned;
    public $regions = [],
        $addresses = [],
        $postcode = [];

    protected $listeners = ['cityAdded' => 'refreshCities', 'RegionAdded' => 'refreshRegions', 'addressAdded' => 'refreshAddress', 'newDetailsadded' => 'refreshAll'];

    public function refreshAll(){
        $this->refreshCities();
        $this->refreshRegions();
        $this->refreshAddress();
    }
    public function refreshCities()
    {
        $this->render();
    }
    public function refreshRegions()
    {
        $this->searchRegions();
    }
    public function refreshAddress()
    {
        $this->searchAddresses();
        $this->searchPostcode();
    }
    public function searchRegions()
    {
        if ($this->citySelected) {
            $this->regions = Regions::where('city_id', $this->citySelected)->get();
        }
    }

    public function searchAddresses()
    {
        if ($this->regionSelected) {
            $this->addresses = Addresses::where('region_id', $this->regionSelected)->get();
        }
    }

    public function searchPostcode()
    {
        if ($this->addressSelected) {
            $this->postcode = Addresses::where('address_id', $this->addressSelected)->get();
        }
    }
    public function saveRota()
    {
        // dd($this->dateAssigned);
        $validatedData = $this->validate([
            'userSelected' => 'required|not_in:0',
            'citySelected' => 'required|not_in:0',
            'regionSelected' => 'required|not_in:0',
            'addressSelected' => 'required|not_in:0',
            'postcodeSelected' => 'required|not_in:0',
            'dateAssigned' => 'required|date',
        ]);
        if (
            Rota::where('city_id', $this->citySelected)
                ->where('region_id', $this->regionSelected)
                ->where('address_id', $this->addressSelected)
                ->where('date_assigned', $this->dateAssigned)
                ->exists()
        ) {
            session()->flash('erralreadyexist', 'Rota already assigned on this date!');
        } else {
            Rota::create([
                'user_id' => $this->userSelected,
                'city_id' => $this->citySelected,
                'region_id' => $this->regionSelected,
                'address_id' => $this->addressSelected,
                // 'postcode_id' => $this->postcodeSelected,
                'date_assigned' => $this->dateAssigned,
            ]);

            session()->flash('success', 'Rota saved successfully!');
        }
    }

    public function render()
    {
        $users = User::where('role', 'user')->get();
        $cities = Cities::all();
        return view('livewire.rota-create', ['users' => $users, 'cities' => $cities]);
    }
}
