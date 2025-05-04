<div class="card">
    <div class="card-header">
        <div>
            <h3 class="card-title">
                {{ __('Returns') }}
            </h3>
        </div>
        <div class="card-actions d-flex">

            <x-action.create route="{{ route('return.create') }}" />
        </div>
    </div>

    <div class="card-body border-bottom py-3">
        <div class="d-flex">
            <div class="text-secondary">
                Show
                <div class="mx-2 d-inline-block">
                    <select wire:model.live="perPage" class="form-select form-select-sm" aria-label="result per page">
                        <option value="15">15</option>
                        <option value="30">30</option>
                        <option value="75">75</option>
                        <option value="150">150</option>
                        <option value="500">500</option>
                    </select>
                </div>
            </div>
            <div class="ms-auto text-secondary">
                Search by Invoice:
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
                    {{-- <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('invoice_no')" href="#" role="button">
                            {{ __('Invoice No.') }}
                            @include('inclues._sort-icon', ['field' => 'invoice_no'])
                        </a>
                    </th> --}}
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('invoice_no')" href="#" role="button">
                            {{ __('Invoice No') }}
                            @include('inclues._sort-icon', ['field' => 'invoice_no'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                            {{ __('Sku') }}
                    </th>
                    <th scope="col" class="align-middle text-center">
                            {{ __('Product') }}
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('price')" href="#" role="button">
                            {{ __('Price') }}
                            @include('inclues._sort-icon', ['field' => 'price'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('quantity')" href="#" role="button">
                            {{ __('Qty') }}
                            @include('inclues._sort-icon', ['field' => 'quantity'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('subtotal')" href="#" role="button">
                            {{ __('Total') }}
                            @include('inclues._sort-icon', ['field' => 'subtotal'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('created_at')" href="#" role="button">
                            {{ __('Date') }}
                            @include('inclues._sort-icon', ['field' => 'created_at'])
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($returns as $returnproduct)
                    <tr>
                        <td class="align-middle text-center">
                            {{ $loop->iteration }}
                        </td>
                        {{-- <td class="align-middle text-center">
                            {{ $order->invoice_no }}
                        </td> --}}
                        <td class="align-middle text-center">
                           {{$returnproduct->invoice_no}}
                        </td>
                        <td class="align-middle text-center">
                           {{$returnproduct->product->sku}}
                        </td>
                        <td class="align-middle text-center">
                            {{$returnproduct->product->name}}
                        </td>
                        <td class="align-middle text-center">
                            {{ Number::currency($returnproduct->price, 'GBP') }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $returnproduct->quantity }}
                        </td>
                        <td class="align-middle text-center">
                            {{ Number::currency($returnproduct->subtotal, 'GBP') }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $returnproduct->created_at->format('d-m-Y') }}&nbsp;{{ $returnproduct->created_at->format('h:i:s') }}
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td class="align-middle text-center" colspan="8">
                            No Returned Product found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer d-flex align-items-center">
        <p class="m-0 text-secondary">
            Showing <span>{{ $returns->firstItem() }}</span> to <span>{{ $returns->lastItem() }}</span> of
            <span>{{ $returns->total() }}</span> entries
        </p>

        <ul class="pagination m-0 ms-auto">
            {{ $returns->links() }}
        </ul>
    </div>
</div>
