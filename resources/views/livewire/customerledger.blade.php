<div class="card">
    <style>
        .blinking-warning-circle {
            width: 13px;
            height: 13px;
            border-radius: 50%;
            background-color: #f76707;
            animation: blink 1.5s infinite;
            display: inline-block;
        }

        @keyframes blink {
            0% {
                opacity: 1;
            }

            25% {
                opacity: 0.5;
            }

            50% {
                opacity: 0.2;
            }

            75% {
                opacity: 0.5;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
    <div class="card-header">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <h3 class="card-title">
                        {{ __('Customer Ledger') }}
                    </h3>
                </div>
                @if (auth()->user()->role === 'admin' || auth()->user()->role === 'supplier')
                    {{-- <div class="m-auto d-flex align-items-center"> --}}
                    <div class="col-md-3">
                        <!-- Customer Selection -->
                        <select class="form-select form-control-solid m-1 w-100" wire:model.change="customerid">
                            <option value="" selected disabled>Select a customer:</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        {{-- Status --}}
                        <select class="form-select form-control-solid m-1" wire:model.change="paymentStatus">
                            <option value="" selected disabled>Select Payment Status:</option>
                            <option value="allstatus">All</option>
                            <option value="pending">Pending</option>
                            <option value="1">Complete</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        {{-- Payment Method --}}
                        <select class="form-select form-control-solid m-1" wire:model.change="paymentMethod">
                            <option value="" selected disabled>Select Payment Method:</option>
                            <option value="allpayment">All</option>
                            <option value="Cash">Cash</option>
                            <option value="Credit">Credit</option>
                            <option value="Bank">Bank</option>
                        </select>
                    </div>
            </div>
            <div class="row mt-3">
                <div class="offset-md-3 col-md-9 d-flex align-items-center justify-content-center">
                    <label class="mx-2">Date From</label>
                    <input type="date" class="form-control form-control-solid m-1" wire:model.change="datefrom">

                    <label class="mx-2">To</label>
                    <input type="date" class="form-control form-control-solid m-1" wire:model.change="dateto">
                </div>
            </div>

            @endif
        </div>
        {{-- </div> --}}



        {{-- <div class="card-actions d-flex">

            <x-action.create route="{{ route('orders.create') }}" />
        </div> --}}
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
                Search:
                <div class="ms-2 d-inline-block">
                    <input type="text" wire:model.live="search" class="form-control form-control-sm"
                        aria-label="Search invoice">
                </div>
            </div>

        </div>
    </div>
    <!-- Show/Hide Columns Buttons -->
    <div class="card-body border-bottom py-3">
        <!-- Responsive Button Group -->
        <div class="btn-group d-flex flex-wrap" role="group">
            <button wire:click="toggleColumn('payment')" class="btn btn-outline-primary btn-sm flex-grow-1 mb-2">
                Payment
            </button>
            <button wire:click="toggleColumn('payto')" class="btn btn-outline-primary btn-sm flex-grow-1 mb-2">
                Pay To
            </button>
            <button wire:click="toggleColumn('user')" class="btn btn-outline-primary btn-sm flex-grow-1 mb-2">
                User
            </button>
            <button wire:click="toggleColumn('status')" class="btn btn-outline-primary btn-sm flex-grow-1 mb-2">
                Status
            </button>
            <button wire:click="toggleColumn('actions')" class="btn btn-outline-primary btn-sm flex-grow-1 mb-2">
                Actions
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
                    {{-- <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('invoice_no')" href="#" role="button">
                            {{ __('Invoice No.') }}
                            @include('inclues._sort-icon', ['field' => 'invoice_no'])
                        </a>
                    </th> --}}
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('customer_id')" href="#" role="button">
                            {{ __('Customer') }}
                            @include('inclues._sort-icon', ['field' => 'customer_id'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('order_date')" href="#" role="button">
                            {{ __('Date') }}
                            @include('inclues._sort-icon', ['field' => 'order_date'])
                        </a>
                    </th>
                    @if ($columns['payment'])
                        <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('payment_type')" href="#" role="button">
                                {{ __('Payment') }}
                                @include('inclues._sort-icon', ['field' => 'payment_type'])
                            </a>
                        </th>
                    @endif
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('total')" href="#" role="button">
                            {{ __('Total') }}
                            @include('inclues._sort-icon', ['field' => 'total'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('pay')" href="#" role="button">
                            {{ __('Paid') }}
                            @include('inclues._sort-icon', ['field' => 'pay'])
                        </a>
                    </th>
                    @if ($columns['payto'])
                        <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('payto')" href="#" role="button">
                                {{ __('Pay To') }}
                                @include('inclues._sort-icon', ['field' => 'payto'])
                            </a>
                        </th>
                    @endif
                    @if ($columns['user'])
                        <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('user')" href="#" role="button">
                                {{ __('User') }}
                                @include('inclues._sort-icon', ['field' => 'user'])
                            </a>
                        </th>
                    @endif
                    @if ($columns['status'])
                        <th scope="col" class="align-middle text-center">
                            <a wire:click.prevent="sortBy('order_status')" href="#" role="button">
                                {{ __('Status') }}
                                @include('inclues._sort-icon', ['field' => 'order_status'])
                            </a>
                        </th>
                    @endif
                    @if ($columns['actions'])
                        <th scope="col" class="align-middle text-center">
                            {{ __('Action') }}
                        </th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td class="align-middle text-center">
                            @if ($order->payment_type === 'Credit' && $order->order_date->diffInDays(now()) >= 30)
                                <div class="blinking-warning-circle mt-1" title="Payment overdue!"></div>
                            @endif
                            {{ $loop->iteration }}
                        </td>
                        {{-- <td class="align-middle text-center">
                            {{ $order->invoice_no }}
                        </td> --}}
                        <td class="align-middle text-center">
                            {{ $order->customer->name }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $order->order_date->format('d-m-Y') }}
                        </td>
                        @if ($columns['payment'])
                            <td class="align-middle text-center">
                                @if ($order->payment_type === 'Credit' && $order->order_date->diffInDays(now()) >= 30)
                                    <div class="blinking-warning-circle mt-1" title="Payment overdue!"></div>
                                @endif
                                {{ $order->payment_type }}
                            </td>
                        @endif
                        <td class="align-middle text-center">
                            {{ Number::currency($order->total, 'GBP') }}
                        </td>
                        <td class="align-middle text-center">
                            {{ Number::currency($order->pay, 'GBP') }}
                        </td>
                        @if ($columns['payto'])
                            <td class="align-middle text-center">
                                {{ $order->payto }}
                            </td>
                        @endif
                        @if ($columns['user'])
                            @if (auth()->user()->role === 'admin' || auth()->user()->role === 'supplier')
                                <td class="align-middle text-center">
                                    {{ $order->user->name }}
                                </td>
                            @else
                                <td class="align-middle text-center">
                                    {{ $order->note }}
                                </td>
                            @endif
                        @endif
                        @if ($columns['status'])
                            <td class="align-middle text-center">
                                <x-status dot
                                    color="{{ $order->order_status === \App\Enums\OrderStatus::COMPLETE ? 'green' : ($order->order_status === \App\Enums\OrderStatus::PENDING ? 'orange' : '') }}"
                                    class="text-uppercase">
                                    {{ $order->order_status->label() }}
                                </x-status>
                            </td>
                        @endif
                        @if ($columns['actions'])
                            <td class="align-middle text-center">
                                <x-button.show class="btn-icon" route="{{ route('orders.show', $order->uuid) }}" />
                                <x-button.print class="btn-icon"
                                    route="{{ route('order.downloadInvoice', $order->uuid) }}" />
                                @if (auth()->user()->role === 'admin' || auth()->user()->role === 'supplier')
                                    <x-button.admin_print class="btn-icon"
                                        route="{{ route('order.downloadAdminInvoice', $order->uuid) }}" />
                                @endif
                                @if ($order->order_status === \App\Enums\OrderStatus::PENDING)
                                    <x-button.delete class="btn-icon" route="{{ route('orders.cancel', $order) }}"
                                        onclick="return confirm('Are you sure to cancel invoice no. {{ $order->invoice_no }} ?')" />
                                @endif
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td class="align-middle text-center" colspan="8">
                            No results found
                        </td>
                    </tr>
                @endforelse
                {{-- @if ($customerid) --}}
                <tr>
                    <td colspan="6" class="text-end">
                        No of Orders
                    </td>
                    <td class="text-center">{{ $totalOrders }}</td>
                    <td  class="text-end">
                        Payed amount
                    </td>
                    <td class="text-center">{{ number_format($total_payedamt, 2) }}</td>
                </tr>
                <tr>
                    {{-- <td colspan="6" class="text-end">
                        Profit/Loss
                    </td>
                    <td class="text-center">{{ $orders->count() }}</td> --}}
                    <td colspan="8" class="text-end">Due</td>
                    <td class="text-center">
                        {{ number_format($total_due, 2) }}
                    </td>
                </tr>
                <tr>
                    <td colspan="8" class="text-end">Total</td>
                    <td class="text-center">{{ number_format($sub_total, 2) }}</td>
                </tr>
                {{-- @endif --}}
            </tbody>
        </table>
    </div>

    <div class="card-footer d-flex align-items-center">
        <p class="m-0 text-secondary">
            Showing <span>{{ $orders->firstItem() }}</span> to <span>{{ $orders->lastItem() }}</span> of
            <span>{{ $orders->total() }}</span> entries
        </p>

        <ul class="pagination m-0 ms-auto">
            {{ $orders->links() }}
        </ul>
    </div>
</div>
