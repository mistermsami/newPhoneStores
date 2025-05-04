<div>
    <form wire:submit.prevent="addRegion">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="citySelected" class="form-label">Select City</label>
                    <select class="form-control" wire:model="citySelected">
                        <option value="0" selected>-- Select City --</option>
                        @foreach ($allcities as $city)
                            <option value="{{ $city->city_id }}">{{ $city->city_name }}</option>
                        @endforeach
                    </select>
                    @error('citySelected')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="cityName" class="form-label required">Region Name</label>
                    <input type="text" class="form-control" id="cityName" wire:model="newregion">
                    @error('newregion')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="modal-footer">
            @if (session('newcregionsuccess'))
                <span class="p-2 rounded text-bg-success">{{ session('newcregionsuccess') }}</span>
            @endif
            <!-- The form submits when this button is clicked -->
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
    </form>

    <script>
        document.addEventListener('closeregionmodal', event => {
            // Close the modal using Bootstrap's modal instance
            const modal = document.querySelector(`#addregion`); // Replace with your modal's actual ID
            const modalInstance = bootstrap.Modal.getInstance(modal);
            modalInstance.hide();
        });
    </script>
</div>
