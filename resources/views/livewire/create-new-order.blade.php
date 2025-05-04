<div>

    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                {{-- <div class="col-md-12">
                    <!-- Show/Hide Columns Buttons -->
                    <div class="card-body border-bottom py-3">
                        <!-- Responsive Button Group -->
                        <div class="btn-group d-flex flex-wrap" role="group">
                            <div class="row w-100">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    @if ($columns['productslist'])
                                        <button wire:click="toggleColumn('productslist')"
                                            class="btn btn-primary btn-sm p-2 flex-grow-1 mb-2 w-100">
                                            Products Lists
                                        </button>
                                    @else
                                        <button wire:click="toggleColumn('productslist')"
                                            class="btn btn-outline-primary btn-sm p-2 flex-grow-1 mb-2 w-100">
                                            Products Lists
                                        </button>
                                    @endif
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    @if ($columns['orderlist'])
                                        <button wire:click="toggleColumn('orderlist')"
                                            class="btn btn-primary btn-sm p-2 flex-grow-1 mb-2 w-100">
                                            Order Lists
                                        </button>
                                    @else
                                        <button wire:click="toggleColumn('orderlist')"
                                            class="btn btn-outline-primary btn-sm p-2 flex-grow-1 mb-2 w-100">
                                            Order Lists
                                        </button>
                                    @endif
                                </div>
                            </div>


                        </div>
                    </div>
                </div> --}}
                {{-- @if ($columns['productslist'])
                    <div class="col-lg-6 col-md-4 col-sm-12">
                        @livewire('search-orders', ['products' => $products])
                    </div>
                @endif --}}
                {{-- @if ($columns['orderlist']) --}}
                    <div class="col-lg-12  col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <h3 class="card-title">
                                        {{ __('New Order') }}
                                    </h3>
                                </div>

                                {{-- <div class="card-actions btn-actions">
                                    <x-action.close route="{{ route('orders.index') }}" />
                                </div> --}}
                            </div>

                            <div class="card-body">
                                <div class="row mb-3">
                                    @livewire('search-orders', ['products' => $products])
                                </div>
                            <form action="{{ route('invoice.create') }}" method="POST">
                                @csrf
                                    <div class="row gx-3 mb-3">
                                        @include('partials.session')
                                        <div class="col-md-4">
                                            <label for="purchase_date" class="small my-1">
                                                {{ __('Date') }}
                                                <span class="text-danger">*</span>
                                            </label>

                                            <input name="purchase_date" id="purchase_date" type="date"
                                                class="form-control example-date-input @error('purchase_date') is-invalid @enderror"
                                                value="{{ old('purchase_date') ?? now()->format('Y-m-d') }}" required>

                                            @error('purchase_date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <label class="small mb-1" for="customer_id">
                                                {{ __('Customer') }}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <button type="button" class="btn btn-sm mb-1 btn-primary"
                                                data-bs-toggle="modal" data-bs-target="#myModal">
                                                Add customer
                                            </button>

                                            <!-- Include Livewire Component for Customer Select -->
                                            @livewire('customer-select', ['customers' => $allcustomers])

                                            {{-- <div class="">@json($customer_id)</div> --}}

                                            @error('customer_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>


                                        <div class="col-md-4">
                                            <label class="small mb-1" for="reference">
                                                {{ __('Reference') }}
                                            </label>

                                            <input type="text" class="form-control" id="reference" name="reference"
                                                value="ORD" readonly>

                                            @error('reference')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- <x-spinner.loading-spinner /> --}}
                                    <div class="table-responsive catTable">
                                        @if (session('cartsuccess'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('cartsuccess') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                        @if (session('carterror'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ session('carterror') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif

                                        {{-- <table wire:loading.remove class="table table-striped table-bordered align-middle"> --}}
                                        <table class="table table-striped table-bordered align-middle">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">{{ __('SKU') }}</th>
                                                    <th scope="col">{{ __('Product') }}</th>
                                                    <th scope="col" class="text-center">{{ __('Quantity') }}</th>
                                                    <th scope="col" class="text-center">{{ __('Price') }}</th>
                                                    <th scope="col" class="text-center">{{ __('SubTotal') }}</th>
                                                    <th scope="col" class="text-center">
                                                        {{ __('Action') }}
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- {{dd($newcartitem)}} --}}
                                                {{-- @if ($newcartitem) --}}
                                                @forelse ($newcartitem as $item)
                                                    <tr>
                                                        <td>
                                                            @if (is_array($item->sku))
                                                                {{ implode(', ', $item->sku) }} {{-- Join array elements as a comma-separated string --}}
                                                            @else
                                                                {{ $item->sku }} {{-- Display the sku if it's a string --}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{ $item->name }}
                                                        </td>
                                                        <td style="min-width: 170px;" colspan="2">
                                                            {{-- <form  model:submit.prevent="EditQtyPrice({{ $item->rowId }})"> --}}
                                                            <form>

                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-md-4 col-sm-4 mr-1">
                                                                        <div class="input-group">
                                                                            <input type="number" class="form-control"
                                                                                name="qty" required
                                                                                wire:model="cartItemquantity.{{ $item->rowId }}"
                                                                                value="{{ old('qty', $cartItemquantity[$item->rowId]) }}">
                                                                            <input type="hidden" class="form-control"
                                                                                name="product_id"
                                                                                wire:model="cartId.{{ $item->rowId }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-5 col-sm-5 ml-0 mr-1">
                                                                        <div class="input-group">
                                                                            <input type="number" class="form-control"
                                                                                name="price" required
                                                                                wire:model="cartItemprice.{{ $item->rowId }}"
                                                                                value="{{ old('price', $item->price) }}"
                                                                                step="any">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-3 ml-0">
                                                                        <div class="input-group-append text-center">
                                                                            <button
                                                                                wire:click.prevent="EditQtyPrice('{{ $item->rowId }}')"
                                                                                class="btn btn-icon btn-success border-none"
                                                                                data-toggle="tooltip"
                                                                                data-placement="top" title=""
                                                                                data-original-title="Sumbit">
                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                    class="icon icon-tabler icon-tabler-check"
                                                                                    width="24" height="24"
                                                                                    viewBox="0 0 24 24"
                                                                                    stroke-width="2"
                                                                                    stroke="currentColor"
                                                                                    fill="none"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round">
                                                                                    <path stroke="none"
                                                                                        d="M0 0h24v24H0z"
                                                                                        fill="none" />
                                                                                    <path d="M5 12l5 5l10 -10" />
                                                                                </svg>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </td>
                                                        <td class="text-center">
                                                            {{ Number::currency($item->subtotal, 'GBP') }}
                                                        </td>
                                                        <td class="text-center">
                                                            <form
                                                                wire:submit.prevent="RemoveItem('{{ $item->rowId }}')">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-icon btn-outline-danger "
                                                                    onclick="return confirm('Are you sure you want to delete this record?')">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        class="icon icon-tabler icon-tabler-trash"
                                                                        width="24" height="24"
                                                                        viewBox="0 0 24 24" stroke-width="2"
                                                                        stroke="currentColor" fill="none"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path d="M4 7l16 0" />
                                                                        <path d="M10 11l0 6" />
                                                                        <path d="M14 11l0 6" />
                                                                        <path
                                                                            d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                        <path
                                                                            d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <td colspan="6" class="text-center">
                                                        {{ __('Add Products') }}
                                                    </td>
                                                @endforelse
                                                {{-- @else
                                                <td colspan="6" class="text-center">
                                                    {{ __('Add Products') }}
                                                </td>
                                            @endif --}}

                                                <tr>
                                                    <td colspan="5" class="text-end">
                                                        Total Product
                                                    </td>
                                                    <td class="text-center">
                                                        {{ Cart::count() }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" class="text-end">Subtotal</td>
                                                    <td class="text-center">
                                                        {{ Number::currency(Cart::subtotal(), 'GBP') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" class="text-end">Total</td>
                                                    <td class="text-center">
                                                        {{ Number::currency(Cart::subtotal(), 'GBP') }}
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>

                                    <button type="submit"
                                        class="btn btn-success add-list mx-1 {{ Cart::count() > 0 ? '' : 'disabled' }}">
                                        {{ __('Create Invoice') }}
                                    </button>
                            </form>
                            </div>
                            <div class="card-footer text-end">
                            </div>
                        </div>
                    </div>
                {{-- @endif --}}

            </div>
        </div>
    </div>

    <!-- The modal -->
    <div class="modal modal-lg" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        {{ __('Customer Image') }}
                                    </h3>

                                    <img class="img-account-profile rounded-circle mb-2"
                                        src="{{ asset('assets/img/demo/user-placeholder.svg') }}" alt=""
                                        id="image-preview" />

                                    <div class="small font-italic text-muted mb-2">JPG
                                        or PNG no larger than 2 MB</div>

                                    <input class="form-control @error('photo') is-invalid @enderror" type="file"
                                        id="image" name="photo" accept="image/*" onchange="previewImage();">

                                    @error('photo')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        {{ __('Customer Details') }}
                                    </h3>
                                    <button type="button" class="close btn-close" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true"></span>
                                    </button>

                                    <div class="row row-cards">
                                        <div class="col-md-12">
                                            <x-input name="name" :required="true" />
                                            <x-input name="email" label="Email address" :required="true" />
                                            <x-input name="store_address" label="Shop Name" :required="true" />
                                            <x-input label="Phone Number" name="phone" type='tel'
                                                :required="true" />
                                            {{-- <input type="tel" pattern="[0-9]{11}" placeholder="Enter UK phone number"
												required> --}}
                                        </div>
                                        <div class="mb-3">
                                            <label for="address" class="form-label required">
                                                Customer Type
                                            </label>
                                            <select class="form-control @error('customer_type') is-invalid @enderror"
                                                id="customer_type" name="customer_type">
                                                <option value="0" selected>Sale Price</option>
                                                <option value="1">Whole Sale Price</option>
                                            </select>

                                        </div>

                                        <div class="mb-3">
                                            <label for="address" class="form-label required">
                                                Address
                                            </label>

                                            <textarea name="address" id="address" rows="3"
                                                class="form-control form-control-solid @error('address') is-invalid @enderror">{{ old('address') }}</textarea>

                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button class="btn btn-primary" type="submit">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- @if ($cartlength)
        <script>
            window.location.reload();
        </script>
    @endif --}}
</div>
