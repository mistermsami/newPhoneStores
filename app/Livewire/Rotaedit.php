<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Cities;
use App\Models\Regions;
use App\Models\Addresses;
use App\Models\Rota;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads; // Include Livewire's file upload trait
class Rotaedit extends Component
{
    use WithFileUploads;
    public $rota_id;
    public $rota;  // Holds the Rota model instance
    public $userSelected, $citySelected, $regionSelected, $addressSelected, $postcodeSelected, $dateAssigned, $rotastatus, $rotavisitimage, $newImage;
    public $regions = [], $addresses = [], $postcode = [];

    protected $listeners = ['cityAdded' => 'refreshCities', 'RegionAdded' => 'refreshRegions', 'addressAdded' => 'refreshAddress'];

    // Mount method to load the existing Rota
    public function mount($rota_id)
    {
        // Load the existing Rota
        $this->rota = Rota::with('Addresses')->findOrFail($rota_id);
        // $this->rota = Rota::with('User', 'Cities', 'Regions', 'Addresses')->findOrFail($rota_id);
        // Set the form fields based on the existing Rota data
        // dd($this->rota->Addresses->postcode);
        $this->userSelected = $this->rota->user_id;
        $this->citySelected = $this->rota->city_id;
        $this->regionSelected = $this->rota->region_id;
        $this->addressSelected = $this->rota->address_id;
        $this->postcodeSelected = $this->rota->address_id;
        $this->dateAssigned = $this->rota->date_assigned;
        $this->rotastatus = $this->rota->rota_status;
        $this->rotavisitimage = $this->rota->rotavisit_image;
        // dd($this->rotastatus);
        // Preload regions, addresses, and postcode based on selected city and region
        $this->searchRegions();
        $this->searchAddresses();
        $this->searchPostcode();
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
        // Validate the form data
        $validatedData = $this->validate([
            'userSelected' => 'required|not_in:0',
            'citySelected' => 'required|not_in:0',
            'regionSelected' => 'required|not_in:0',
            'addressSelected' => 'required|not_in:0',
            'postcodeSelected' => 'required|not_in:0',
            'dateAssigned' => 'required|date',
            'rotastatus' => 'required',
            // 'newImage' => 'nullable|image|max:1024' // Validate the image upload (optional)
        ]);


        // Handle image upload if a new image is uploaded
        if ($this->newImage instanceof \Illuminate\Http\UploadedFile) {
            // Handle image upload if a new image is uploaded
            if ($this->rotavisitimage) {
                Storage::delete($this->rota->rotavisit_image);
            }
            // Store the new image
            $imagePath = $this->newImage->store('rotavisit_images', 'public'); // Specify the disk if necessary
        } else {
            // Keep the existing image if no new image is uploaded
            $imagePath = $this->rota->rotavisit_image;

        }
        // dd($imagePath);

        // Update the Rota with the new data
        $this->rota->update([
            'user_id' => $this->userSelected,
            'city_id' => $this->citySelected,
            'region_id' => $this->regionSelected,
            'address_id' => $this->addressSelected,
            'postcode_id' => $this->postcodeSelected,
            'date_assigned' => $this->dateAssigned,
            'rota_status' => $this->rotastatus,
            'rotavisit_image' => $imagePath,
        ]);

        session()->flash('editsuccess', 'Rota updated successfully!');
        // Trigger the JavaScript event for redirection
        $this->dispatch('rota-updated');
    }

    public function render()
    {
        if(auth()->user()->role == 'user'){
            $rotadata = Rota::with('User', 'Cities', 'Regions', 'Addresses')->where('rota_id' , $this->rota_id)->first();
            $users = User::where('role', 'user')->get();
            $cities = Cities::all();
            return view('livewire.rotaedit', ['users' => $users, 'cities' => $cities, 'rotadata' => $rotadata]);
        }
        else{
            $users = User::where('role', 'user')->get();
            $cities = Cities::all();
            return view('livewire.rotaedit', ['users' => $users, 'cities' => $cities]);
        }
    }
}
