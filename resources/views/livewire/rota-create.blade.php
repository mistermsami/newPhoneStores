<div>
    <form wire:submit.prevent="saveRota">
        @csrf
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">{{ __('Rota Details') }}</h3>

                        <div class="row row-cards">
                            <div class="col-md-12">
                                <!-- Select User -->
                                <div class="mb-3">
                                    <label for="customer_type" class="form-label required">Select User</label>
                                    <select class="form-control @error('customer_type') is-invalid @enderror"
                                        wire:model="userSelected">
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
                                            data-bs-toggle="modal" data-bs-target="#addcity">Add City</button></label>
                                    <select class="form-control" wire:model="citySelected" wire:change="searchRegions">
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
                                    <label for="regionSelected" class="form-label">Select Region &nbsp;&nbsp;<button type="button" class="btn btn-primary btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#addregion">Add Region</button></label>
                                    <select class="form-control" wire:model="regionSelected"
                                        wire:change="searchAddresses">
                                        <option value="0" selected>-- Select Region --</option>
                                        @foreach ($regions as $region)
                                            <option value="{{ $region->region_id }}">{{ $region->region_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('regionSelected')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Select Address -->
                                <div class="mb-3">
                                    <label for="addressSelected" class="form-label">Select Address &nbsp;&nbsp;<button type="button" class="btn btn-primary btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#addAddress">Add Address & Postcode</button></label>
                                    <select class="form-control" wire:model="addressSelected"
                                        wire:change="searchPostcode">
                                        <option value="0" selected>-- Select Address --</option>
                                        @foreach ($addresses as $address)
                                            <option value="{{ $address->address_id }}">{{ $address->rota_address }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('addressSelected')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Select PostCode -->
                                <div class="mb-3">
                                    <label for="postcodeSelected" class="form-label required">Select PostCode</label>
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

                                <!-- Date Assigned -->
                                {{-- <x-input type="date" name="dateAssigned" label="Date Assigned" wire:model="dateAssigned" />
                                @error('dateAssigned') <span class="text-danger">{{ $message }}</span> @enderror --}}
                                <div class="mb-3">
                                    <label for="dateAssigned" class="form-label required">Date Assigned</label>
                                    <input type="date" class="form-control" id="dateAssigned"
                                        wire:model="dateAssigned">
                                    @error('dateAssigned')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-end">
                        @if (session('success'))
                            <span class="p-2 rounded text-bg-success">{{ session('success') }}</span>
                        @endif
                        @if (session('erralreadyexist'))
                            <span class="p-2 rounded text-bg-danger">{{ session('erralreadyexist') }}</span>
                        @endif
                        <button class="btn btn-primary" type="submit">{{ __('Save') }}</button>
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







</div>
