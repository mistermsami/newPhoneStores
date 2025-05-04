<div>

    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-lg-12  col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h3 class="card-title">
                                    {{ __('Return Order Items') }}
                                </h3>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row mb-3">
                                @livewire('search-customer-orders')
                            </div>
                            <div class="row mb-3">
                                <div class="card mb-1">
                                    <div class="card-header">Select Products from the order to return &nbsp;&nbsp;&nbsp;&nbsp;
                                        <b>
                                            @if ($orderInvoice)
                                                {{$orderInvoice}}
                                            @endif
                                        </b>
                                    </div>
                                    <div class="card-body">
                                        @if (session('successReturn'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('successReturn') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="card my-2">
                                                    <div class="card-header">Returned Products</div>
                                                    <div class="card-body p-2">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered align-middle">
                                                                <thead class="thead-light">
                                                                    <tr>
                                                                        <th scope="col" class="align-middle text-center">Product</th>
                                                                        <th scope="col" class="align-middle text-center">Price</th>
                                                                        <th scope="col" class="align-middle text-center">Qty</th>
                                                                        <th scope="col" class="align-middle text-center">Total</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if (!empty($returnedProducts))
                                                                        @foreach ($returnedProducts as $returnproduct)
                                                                            <tr>
                                                                                <td class="align-middle text-center">
                                                                                    {{ $returnproduct->product->sku }}
                                                                                    {{ $returnproduct->product->name }}</td>
                                                                                </td>
                                                                                <td class="align-middle text-center">
                                                                                    {{ number_format($returnproduct->price, 2) }}
                                                                                </td>
                                                                                <td class="align-middle text-center">
                                                                                    {{ $returnproduct->quantity }}</td>
                                                                                </td>
                                                                                <td class="align-middle text-center">
                                                                                    {{ number_format($returnproduct->subtotal, 2) }}
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    @else
                                                                    <tr>
                                                                        <td colspan="7" class="text-center">
                                                                            <p class="text">No Returned Product Found</p>
                                                                        </td>
                                                                    </tr>
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card my-2">
                                                    <div class="card-header">Select Products</div>
                                                    <div class="card-body p-2">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered align-middle">
                                                                <thead class="thead-light">
                                                                    <tr>
                                                                        <th scope="col" class="align-middle text-center">
                                                                            No.</th>
                                                                        <th scope="col" class="align-middle text-center">
                                                                            Name</th>
                                                                        <th scope="col" class="align-middle text-center">
                                                                            Qty</th>
                                                                        <th scope="col" class="align-middle text-center">
                                                                            Price</th>
                                                                        <th scope="col" class="align-middle text-center">
                                                                            Sub Total</th>
                                                                        <th scope="col" class="align-middle text-center">
                                                                            Return Qty</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if ($order)
                                                                        @foreach ($order->details as $item)
                                                                            <tr>
                                                                                <td class="align-middle text-center">
                                                                                    {{ $loop->iteration }}</td>
                                                                                <td class="align-middle text-center">
                                                                                    {{ $item->product->sku }}
                                                                                    {{ $item->product->name }}</td>
                                                                                <td class="align-middle text-center">
                                                                                    {{ $item->quantity }}</td>
                                                                                <td class="align-middle text-center">
                                                                                    {{ number_format($item->unitcost, 2) }}
                                                                                </td>
                                                                                <td class="align-middle text-center">
                                                                                    {{ number_format($item->total, 2) }}
                                                                                </td>
                                                                                <td class="align-middle text-center">
                                                                                    <input type="number" min="0"
                                                                                        max="{{ $item->quantity }}"
                                                                                        wire:model.defer="returnQuantities.{{ $item->id }}"
                                                                                        class="form-control text-center" />
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach


                                                                        <tr>

                                                                            <td class="text-end" colspan="5">
                                                                                Payed amount
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <form
                                                                                    action="{{ route('orders.update_order_payment', $order->uuid) }}"
                                                                                    method="POST">
                                                                                    @csrf
                                                                                    @method('put')
                                                                                    <div class="input-group"
                                                                                        style="min-width: 170px;">
                                                                                        <input type="number"
                                                                                            class="form-control"
                                                                                            name="pay" required
                                                                                            value="{{ $order->pay }}"
                                                                                            step="any">
                                                                                        <input type="hidden"
                                                                                            class="form-control"
                                                                                            name="order_id"
                                                                                            value="{{ $order->id }}">

                                                                                        <div
                                                                                            class="input-group-append text-center">
                                                                                            <button type="submit"
                                                                                                class="btn btn-icon btn-success border-none"
                                                                                                data-toggle="tooltip"
                                                                                                data-placement="top"
                                                                                                title=""
                                                                                                data-original-title="Sumbit">
                                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                    class="icon icon-tabler icon-tabler-check"
                                                                                                    width="24"
                                                                                                    height="24"
                                                                                                    viewBox="0 0 24 24"
                                                                                                    stroke-width="2"
                                                                                                    stroke="currentColor"
                                                                                                    fill="none"
                                                                                                    stroke-linecap="round"
                                                                                                    stroke-linejoin="round">
                                                                                                    <path stroke="none"
                                                                                                        d="M0 0h24v24H0z"
                                                                                                        fill="none" />
                                                                                                    <path
                                                                                                        d="M5 12l5 5l10 -10" />
                                                                                                </svg>
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>

                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="5" class="text-end">Due</td>
                                                                            <td class="text-center" colspan="2">
                                                                                {{ number_format($order->due, 2) }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="5" class="text-end">VAT</td>
                                                                            <td class="text-center" colspan="2">
                                                                                {{ number_format($order->vat, 2) }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="5" class="text-end">Total</td>
                                                                            <td class="text-center" colspan="2">
                                                                                {{ number_format($order->total, 2) }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="5" class="text-end">Status
                                                                            </td>
                                                                            <td class="text-center" colspan="2">
                                                                                <x-status dot
                                                                                    color="{{ $order->order_status === \App\Enums\OrderStatus::COMPLETE ? 'green' : ($order->order_status === \App\Enums\OrderStatus::PENDING ? 'orange' : '') }}"
                                                                                    class="text-uppercase">
                                                                                    {{ $order->order_status->label() }}
                                                                                </x-status>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="6" class="text-end">
                                                                                <button class="btn btn-warning"
                                                                                    wire:click="processReturn">Return
                                                                                    Selected Products</button>
                                                                            </td>
                                                                        </tr>
                                                                    @else
                                                                        <tr>
                                                                            <td colspan="7" class="text-center">
                                                                                <p class="text-danger">No order
                                                                                    found</p>
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
