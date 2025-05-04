<div>
    @if (auth()->user()->role == 'admin')
        <div class="col-md-12">
            <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-primary" onclick="window.location.href='rota/viewregions'">View
                    Area/Regions</button>
            </div>
        </div>
    @endif
    <div class="card">
        @if (session()->has('success'))
            <div class="col-md-12 mb-1">
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {{ session('error') }}
                </div>
            </div>
        @endif
        <div class="card-header">

            <div>
                <h3 class="card-title">
                    {{ __('Rota') }}
                </h3>
            </div>
            @if (auth()->user()->role == 'admin')
                <div class="card-actions">
                    <x-action.create route="{{ route('rota.create') }}" />
                </div>
            @endif
        </div>

        <div class="card-body border-bottom py-3">
            <div class="d-flex">
                <div class="text-secondary">
                    Show
                    <div class="mx-2 d-inline-block">
                        <select wire:model.live="perPage" class="form-select form-select-sm"
                            aria-label="result per page">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
                        </select>
                    </div>
                    entries
                </div>
                <div class="ms-auto text-secondary">
                    Search:
                    <div class="ms-2 d-inline-block">
                        <input type="text" wire:model.live="search" class="form-control form-control-sm"
                            aria-label="Search invoice">
                    </div>
                </div>
            </div>
        </div>

        {{-- <x-spinner.loading-spinner /> --}}
        <div wire:loading wire:target="refreshRender" class="text-center my-4">
            <x-spinner.loading-spinner />
        </div>

        <div class="table-responsive">
            <table wire:loading.remove wire:target="refreshRender"
                class="table table-bordered card-table table-vcenter text-nowrap datatable"
                style="display: inline-table !important">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('id')" href="#" role="button">
                                {{ __('Id') }}
                                @include('inclues._sort-icon', ['field' => 'id'])
                            </a>
                        </th>
                        <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('name')" href="#" role="button">
                                {{ __('Name') }}
                                @include('inclues._sort-icon', ['field' => 'name'])
                            </a>
                        </th>
                        <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('email')" href="#" role="button">
                                {{ __('Email') }}
                                @include('inclues._sort-icon', ['field' => 'email'])
                            </a>
                        </th>
                        <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('city_name')" href="#" role="button">
                                {{ __('Assigned City') }}
                                @include('inclues._sort-icon', ['field' => 'city_name'])
                            </a>
                        </th>
                        <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('region_name')" href="#" role="button">
                                {{ __('Assigned Region') }}
                                @include('inclues._sort-icon', ['field' => 'region_name'])
                            </a>
                        </th>
                        {{-- <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('rota_address')" href="#" role="button">
                                {{ __('Assigned Address') }}
                                @include('inclues._sort-icon', ['field' => 'rota_address'])
                            </a>
                        </th>
                        <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('rota_status')" href="#" role="button">
                                {{ __('Status') }}
                                @include('inclues._sort-icon', ['field' => 'rota_status'])
                            </a>
                        </th>
                        <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('rotavisit_image')" href="#" role="button">
                                {{ __('Visit Picture') }}
                                @include('inclues._sort-icon', ['field' => 'rotavisit_image'])
                            </a>
                        </th> --}}
                        <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('date_assigned')" href="#" role="button">
                                {{ __('Assigned Date') }}
                                @include('inclues._sort-icon', ['field' => 'date_assigned'])
                            </a>
                        </th>
                        <th scope="col" class="align-middle text-center">
                            {{ __('Action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rota as $assignedrota)
                        <tr>
                            <td class="align-middle text-center">
                                {{ $loop->index + 1 }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $assignedrota->name }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $assignedrota->email }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $assignedrota->Cities->city_name }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $assignedrota->Regions->region_name }}
                            </td>
                            {{-- <td class="align-middle text-center">
                                @if ($assignedrota->Addresses && $assignedrota->Addresses->rota_address)
                                    {{ $assignedrota->Addresses->rota_address }}
                                @else
                                    <span class="text-danger">No Address</span>
                                @endif
                            </td> --}}
                            {{-- <td class="align-middle text-center">
                                <x-status dot
                                    color="{{ $assignedrota->rota_status === 'visited' ? 'green' : ($assignedrota->rota_status === 'not visited' ? 'orange' : '') }}"
                                    class="text-uppercase">
                                    {{ ucfirst($assignedrota->rota_status) }}
                                </x-status>
                            </td>
                            <td class="align-middle text-center">
                                @if ($assignedrota->rotavisit_image)
                                    <img src="{{ Url(Storage::url($assignedrota->rotavisit_image)) }}"
                                        alt="Visit Image" width="100" height="100">
                                @endif
                            </td> --}}
                            <td class="align-middle text-center">
                                {{ $assignedrota->date_assigned }}
                            </td>

                            {{-- <td class="align-middle text-center">
                                {{ $assignedrota->created_at->diffForHumans() }}
                            </td> --}}
                            <td class="align-middle text-center">
                                <x-button.show class="btn-icon"
                                    route="{{ route('rota.show', $assignedrota->rota_id) }}" />
                                @if (auth()->user()->role == 'admin')
                                    <x-button.edit class="btn-icon"
                                        route="{{ route('rota.edit', $assignedrota->rota_id) }}" />
                                @else
                                    <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $assignedrota->rota_id }}">Edit
                                        {{-- <img src="{{ asset('assets/img/bin.png') }}" alt="" style="height: 20px"> --}}
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" wire:loading.attr="disabled"
                                        id="exampleModal{{ $assignedrota->rota_id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Rota Details
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    @livewire('usertablestatus', ['thisrota_id' => $assignedrota->rota_id], key($assignedrota->rota_id))

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                {{-- <x-button.delete class="btn-icon"type='submit' route="{{ route('customers.destroy', $assignedrota->rota_id) }}"
                                    onclick="return confirm('Are you sure to remove {{ $assignedrota->User->name }} ?')" /> --}}
                                @if (auth()->user()->role == 'admin')
                                    <button class="btn btn-outline-danger"
                                        wire:click="deleteRota({{ $assignedrota->rota_id }})"
                                        onclick="return confirm('Are you sure to remove {{ $assignedrota->User->name }}?')">
                                        <img src="{{ asset('assets/img/bin.png') }}" alt=""
                                            style="height: 20px">
                                    </button>
                                @endif
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td class="align-middle text-center" colspan="8">
                                No results found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer d-flex align-items-center">
            <p class="m-0 text-secondary">
                Showing <span>{{ $rota->firstItem() }}</span> to <span>{{ $rota->lastItem() }}</span> of
                <span>{{ $rota->total() }}</span> entries
            </p>

            <ul class="pagination m-0 ms-auto">
                {{ $rota->links() }}
            </ul>
        </div>


        <script>
            Livewire.on('refreshRender', () => {
                document.querySelector('.datatable').style.display = 'inline-table';
            });
        </script>
    </div>
</div>
