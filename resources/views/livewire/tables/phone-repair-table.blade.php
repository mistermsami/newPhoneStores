<div class="card">
    <div class="card-header">
        <div>
            <h3 class="card-title">
                {{ __('Phone repairs') }}
            </h3>
        </div>

        <div class="card-actions">
            <x-action.create route="{{ route('phone-repairs.create') }}" />
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
                        {{ __('No.') }}
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('phone_name')" href="#" role="button">
                            {{ __('Phone Name') }}
                            @include('inclues._sort-icon', ['field' => 'phone_name'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('repair_parts')" href="#" role="button">
                            {{ __('Repair parts') }}
                            @include('inclues._sort-icon', ['field' => 'repair_parts'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('description')" href="#" role="button">
                            {{ __('Description') }}
                            @include('inclues._sort-icon', ['field' => 'description'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('status')" href="#" role="button">
                            {{ __('Status') }}
                            @include('inclues._sort-icon', ['field' => 'status'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        {{ __('Action') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($phone_repairs as $repair)
                    <tr>
                        <td class="align-middle text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $repair->phone_name }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $repair->repair_part_name }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $repair->description }}
                        </td>
                        <td class="align-middle text-center">
                            <x-status
                                color="{{ $repair->status === 'completed' ? 'green' : ($repair->status === 'pending' ? 'orange' : '') }}"
                                class="text-uppercase">
                                {{ $repair->status }}
                            </x-status>
                        </td>
                        <td class="align-middle text-center">
                            <x-button.show class="btn-icon" route="{{ route('phone-repairs.show', $repair->id) }}" />
                            <x-button.edit class="btn-icon" route="{{ route('phone-repairs.edit', $repair->id) }}" />
                            <x-button.delete class="btn-icon" route="{{ route('phone-repairs.destroy', $repair->id) }}"
                                onclick="return confirm('Are you sure to delete?')" />
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
            Showing <span>{{ $phone_repairs->firstItem() }}</span>
            to <span>{{ $phone_repairs->lastItem() }}</span> of <span>{{ $phone_repairs->total() }}</span> entries
        </p>

        <ul class="pagination m-0 ms-auto">
            {{ $phone_repairs->links() }}
        </ul>
    </div>

</div>
