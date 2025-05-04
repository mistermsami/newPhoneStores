<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cities;
use App\Models\Regions;
use App\Models\Addresses;
use Livewire\WithPagination;
class ViewRegions extends Component
{
    use WithPagination;
    public $perPage = 10;

    public $search = '';
    public $sortField = 'rota_address';

    public $sortAsc = 'desc';
    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function updatingSearch()
    {
        $this->resetPage(); // Reset to the first page when search query changes
    }
    public function deleteregion($addID){
        $findaddress = Addresses::find($addID);

        if ($findaddress) {
            $findaddress->delete();
            session()->flash('success', 'Address deleted successfully!');
        } else {
            session()->flash('error', 'Address not found!');
        }
    }
    public function render()
    {
        // Fetching the records with sorting and search functionality
        $viewRecords = Addresses::query()
            ->join('regions', 'addresses.region_id', '=', 'regions.region_id') // Join regions table
            ->join('cities', 'regions.city_id', '=', 'cities.city_id') // Join cities table
            ->where(function ($query) {
                // Search conditions
                $query
                    ->where('cities.city_name', 'like', '%' . $this->search . '%') // Searching in cities' city_name
                    ->orWhere('regions.region_name', 'like', '%' . $this->search . '%') // Searching in regions' region_name
                    ->orWhere('addresses.rota_address', 'like', '%' . $this->search . '%') // Searching in addresses' rota_address
                    ->orWhere('addresses.postcode', 'like', '%' . $this->search . '%'); // Searching in addresses' postcode
            })
            ->orderBy($this->sortField === 'city_name' ? 'cities.city_name' : ($this->sortField === 'region_name' ? 'regions.region_name' : 'addresses.' . $this->sortField), $this->sortAsc === 'asc' ? 'asc' : 'desc')
            ->select('addresses.*') // Selecting addresses fields
            ->with('Regions.Cities') // Eager loading the relationships
            ->paginate($this->perPage);

        return view('livewire.view-regions', ['viewRecords' => $viewRecords]);
    }
}
