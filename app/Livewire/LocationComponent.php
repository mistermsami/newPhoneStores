<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\UserLocation;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class LocationComponent extends Component
{
    public $latitude;
    public $longitude;
    public $getlatitude;
    public $getlongitude;
    public $user_id; 
    protected $listeners = ['customerLocation' => 'setLocation','refreshComponent' => '$refresh', 'getlocation' => 'changeEvents' ];
    public $customer_id;
 
    public function mount($customer_id = null)
    {
        $this->customer_id = session('customer_id', ''); 
        // Check if a customer_id is passed or already set
        if ($customer_id) {
            $this->customer_id = $customer_id;
            $this->changeEvents($customer_id);
        } elseif ($this->customer_id) {
            // If the customer_id is already set, call changeEvents
            $this->changeEvents($this->customer_id);
        }
    }
    public function changeEvents($customer_id)
    {   
        $UserLocation = UserLocation::where('user_id', $customer_id)->first();
        if ($UserLocation) {  // This checks if $UserLocation is not null 
            $this->getlatitude = $UserLocation->latitude;
            $this->getlongitude = $UserLocation->longitude;
            Session::put('customer_id', $customer_id);
            $this->dispatch('locationUpdated', ['latitude' =>  $UserLocation->latitude, 'longitude' =>  $UserLocation->longitude]);
        } else {
            // Handle the case where no UserLocation was found
            // dd('No location found for this user');
            $this->getlatitude = 'Not detected';
            $this->getlongitude = 'Not detected';
            $this->user_id = 'Not detected';
        } 
    }
    public function setLocation($latitude, $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        UserLocation::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'latitude' => $latitude,
                'longitude' => $longitude
            ],
        );
    }

    public function render()
    { 
        $customers = User::get(['id', 'name']);
        return view('livewire.location-component', [
            'customers' => $customers,
        ]);
    }
}
