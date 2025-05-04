<div>

    <form wire:submit.prevent="statusupdateforms" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12">
                <input type="text" wire:model="thisrota_id" hidden>
                <div class="mb-3">
                    <label for="rotastatus" class="form-label required">Select Status</label>
                    <select class="form-control" wire:model="rotastatus">
                        @if ($rotastatus == 'not visited')
                            <option value="not visited" selected>Not Visited</option>
                            <option value="visited">Visited</option>
                        @elseif($rotastatus == 'visited')
                            <option value="not visited">Not Visited</option>
                            <option value="visited" selected>Visited</option>
                        @else
                            <option value="">-- Select Status --</option>
                            <option value="not visited">Not Visited</option>
                            <option value="visited">Visited</option>
                        @endif
                    </select>
                    @error('rotastatus')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Visit Image</label>
                    <input type="file" class="form-control" wire:model="newImage">
                    @error('newImage')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <!-- Loading indicator while uploading the image -->
                    <div wire:loading wire:target="newImage">Uploading...</div>
                </div>
            </div>
        </div>
        @if (session('statuupdatesucess'))
                <span
                    class="p-2 rounded text-bg-success">{{ session('statuupdatesucess') }}</span>
        @endif
        @if (session('statusupdateerror'))
                <div class="col-md-6">
                    <span class="p-2 rounded text-bg-danger">{{ session('statusupdateerror') }}</span>
                </div>
        @endif
        <button class="btn btn-primary" wire:loading.attr="disabled">
            Submit
        </button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    </form>
    <script>
        document.addEventListener('close-modal', event => {
            // Close the modal using Bootstrap's modal instance
            const modal = document.querySelector(`#exampleModal{{$thisrota_id}}`); // Replace with your modal's actual ID
            const modalInstance = bootstrap.Modal.getInstance(modal);
            modalInstance.hide();
        });
    </script>
</div>

