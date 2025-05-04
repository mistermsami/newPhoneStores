<div class="card">
    <div class="card-header">
        <div>
            <h3 class="card-title">
                {{ __('Expense') }}
            </h3>
        </div> 
        <div class="card-actions">
            <x-action.create route="{{ route('expenses.create') }}" />
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
                        aria-label="Search Expense">
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
                        <a wire:click.prevent="sortBy('expenses_name')" href="#" role="button">
                            {{ __('Expenses Name') }}
                            @include('inclues._sort-icon', ['field' => 'expenses_name'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('expenses_amount')" href="#" role="button">
                            {{ __('Expenses Amount') }}
                            @include('inclues._sort-icon', ['field' => 'expenses_amount'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('expenses_category_name')" href="#" role="button">
                            {{ __('Expenses Category Name') }}
                            @include('inclues._sort-icon', ['field' => 'expenses_category_name'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('expenses_date')" href="#" role="button">
                            {{ __('Expenses Date') }}
                            @include('inclues._sort-icon', ['field' => 'expenses_date'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        {{ __('Action') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                {{-- @dd($Expense); --}}
                @forelse ($Expense as $Expense)
                    <tr>
                        <td class="align-middle text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $Expense->expenses_name }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $Expense->expenses_amount }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $Expense->expensecategory->expenses_category_name }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $Expense->expenses_date }}
                        </td>
                        <td class="align-middle text-center" style="width: 15%">
                            <x-button.show class="btn-icon" route="{{ route('expenses.show', $Expense) }}" />
                            <x-button.edit class="btn-icon" route="{{ route('expenses.edit', $Expense) }}" />
                            <x-button.delete class="btn-icon" route="{{ route('expenses.destroy', $Expense) }}" />
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
</div>
