<div class="card mb-1">
    <div class="card-header">Select Customer and Order</div>

    <style>
        .searchproducts {
            max-height: 150px;
            overflow-y: scroll;
            background-color: #f1f1f1;
            border-radius: 5px;
            padding: 2px;
        }

        .searchproductcard:hover {
            background-color: #f0f0f0;
        }
    </style>

    <div class="card-body">
        <div class="col-lg-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-4 my-2 text-secondary">
                    <select class="form-select" wire:model.change="customerid">
                        <option value="">Select a customer:</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-8 my-2 text-secondary">
                    <input type="text" wire:model.live="search" class="form-control"
                        placeholder="Search orders by invoice no or total...">
                    <x-spinner.loading-spinner />

                    <div class="col-md-12 mt-2 searchproducts">
                        @if ($customers && count($orders) > 0)
                            @foreach ($orders as $order)
                                <div class="card searchproductcard m-2 p-0">
                                    <div class="card-body text-center py-2"
                                        wire:click="OderSelected('{{ $order->uuid }}', '{{ $order->invoice_no }}', '{{ $selectedCustomer }}')"
                                        style="cursor: pointer;">
                                        <strong>{{ $order->invoice_no }}</strong> — Total:
                                        {{ Number::currency($order->total, 'GBP') }}
                                    </div>
                                </div>
                            @endforeach
                        @elseif(!$selectedCustomer)
                            <p class="text-center my-2">Please select a customer to view their orders.</p>
                        @else
                            <p class="text-center my-2">No Orders found for this customer.</p>
                        @endif

                        {{-- <div class="mt-3">
                            {{ $orders->links() }}
                        </div> --}}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
