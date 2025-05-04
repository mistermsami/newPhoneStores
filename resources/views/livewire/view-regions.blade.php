<div>
    {{-- @if (auth()->user()->role == 'admin')
        <div class="col-md-12">
            <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-primary" onclick="window.location.href='rota/addnewregion'">View Area/Regions</button>
            </div>
        </div>
    @endif --}}
    <div class="card">
        @if (session()->has('success'))
            <div class="col-md-12">
                <div class="alert alert-danger">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="col-md-12">
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            </div>
        @endif
        <div class="card-header">

            <div>
                <h3 class="card-title">
                    {{ __('Address') }}
                </h3>
            </div>
            @if (auth()->user()->role == 'admin')
                <div class="card-actions">
                    <x-action.create route="{{ route('rota.addnewregion') }}" />
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
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="75">75</option>
                            <option value="100">100</option>
                            <option value="500">500</option>
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
                            <a wire:click.prevent="sortBy('city_name')" href="#" role="button">
                                {{ __('City') }}
                                @include('inclues._sort-icon', ['field' => 'city_name'])
                            </a>
                        </th>
                        <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('region_name')" href="#" role="button">
                                {{ __('Region') }}
                                @include('inclues._sort-icon', ['field' => 'region_name'])
                            </a>
                        </th>
                        <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('rota_address')" href="#" role="button">
                                {{ __('Address') }}
                                @include('inclues._sort-icon', ['field' => 'rota_address'])
                            </a>
                        </th>
                        <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('postcode')" href="#" role="button">
                                {{ __('Postcode') }}
                                @include('inclues._sort-icon', ['field' => 'postcode'])
                            </a>
                        </th>
                        <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('created_at')" href="#" role="button">
                                {{ __('Created At') }}
                                @include('inclues._sort-icon', ['field' => 'created_at'])
                            </a>
                        </th>
                        <th scope="col" class="align-middle text-center">
                            {{ __('Action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($viewRecords as $viewrecord)
                        <tr>
                            <td class="align-middle text-center">
                                {{ $loop->index + 1 }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $viewrecord->Regions->Cities->city_name }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $viewrecord->Regions->region_name }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $viewrecord->rota_address }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $viewrecord->postcode }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $viewrecord->created_at }}
                            </td>
                            <td class="align-middle text-center">

                                <x-button.edit class="btn-icon"
                                        route="{{ route('rota.editaddress', $viewrecord->address_id) }}" />

                                    {{-- <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $viewrecord->address_id }}">Edit
                                    </button> --}}

                                    <!-- Modal -->
                                    <div class="modal fade" wire:loading.attr="disabled"
                                        id="exampleModal{{ $viewrecord->address_id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{-- @livewire('usertablestatus', ['thisaddress_id' => $viewrecord->address_id], key($viewrecord->address_id)) --}}

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                {{-- <x-button.delete class="btn-icon"type='submit' route="{{ route('customers.destroy', $assignedrota->rota_id) }}"
                                    onclick="return confirm('Are you sure to remove {{ $assignedrota->User->name }} ?')" /> --}}
                                @if (auth()->user()->role == 'admin')
                                    <button class="btn btn-outline-danger"
                                        wire:click="deleteregion({{ $viewrecord->address_id }})">
                                        <img src="{{ asset('assets/img/bin.png') }}" alt=""
                                            style="height: 20px">
                                    </button>
                                    {{-- <button class="btn btn-outline-danger"
                                        wire:click="deleteregion({{ $viewrecord->address_id }})"
                                        onclick="return confirm('Are you sure to remove address against {{ $viewrecord->postcode }} postcode?')">
                                        <img src="{{ asset('assets/img/bin.png') }}" alt=""
                                            style="height: 20px">
                                    </button> --}}
                                @endif
                            </td>


                            {{-- <td class="align-middle text-center">
                                {{ $assignedrota->created_at->diffForHumans() }}
                            </td> --}}
                            {{-- <td class="align-middle text-center">
                                <x-button.show class="btn-icon"
                                    route="{{ route('rota.show', $assignedrota->rota_id) }}" />
                                @if (auth()->user()->role == 'admin')
                                    <x-button.edit class="btn-icon"
                                        route="{{ route('rota.edit', $assignedrota->rota_id) }}" />
                                @else
                                    <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $assignedrota->rota_id }}">Edit
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" wire:loading.attr="disabled"
                                        id="exampleModal{{ $assignedrota->rota_id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title
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
                                @if (auth()->user()->role == 'admin')
                                    <button class="btn btn-outline-danger"
                                        wire:click="deleteRota({{ $assignedrota->rota_id }})"
                                        onclick="return confirm('Are you sure to remove {{ $assignedrota->User->name }}?')">
                                        <img src="{{ asset('assets/img/bin.png') }}" alt=""
                                            style="height: 20px">
                                    </button>
                                @endif
                            </td> --}}
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
                Showing <span>{{ $viewRecords->firstItem() }}</span> to <span>{{ $viewRecords->lastItem() }}</span> of
                <span>{{ $viewRecords->total() }}</span> entries
            </p>

            <ul class="pagination m-0 ms-auto">
                {{ $viewRecords->links() }}
            </ul>
        </div>


        <script>
            Livewire.on('refreshRender', () => {
                document.querySelector('.datatable').style.display = 'inline-table';
            });
        </script>
    </div>
</div>
