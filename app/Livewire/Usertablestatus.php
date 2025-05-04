<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use App\Models\Rota;

class Usertablestatus extends Component
{
    use WithFileUploads;

    public $assignedrotaid;
    public $newImage;
    public $rotavisitimage;
    public $rotastatus;
    public $rotaupdateid;
    public $thisrota_id;
    public $saysomething;
    public $statusSelected;

    public function statusupdateforms()
    {
        try {
            // Validate the form data
            $validatedData = $this->validate([
                'rotastatus' => 'required',
                'newImage' => $this->newImage ? 'required|image' : 'nullable',
            ]);
            $updatethisrec = Rota::where('rota_id', $this->thisrota_id)->first();
            // Handle image upload if a new image is uploaded
            if ($this->newImage instanceof \Illuminate\Http\UploadedFile) {
                if ($this->rotavisitimage) {
                    Storage::delete($updatethisrec->rotavisit_image); // Delete existing image if present
                }
                // Store the new image
                $imagePath = $this->newImage->store('rotavisit_images', 'public');
            } else {
                // Keep the existing image if no new image is uploaded
                $imagePath = $updatethisrec->rotavisit_image;
            }

            // Find the record to update
            $updatethisrec = Rota::where('rota_id', $this->thisrota_id)->first();
            // dd($imagePath);
            if ($updatethisrec) {
                // Update the Rota with the new data
                $updatethisrec->rota_status = $this->rotastatus;
                $updatethisrec->rotavisit_image = $imagePath;

                // Save the updated record
                $updatethisrec->save();

                // Success message
                session()->flash('statuupdatesucess', 'Rota updated successfully!');
                $this->newImage = '';
                $this->rotastatus = '';

                $this->dispatch('rotastatus-updated'); // Trigger the event
                $this->dispatch('close-modal');
            } else {
                // Error message if no record is found
                session()->flash('statusupdateerror', 'Rota not found, update failed.');
            }
        } catch (\Exception $e) {
            // Error handling
            session()->flash('statusupdateerror', $e);
        }
    }

    public function render()
    {
        $rota = Rota::where('rota_id', $this->thisrota_id)->first();
        $this->rotastatus = $rota->rota_status;
        return view('livewire.usertablestatus', ['rota' => $rota]);
    }
}
