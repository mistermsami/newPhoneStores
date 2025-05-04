<div>
    <table class="table table-striped table-bordered align-middle">
        <thead class="thead-light">
            <tr>
                <th scope="col" class="align-middle text-center">No.</th>
                <th scope="col" class="align-middle text-center">Photo</th>
                <th scope="col" class="align-middle text-center">SKU</th>
                <th scope="col" class="align-middle text-center">Product Name</th>
                {{-- <th scope="col" class="align-middle text-center">Quantity</th>
                <th scope="col" class="align-middle text-center">Price</th> --}}
                <th scope="col" class="align-middle text-center">Quantity & Price</th>
                {{-- <th scope="col" class="align-middle text-center">Edit Quantity</th> --}}
                <th scope="col" class="align-middle text-center">Sub Total</th>
                <th scope="col" class="align-middle text-center">Action</th>
            </tr>
        </thead>
        {{-- @livewire('OrderproductDetail', ['details_id' => $item->id]) --}}
        <tbody>
            {{-- @livewire('OrderproductDetail', ['details_id' => 530]) --}}
            @foreach ($order->details as $item)
                <tr>
                    <td class="align-middle text-center">
                        {{ $loop->iteration }}
                    </td>
                    <td class="align-middle text-center">
                        <div style="max-height: 80px; max-width: 80px;">
                            <img class="img-fluid"
                                src="{{ $item->product->product_image ? asset('storage/' . $item->product->product_image) : asset('assets/img/products/default.webp') }}">
                        </div>
                    </td>
                    <td class="align-middle text-center">
                        {{ $item->product->sku }}
                    </td>
                    <td class="align-middle text-center">
                        {{ $item->product->name }}
                    </td>
                    {{-- <td class="align-middle text-center">
                        {{ $item->quantity }}
                    </td>
                    <td class="align-middle text-center">
                        {{ number_format($item->unitcost, 2) }}
                    </td> --}}
                    <td style="min-width: 170px;">
                        <form wire:submit.prevent="submitData({{ $item->id }})">
                            <input type="hidden" class="form-control" wire:model="OrderId.{{ $item->id }}"
                                placeholder="Order Id" readonly>
                            <div class="row p-1">
                                <div class="col-md-5 col-sm-12">
                                    <div class="input-group m-1">
                                        @error('productquantity')
                                            <span class="text-danger"
                                                style="font-size: 12px; margin-left: 5px;">*{{ $message }}</span>
                                        @enderror
                                        <input type="text" class="form-control"
                                            wire:model="productquantity.{{ $item->id }}" required
                                            placeholder="Quantity" value="{{ $productquantity[$item->id] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-12">
                                    <div class="input-group m-1">
                                        @error('productprice')
                                            <span class="text-danger"
                                                style="font-size: 12px; margin-left: 5px;">*{{ $message }}</span>
                                        @enderror
                                        <input type="text" class="form-control"
                                            wire:model="productprice.{{ $item->id }}" placeholder="Price"
                                            value="{{ number_format($item->unitcost, 2) }}">
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-icon m-1 w-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M5 12l5 5l10 -10" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                        </form>

                    </td>
                    <td class="align-middle text-center">
                        {{ number_format($item->total, 2) }}
                    </td>
                    <td class="align-middle text-center" style="max-width: 50px">

                        @if (auth()->user()->role == 'admin')
                            @if ($order->details->count() > 1)
                                <form action="{{ route('orders.deleteitems', $item->id) }}" class="d-inline-block"
                                    method="POST">
                                    @method('delete')
                                    @csrf
                                    <input name="Product_id" value="{{ $item->product->id }}" type="hidden" />
                                    <input name="uuid" value="{{ $order->uuid }}" type="hidden" />
                                    <input name="order_id" value="{{ $order->id }}" type="hidden" />

                                    <button type="submit" class="btn btn-icon btn-outline-danger "
                                        onclick="return confirm('Are you sure you want to delete this record?')">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-trash" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 7l16 0" />
                                            <path d="M10 11l0 6" />
                                            <path d="M14 11l0 6" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                        </svg>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('orders.cancel', $order) }}" class="d-inline-block"
                                    method="POST">
                                    @method('delete')
                                    @csrf
                                    <input name="Product_id" value="{{ $item->product->id }}" type="hidden" />
                                    <input name="uuid" value="{{ $order->uuid }}" type="hidden" />
                                    <input name="order_id" value="{{ $order->id }}" type="hidden" />
                                    <button type="submit" class="btn btn-icon btn-outline-danger "
                                        onclick="return confirm('Please delete this order from the main order page')">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-trash" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 7l16 0" />
                                            <path d="M10 11l0 6" />
                                            <path d="M14 11l0 6" />
                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                        </svg>
                                    </button>
                                </form>
                            @endif

                        @endif
                    </td>
                </tr>

            @endforeach
            <tr>
                <td colspan="3" class="text-end">
                    Pay To
                </td>
                <td class="text-center" colspan="1">
                    <form wire:submit.prevent="savepayto('{{ $order->uuid }}')">
                    {{-- <form action="{{ route('orders.update_order_payment', $order->uuid) }}" method="POST"> --}}
                        @csrf
                        <div class="input-group" style="min-width: 170px;">
                            <input type="text" class="form-control" name="payto" wire:model='payto' required step="any">
                            <input type="hidden" class="form-control" name="paytoorder_id" wire:model='orderID' value="{{ $order->id }}">

                            <div class="input-group-append text-center">
                                <button type="submit" class="btn btn-icon btn-success border-none"
                                    data-toggle="tooltip" data-placement="top" title=""
                                    data-original-title="Sumbit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M5 12l5 5l10 -10" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>

                </td>
                <td class="text-end">
                    Payed amount
                </td>
                <td class="text-center" colspan="2">
                    <form action="{{ route('orders.update_order_payment', $order->uuid) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="input-group" style="min-width: 170px;">
                            <input type="number" class="form-control" name="pay" required
                                value="{{ $order->pay }}" step="any">
                            <input type="hidden" class="form-control" name="order_id" value="{{ $order->id }}">

                            <div class="input-group-append text-center">
                                <button type="submit" class="btn btn-icon btn-success border-none"
                                    data-toggle="tooltip" data-placement="top" title=""
                                    data-original-title="Sumbit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M5 12l5 5l10 -10" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>

                </td>
            </tr>
            <tr>
                <td colspan="5" class="text-end">Due</td>
                <td class="text-center" colspan="2">{{ number_format($order->due, 2) }}</td>
            </tr>
            {{-- <tr>
                <td colspan="5" class="text-end">VAT</td>
                <td class="text-center" colspan="2">{{ number_format($order->vat, 2) }}</td>
            </tr> --}}
            <tr>
                <td colspan="5" class="text-end">Sub Total</td>
                <td class="text-center" colspan="2">{{ number_format($thissubtotal, 2) }}</td>
            </tr>
            <tr>
                <td colspan="5" class="text-end">Returns</td>
                <td class="text-center" colspan="2">{{ number_format($totalreturns, 2) }}</td>
            </tr>
            <tr>
                <td colspan="5" class="text-end">Total</td>
                <td class="text-center" colspan="2">{{ number_format($order->total, 2) }}</td>
            </tr>
            <tr>
                <td colspan="5" class="text-end">Status</td>
                <td class="text-center" colspan="2">
                    <x-status dot
                        color="{{ $order->order_status === \App\Enums\OrderStatus::COMPLETE ? 'green' : ($order->order_status === \App\Enums\OrderStatus::PENDING ? 'orange' : '') }}"
                        class="text-uppercase">
                        {{ $order->order_status->label() }}
                    </x-status>
                </td>
            </tr>
            <tr>
                <td class="text-end">Note:</td>
                <td colspan="7" class="text-center">
                    <textarea name="note" id="notesSelect" rows="3" class="form-control form-control-solid"
                        spellcheck="false">{{ old('note', $order->note) }}</textarea>
                </td>
            </tr>
        </tbody>
    </table>
</div>
