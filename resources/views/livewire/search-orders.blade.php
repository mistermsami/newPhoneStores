<div class="card mb-4 mb-xl-0">
    <div class="card-header">
        Search Product
        {{-- <div class="ms-auto text-secondary">
            Search:
            <div class="ms-2 d-inline-block">
                <input type="text" wire:model.live="search" class="form-control form-control-sm"
                    aria-label="Search product">
            </div>
        </div> --}}
    </div>

    <style>
        .abctable {
            max-height: 253px;
            overflow-x: auto;
            overflow-y: scroll;
        }

        .abctable::-webkit-scrollbar {
            width: 6px;
        }

        .abctable::-webkit-scrollbar-thumb {
            background-color: #636363;
            border-radius: 20px;
        }

        .abctable::-webkit-scrollbar-thumb {
            background-color: #636363;
            border-radius: 10px;
        }

        .abctable::-webkit-scrollbar-thumb:hover {
            background-color: #888888;
        }

        .abctable {
            scrollbar-width: thin;
            scrollbar-color: #636363 #ecf0f1;
        }
        .searchproducts{
            max-height: 253px;
            overflow-x: auto;
            overflow-y: scroll;
            background-color: #f1f1f1;
            border-radius: 5px;
            padding: 5px;
        }
        .searchproductcard:hover{
            background-color: #f0f0f0;
        }
    </style>
    <div class="card-body">
        <div class="col-lg-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label=
                    "Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label=
                "Close"></button>
                </div>
            @endif

            <div class="col-md-12 my-2 text-secondary">
                    <input type="text" wire:model.live="search" class="form-control"
                        aria-label="Search product" placeholder="Search product">
            </div>
            <x-spinner.loading-spinner />
            <div class="col-md-12 searchproducts">
                @forelse ($products as $product)
                    <div class="card searchproductcard m-2 p-0 cursor-pointer"
                        wire:click="addCartItem({{ $product->id }}, '{{ $product->name }}', {{ Session::get('customer_id') === \App\Enums\CustomerType::Normal ? $product->sale_price : $product->whole_sale_price }}, '{{ $product->sku }}')"
                        style="cursor: pointer;">
                        <div class="card-body">
                            <p class="text-center">
                                <b>{{ $product->sku }}</b> {{ $product->name }} &nbsp;&nbsp;
                                @if (Session::get('customer_id') === \App\Enums\CustomerType::Normal)
                                    <b>£{{ number_format($product->sale_price, 2) }}</b>
                                @else
                                    <b>£{{ number_format($product->whole_sale_price, 2) }}</b>
                                @endif
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="text-center my-2">No products found.</p>
                @endforelse
            </div>


        </div>
    </div>

</div>
