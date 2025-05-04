<div>
    <form wire:submit.prevent="addAddress">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="regionSelected" class="form-label">Select Region/label>
                    <select class="form-control" wire:model="regionSelected">
                        <option value="0" selected>-- Select Region --</option>
                        @foreach ($allregions as $region)
                            <option value="{{ $region->region_id }}">{{ $region->region_name }}</option>
                        @endforeach
                    </select>
                    @error('citySelected')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="cityName" class="form-label required">Address</label>
                    <input type="text" class="form-control" id="cityName" wire:model="newaddress">
                    @error('newaddress')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="cityName" class="form-label required">PostCode</label>
                    <input type="text" class="form-control" id="cityName" wire:model="newpostcode">
                    @error('newpostcode')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="modal-footer">
            @if (session('newcaddresssuccess'))
                <span class="p-2 rounded text-bg-success">{{ session('newcaddresssuccess') }}</span>
            @endif
            <!-- The form submits when this button is clicked -->
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </form>

    <script>

        document.addEventListener('closeaddressmodal', event => {
            // Close the modal using Bootstrap's modal instance
            const modal = document.querySelector(`#addAddress`); // Replace with your modal's actual ID
            const modalInstance = bootstrap.Modal.getInstance(modal);
            modalInstance.hide();
        });
    </script>
</div>
