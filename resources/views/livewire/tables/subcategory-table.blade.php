<div class="card">
    <div class="card-header">
        <div>
            <h3 class="card-title">
                {{ __('Sub Categories') }}
            </h3>
        </div>

        <div class="card-actions">
            <x-action.create route="{{ route('subcategories.create') }}" />
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
                        <a wire:click.prevent="sortBy('sub_category_name')" href="#" role="button">
                            {{ __('Sub category name') }}
                            @include('inclues._sort-icon', ['field' => 'sub_category_name'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        {{ __('Action') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($subcategories as $category)
                    <tr>
                        <td class="align-middle text-center" style="width: 10%">
                            {{ ++$loop->index }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $category->sub_category_name }}
                        </td>
                        <td class="align-middle text-center">
                            <x-button.edit class="btn-icon" route="{{ route('subcategories.edit', $category) }}" />
                            <x-button.delete class="btn-icon" route="{{ route('subcategories.destroy', $category) }}"
                                onclick="return confirm('Are you sure to remove sub category {{ $category->sub_category_name }} ?!')" />
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
            Showing <span>{{ $subcategories->firstItem() }}</span> to <span>{{ $subcategories->lastItem() }}</span> of
            <span>{{ $subcategories->total() }}</span> entries
        </p>

        <ul class="pagination m-0 ms-auto">
            {{ $subcategories->links() }}
        </ul>
    </div>
</div>
