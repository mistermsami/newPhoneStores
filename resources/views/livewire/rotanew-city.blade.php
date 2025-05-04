<div>
    <form wire:submit.prevent="addCity">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="cityName" class="form-label required">City Name</label>
                    <input type="text" class="form-control" id="cityName" wire:model="newcity">
                    @error('newcity')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="modal-footer">
            @if (session('newcitysuccess'))
                <span class="p-2 rounded text-bg-success">{{ session('newcitysuccess') }}</span>
            @endif
            <!-- The form submits when this button is clicked -->
            <button type="submit"  class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </form>

    <script>
        document.addEventListener('closecitymodal', event => {
            // Close the modal using Bootstrap's modal instance
            const modal = document.querySelector(`#addcity`); // Replace with your modal's actual ID
            const modalInstance = bootstrap.Modal.getInstance(modal);
            modalInstance.hide();
        });
    </script>
</div>
