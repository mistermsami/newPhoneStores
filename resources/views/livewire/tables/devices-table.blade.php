<div class="card">
    <div class="card-header">
        <div>
            <h3 class="card-title">
                {{ __('Devices') }}
            </h3>
        </div>

        <div class="card-actions">
            <x-action.create route="{{ route('devices.create') }}" />
        </div>
    </div>

    <div class="card-body border-bottom py-3">
        <div class="d-flex">
            <div class="text-secondary">
                Show
                <div class="mx-2 d-inline-block">
                    <select wire:model.live="perPage" class="form-select form-select-sm" aria-label="result per page">
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

    <x-spinner.loading-spinner />

    <div class="table-responsive">
        <table wire:loading.remove class="table table-bordered card-table table-vcenter text-nowrap datatable">
            <thead class="thead-light">
                <tr>
                    <th class="align-middle text-center w-1">
                        {{ __('ID') }}
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('name')" href="#" role="button">
                            {{ __('Device Name') }}
                            @include('inclues._sort-icon', ['field' => 'name'])
                        </a>
                    </th>
                    {{-- <th scope="col" class="align-middle text-center d-none d-sm-table-cell">
                        <a wire:click.prevent="sortBy('slug')" href="#" role="button">
                            {{ __('Slug') }}
                            @include('inclues._sort-icon', ['field' => 'slug'])
                        </a>
                    </th> --}}
                    {{-- <th scope="col" class="align-middle text-center d-none d-sm-table-cell">
                        <a wire:click.prevent="sortBy('slug')" href="#" role="button">
                            {{ __('Products Count') }}
                            @include('inclues._sort-icon', ['field' => 'products'])
                        </a>
                    </th> --}}
                    <th scope="col" class="align-middle text-center d-none d-sm-table-cell">
                        <a wire:click.prevent="sortBy('created_at')" href="#" role="button">
                            {{ __('Created at') }}
                            @include('inclues._sort-icon', ['field' => 'created_at'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        {{ __('Action') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($devices as $device)
                    <tr>
                        <td class="align-middle text-center" style="width: 10%">
                            {{ ++$loop->index }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $device->name }}
                        </td>
                        {{-- <td class="align-middle text-center d-none d-sm-table-cell">
                            {{ $category->slug }}
                        </td> --}}
                        {{-- <td class="align-middle text-center d-none d-sm-table-cell">
                            {{ $category->products->count() }}
                        </td> --}}
                        <td class="align-middle text-center d-none d-sm-table-cell" style="width: 15%">
                            {{ $device->created_at ? $device->created_at->format('d-m-Y') : '--' }}
                        </td>
                        <td class="align-middle text-center" style="width: 15%">
                            {{-- <x-button.show class="btn-icon" route="{{ route('devices.show', $device) }}" /> --}}
                            <x-button.edit class="btn-icon" route="{{ route('devices.edit', $device) }}" />
                            <x-button.delete class="btn-icon" route="{{ route('devices.destroy', $device) }}"
                                onclick="return confirm('Are you sure to remove category {{ $device->name }} ?!')" />
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
            Showing <span>{{ $devices->firstItem() }}</span> to <span>{{ $devices->lastItem() }}</span> of
            <span>{{ $devices->total() }}</span> entries
        </p>

        <ul class="pagination m-0 ms-auto">
            {{ $devices->links() }}
        </ul>
    </div>
</div>
