<div>
    <form wire:submit.prevent="saveRota">
        @csrf
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">{{ __('Add Area/Region') }}</h3>
                        <div class="row row-cards">
                            <div class="col-md-12">
                                <!-- Select City -->
                                <div class="mb-3">
                                    <label for="citySelected" class="form-label">Select City
                                        &nbsp;&nbsp;<button type="button" class="btn btn-primary btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#addcity">Add New City</button></label>
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
                                        data-bs-toggle="modal" data-bs-target="#addregion">Add New Region</button></label>
                                    <select class="form-control" wire:model="regionSelected">
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
