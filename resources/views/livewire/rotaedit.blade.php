<div>
    <form wire:submit.prevent="saveRota">
        @csrf
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">{{ __('Edit Rota Details') }}</h3>

                        <!-- Existing form fields for editing -->
                        <div class="row row-cards">
                            <div class="col-md-12">
                                @if (auth()->user()->role == 'admin')
                                    <!-- User Selection -->
                                    <div class="mb-3">
                                        <label for="customer_type" class="form-label required">Select User</label>
                                        <select class="form-control" wire:model="userSelected">
                                            <option value="0" selected>-- Select User --</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">
                                                    {{ $user->name }}&nbsp;|&nbsp;{{ $user->email }}</option>
                                            @endforeach
                                        </select>
                                        @error('userSelected')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Select City -->
                                    <div class="mb-3">
                                        <label for="citySelected" class="form-label">Select City
                                            &nbsp;&nbsp;<button type="button" class="btn btn-primary btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#addcity">Add
                                                City</button></label>
                                        <select class="form-control" wire:model="citySelected"
                                            wire:change="searchRegions">
                                            <option value="0" selected>-- Select City --</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->city_id }}">{{ $city->city_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('citySelected')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Select Region -->
                                    <div class="mb-3">
                                        <label for="regionSelected" class="form-label">Select Region &nbsp;&nbsp;<button
                                                type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#addregion">Add Region</button></label>
                                        <select class="form-control" wire:model="regionSelected"
                                            wire:change="searchAddresses">
                                            <option value="0" selected>-- Select Region --</option>
                                            @foreach ($regions as $region)
                                                <option value="{{ $region->region_id }}">{{ $region->region_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('regionSelected')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Select Address -->
                                    <div class="mb-3">
                                        <label for="addressSelected" class="form-label">Select Address
                                            &nbsp;&nbsp;<button type="button" class="btn btn-primary btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#addAddress">Add Address &
                                                Postcode</button></label>
                                        <select class="form-control" wire:model="addressSelected"
                                            wire:change="searchPostcode">
                                            <option value="0" selected>-- Select Address --</option>
                                            @foreach ($addresses as $address)
                                                <option value="{{ $address->address_id }}">
                                                    {{ $address->rota_address }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('addressSelected')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Select PostCode -->
                                    <div class="mb-3">
                                        <label for="postcodeSelected" class="form-label required">Select
                                            PostCode</label>
                                        <select class="form-control" wire:model="postcodeSelected">
                                            <option value="0" selected>-- Select PostCode --</option>
                                            @foreach ($postcode as $post)
                                                <option value="{{ $post->address_id }}">{{ $post->postcode }}</option>
                                            @endforeach
                                        </select>
                                        @error('postcodeSelected')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <!-- City, Region, Address, and Postcode Fields... -->

                                    <!-- Date Assigned -->
                                    <div class="mb-3">
                                        <label for="dateAssigned" class="form-label required">Date Assigned</label>
                                        <input type="date" class="form-control" id="dateAssigned"
                                            wire:model="dateAssigned">
                                        @error('dateAssigned')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @else
                                    <div class="mb-3">
                                        <label for="rotavisitimage" class="form-label">Name</label>
                                        <input type="text" class="form-control" value="{{ $rotadata->User->name }}"
                                            disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="rotavisitimage" class="form-label">Assigned City</label>
                                        <input type="text" class="form-control"
                                            value="{{ $rotadata->Cities->city_name }}" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="rotavisitimage" class="form-label">Assigned Region</label>
                                        <input type="text" class="form-control"
                                            value="{{ $rotadata->Regions->region_name }}" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="rotavisitimage" class="form-label">Assigned Address</label>
                                        <input type="text" class="form-control"
                                            value="{{ $rotadata->Addresses->rota_address }}" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="rotavisitimage" class="form-label">Assigned PostCode</label>
                                        <input type="text" class="form-control"
                                            value="{{ $rotadata->Addresses->postcode }}" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label for="rotavisitimage" class="form-label">Assigned Date</label>
                                        <input type="text" class="form-control"
                                            value="{{ $rotadata->date_assigned }}" disabled>
                                    </div>

                                @endif

                                {{-- Status --}}
                                <div class="mb-3">
                                    <label for="rotastatus" class="form-label required">Select Status</label>
                                    <select class="form-control" wire:model="rotastatus">
                                        <option value="not visited"
                                            {{ $rotastatus === 'not visited' ? 'selected' : '' }}>not visited</option>
                                        <option value="visited" {{ $rotastatus === 'visited' ? 'selected' : '' }}>
                                            visited</option>
                                    </select>
                                    @error('rotastatus')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Visit Image Field -->
                                <div class="mb-3">
                                    <label for="rotavisitimage" class="form-label">Visit Image</label>
                                    {{-- @if ($rotavisitimage)
                                    <img src="{{ $rotavisitimage->temporaryUrl() }}" alt="Visit Image"
                                                width="100" height="100">
                                    @endif --}}
                                    @if ($rotavisitimage)
                                        <div class="mb-2">
                                            <img src="{{ Url(Storage::url($rotavisitimage)) }}" alt="Visit Image"
                                                width="100" height="100">
                                        </div>
                                    @elseif ($rotavisitimage)
                                        <div class="mb-2">
                                            <img src="{{ asset( $rotavisitimage) }}" alt="Visit Image"
                                                width="100" height="100">
                                        </div>
                                    @endif

                                    <input type="file" wire:model="newImage" class="form-control">
                                    @error('newImage')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-end">
                        @if (session('editsuccess'))
                            <span class="p-2 rounded text-bg-success">{{ session('editsuccess') }}</span>
                        @endif
                        <button class="btn btn-primary" type="submit">{{ __('Update') }}</button>
                        <a class="btn btn-outline-warning" href="{{ route('rota.index') }}">{{ __('Cancel') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </form>



    <!-- Modal -->
    <div class="modal fade" id="addcity" tabindex="-1" aria-labelledby="addcityLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @livewire('rotanew-city')
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addregion" tabindex="-1" aria-labelledby="addcityLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @livewire('rotanew-region')
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addAddress" tabindex="-1" aria-labelledby="addcityLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @livewire('rotanew-address')
                </div>
            </div>
        </div>
    </div>
    {{-- <script>
        // Listen for the 'rota-updated' event
        window.addEventListener('rota-updated', function () {
            setTimeout(function () {
                window.location.href = '{{ route('rota.index') }}';
            }, 2000); // Delay of 3 seconds
        });
    </script> --}}
</div>
