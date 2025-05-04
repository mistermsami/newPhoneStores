<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\Rota;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads; // Include Livewire's file upload trait

class RotaTable extends Component
{
    use WithPagination;
    use WithFileUploads;
    // protected $paginationTheme = 'bootstrap';
    public $listeners =['rotastatus-updated' =>'refreshRender'];
    public $perPage = 15;

    public $search = '';

    public $sortField = 'name';

    public $sortAsc = 'desc';
    public $assignedrotaid;
    public $newImage;
    public $rotavisitimage;
    public $rotastatus;
    public $rotaupdateid;
    public $saysomething;


    // public function statusupdateforms()
    // {
    //     dd($this->saysomething);
        // dd("as");
        // Validate the form data
        // $validatedData = $this->validate([
        //     'rotastatus' => 'required',
        //     'newImage' => 'required',
        //     // 'newImage' => 'nullable|image|max:1024' // Validate the image upload (optional)
        // ]);


        // Handle image upload if a new image is uploaded
        // if ($this->newImage instanceof \Illuminate\Http\UploadedFile) {
        //     // Handle image upload if a new image is uploaded
        //     if ($this->rotavisitimage) {
        //         Storage::delete($this->rota->rotavisit_image);
        //     }
        //     // Store the new image
        //     $imagePath = $this->newImage->store('rotavisit_images', 'public'); // Specify the disk if necessary
        // } else {
        //     // Keep the existing image if no new image is uploaded
        //     $imagePath = $this->rota->rotavisit_image;

        // }
        // dd($imagePath, $this->rotastatus);

        // Update the Rota with the new data
        // Rota::where('rota_id', $this->rotaupdateid)
        //     ->update([
        //         'rota_status' => $this->rotastatus,
        //         'rotavisit_image' => $imagePath,
        // ]);


        // session()->flash('statuupdatesucess', 'Rota updated successfully!');
        // Trigger the JavaScript event for redirection
        // $this->dispatch('rotastatus-updated');
    // }
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
    public function deleteRota($rotaId)
    {
        // Find the rota and delete it
        $rota = Rota::find($rotaId);

        if ($rota) {
            $rota->delete();
            session()->flash('success', 'Rota deleted successfully!');
        } else {
            session()->flash('error', 'Rota not found!');
        }
    }
    public function refreshRender(){
        $this->render();
    }

    public function render()
    {
        if(auth()->user()->role == 'user'){
            $query = Rota::with('User', 'Addresses', 'Regions', 'Cities')
                    ->where('user_id', auth()->user()->id)
                    ->search($this->search);

            // Handle sorting by user name if sortField is 'name'
            if ($this->sortField === 'name') {
                $query->join('users', 'rota.user_id', '=', 'users.id')
                    ->orderBy('users.name', $this->sortAsc ? 'asc' : 'desc');
            } else {
                // Default sorting on fields within the rota table
                $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
            }
        }
        else{
            $query = Rota::with('User', 'Addresses', 'Regions', 'Cities')
                    ->search($this->search);

            // Handle sorting by user name if sortField is 'name'
            if ($this->sortField === 'name') {
                $query->join('users', 'rota.user_id', '=', 'users.id')
                    ->orderBy('users.name', $this->sortAsc ? 'asc' : 'desc');
            } else {
                // Default sorting on fields within the rota table
                $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
            }
        }


        $rota = $query->paginate($this->perPage);

        return view('livewire.rota-table', ['rota' => $rota]);
    }


}
