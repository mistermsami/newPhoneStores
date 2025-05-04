<div class="card">
    <div class="card-header">
        <div>
            <h3 class="card-title">
                {{ __('Products') }}
            </h3>
        </div>
        <div class="card-actions">
            @if (auth()->user()->role === 'admin' || auth()->user()->role === 'supplier')
                <x-action.createcsv route="{{ route('products.import.view') }}" />
            @endif
            <x-action.create route="{{ route('products.create') }}" />
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
            </div>
            <div class="ms-auto text-secondary">
                Search:
                <div class="ms-2 d-inline-block">
                    <input type="text" wire:model.live="search" class="form-control form-control-sm"
                        aria-label="Search product">
                </div>
            </div>
        </div>
    </div>
    <!-- Show/Hide Columns Buttons -->
    <div class="card-body border-bottom py-3">
        <!-- Responsive Button Group -->
        <div class="btn-group d-flex flex-wrap" role="group">
            <button wire:click="toggleColumn('image')" class="btn btn-outline-primary btn-sm flex-grow-1 mb-2">
                Toggle Image
            </button>
            <button wire:click="toggleColumn('sku')" class="btn btn-outline-primary btn-sm flex-grow-1 mb-2">
                Toggle SKU
            </button>
            <button wire:click="toggleColumn('name')" class="btn btn-outline-primary btn-sm flex-grow-1 mb-2">
                Toggle Name
            </button>
            @if (auth()->user()->role === 'admin' || auth()->user()->role === 'supplier')
                <button wire:click="toggleColumn('cost_price')" class="btn btn-outline-primary btn-sm flex-grow-1 mb-2">
                    Toggle Cost Price
                </button>
            @endif
            <button wire:click="toggleColumn('sale_price')" class="btn btn-outline-primary btn-sm flex-grow-1 mb-2">
                Toggle Sale Price
            </button>
            <button wire:click="toggleColumn('whole_sale_price')"
                class="btn btn-outline-primary btn-sm flex-grow-1 mb-2">
                Toggle Whole Sale Price
            </button>
            <button wire:click="toggleColumn('quantity')" class="btn btn-outline-primary btn-sm flex-grow-1 mb-2">
                Toggle Quantity
            </button>
            <button wire:click="toggleColumn('bar_code')" class="btn btn-outline-primary btn-sm flex-grow-1 mb-2">
                Toggle Bar Code
            </button>
            <button wire:click="toggleColumn('item_type')" class="btn btn-outline-primary btn-sm flex-grow-1 mb-2">
                Toggle Item Type
            </button>
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
                    @if ($columns['image'])
                        <th scope="col" class="align-middle text-center">
                            {{ __('Image') }}
                        </th>
                    @endif
                    @if ($columns['sku'])
                        <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('products.sku')" href="#" role="button">
                                {{ __('Sku') }}
                                @include('inclues._sort-icon', ['field' => 'products.sku'])
                            </a>
                        </th>
                    @endif
                    @if ($columns['name'])
                        <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('products.name')" href="#" role="button">
                                {{ __('Name') }}
                                @include('inclues._sort-icon', ['field' => 'products.name'])
                            </a>
                        </th>
                    @endif
                    @if ($columns['cost_price'])
                        <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('products.cost_price')" href="#" role="button">
                                {{ __('Cost Price') }}
                                @include('inclues._sort-icon', ['field' => 'products.cost_price'])
                            </a>
                        </th>
                    @endif
                    @if ($columns['sale_price'])
                        <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('products.sale_price')" href="#" role="button">
                                {{ __('Sale Price') }}
                                @include('inclues._sort-icon', ['field' => 'products.sale_price'])
                            </a>
                        </th>
                    @endif
                    @if ($columns['whole_sale_price'])
                        <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('products.sale_price')" href="#" role="button">
                                {{ __('Whole Sale Price') }}
                                @include('inclues._sort-icon', ['field' => 'products.sale_price'])
                            </a>
                        </th>
                    @endif
                    @if ($columns['quantity'])
                        <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('products.quantity')" href="#" role="button">
                                {{ __('Quantity') }}
                                @include('inclues._sort-icon', ['field' => 'products.quantity'])
                            </a>
                        </th>
                    @endif
                    @if ($columns['bar_code'])
                        <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('products.bar_code')" href="#" role="button">
                                {{ __('Bar code') }}
                                @include('inclues._sort-icon', ['field' => 'products.bar_code'])
                            </a>
                        </th>
                    @endif
                    @if ($columns['item_type'])
                        <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('products.item_type')" href="#" role="button">
                                {{ __('Item type') }}
                                @include('inclues._sort-icon', ['field' => 'products.item_type'])
                            </a>
                        </th>
                    @endif
                    <th scope="col" class="align-middle text-center">
                        {{ __('Action') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td class="align-middle text-center">
                            {{ $loop->iteration }}
                        </td>
                        @if ($columns['image'])
                            <td class="align-middle text-center">
                                <img style="width: 90px;"
                                    src="{{ $product->product_image ? asset('storage/' . $product->product_image) : asset('assets/img/products/default.webp') }}"
                                    alt="">
                            </td>
                        @endif
                        @if ($columns['sku'])
                            <td class="align-middle text-center">
                                {{ $product->sku }}
                            </td>
                        @endif
                        @if ($columns['name'])
                            <td class="align-middle w-25" style="max-width: 170px">
                                <div class="d-flex flex-wrap text-wrap justify-content-center">
                                    {{ $product->name }}
                                </div>
                            </td>
                        @endif
                        @if ($columns['cost_price'])
                            <td class="align-middle text-center">
                                {{ $product->cost_price }}
                            </td>
                        @endif
                        @if ($columns['sale_price'])
                            <td class="align-middle text-center">
                                {{ $product->sale_price }}
                            </td>
                        @endif
                        @if ($columns['whole_sale_price'])
                            <td class="align-middle text-center">
                                {{ $product->whole_sale_price }}
                            </td>
                        @endif
                        @if ($columns['quantity'])
                            <td class="align-middle text-center">
                                {{ $product->quantity }}
                            </td>
                        @endif
                        @if ($columns['bar_code'])
                            <td class="align-middle text-center">
                                {{ $product->bar_code }}
                            </td>
                        @endif
                        @if ($columns['item_type'])
                            <td class="align-middle text-center">
                                {{ $product->item_type }}
                            </td>
                        @endif
                        <td class="align-middle text-center" style="width: 10%">
                            <x-button.show class="btn-icon" route="{{ route('products.show', $product->id) }}" />
                            <x-button.edit class="btn-icon" route="{{ route('products.edit', $product->id) }}" />
                            <x-button.delete class="btn-icon" route="{{ route('products.destroy', $product->id) }}"
                                onclick="return confirm('Are you sure to delete product {{ $product->name }} ?')" />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="align-middle text-center" colspan="37">No results found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer d-flex align-items-center">
        <p class="m-0 text-secondary">
            Showing <span>{{ $products->firstItem() }}</span>
            to <span>{{ $products->lastItem() }}</span> of <span>{{ $products->total() }}</span> entries
        </p>

        <ul class="pagination m-0 ms-auto">
            {{ $products->links() }}
        </ul>
    </div>
</div>
