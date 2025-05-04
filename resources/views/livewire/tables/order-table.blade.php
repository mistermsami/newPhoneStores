<div class="card">
    <div class="card-header">
        <div>
            <h3 class="card-title">
                {{ __('Orders') }}
            </h3>
        </div>
        @if (auth()->user()->role === 'admin' || auth()->user()->role === 'superAdmin')
            <div class="m-auto d-flex">
                <select class="form-select form-control-solid mr-2 @error('user_id') is-invalid @enderror" id="user_id"
                    name="user_id" wire:model.change="userid">
                    <option value="" selected="" disabled="">
                        Select a user:
                    </option>

                    <option value="all">All</option>
                    @foreach ($users as $user)
                        {{-- <option value="{{ $user->id }}" @selected(old('UserId', $userid) == $user->id)> --}}
                        <option value="{{ $user->id }}">
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                <select class="form-select form-control-solid @error('customer_id') is-invalid @enderror"
                    id="customer_id" name="customer_id" wire:model.change="customerid">
                    <option value="" selected="" disabled="">
                        Select a customer:
                    </option>

                    <option value="all">All</option>
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">
                            {{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="card-actions d-flex">

            <x-action.create route="{{ route('orders.create') }}" />
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
                        {{ __('No.') }}
                    </th>
                    {{-- <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('invoice_no')" href="#" role="button">
                            {{ __('Invoice No.') }}
                            @include('inclues._sort-icon', ['field' => 'invoice_no'])
                        </a>
                    </th> --}}
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('user_id')" href="#" role="button">
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
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('payment_type')" href="#" role="button">
                            {{ __('Payment') }}
                            @include('inclues._sort-icon', ['field' => 'payment_type'])
                        </a>
                    </th>
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
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('payto')" href="#" role="button">
                            {{ __('Pay To') }}
                            @include('inclues._sort-icon', ['field' => 'payto'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('user')" href="#" role="button">
                            {{ __('User') }}
                            @include('inclues._sort-icon', ['field' => 'user'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        <a wire:click.prevent="sortBy('order_status')" href="#" role="button">
                            {{ __('Status') }}
                            @include('inclues._sort-icon', ['field' => 'order_status'])
                        </a>
                    </th>
                    <th scope="col" class="align-middle text-center">
                        {{ __('Action') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td class="align-middle text-center">
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
                        <td class="align-middle text-center">
                            {{ $order->payment_type }}
                        </td>
                        <td class="align-middle text-center">
                            {{ Number::currency($order->total, 'GBP') }}
                        </td>
                        <td class="align-middle text-center">
                            {{ Number::currency($order->pay, 'GBP') }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $order->payto }}
                        </td>
                        @if (auth()->user()->role === 'admin' || auth()->user()->role === 'superAdmin')
                            <td class="align-middle text-center">
                                {{ $order->user->name }}
                            </td>
                        @else
                            <td class="align-middle text-center">
                                {{ $order->note }}
                            </td>
                        @endif
                        <td class="align-middle text-center">
                            <x-status dot
                                color="{{ $order->order_status === \App\Enums\OrderStatus::COMPLETE ? 'green' : ($order->order_status === \App\Enums\OrderStatus::PENDING ? 'orange' : '') }}"
                                class="text-uppercase">
                                {{ $order->order_status->label() }}
                            </x-status>
                        </td>
                        <td class="align-middle text-center">
                            <x-button.show class="btn-icon" route="{{ route('orders.show', $order->uuid) }}" />
                            <x-button.print class="btn-icon" data-bs-toggle="tooltip" data-bs-original-title="Sale Price"
                                route="{{ route('order.downloadInvoice', $order->uuid) }}" />
                            @if (auth()->user()->role === 'admin' || auth()->user()->role === 'superAdmin')
                                <x-button.admin_print class="btn-icon" data-bs-toggle="tooltip" data-bs-original-title="Cost Price"
                                    route="{{ route('order.downloadAdminInvoice', $order->uuid) }}" />
                            @endif
                            @if ($order->order_status === \App\Enums\OrderStatus::PENDING)
                                <x-button.delete class="btn-icon" route="{{ route('orders.cancel', $order) }}"
                                    onclick="return confirm('Are you sure to cancel invoice no. {{ $order->invoice_no }} ?')" />
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="align-middle text-center" colspan="8">
                            No results found
                        </td>
                    </tr>
                @endforelse
                {{-- @if ($customerid)
                    <tr>
                        <td colspan="8" class="text-end">
                            Payed amount
                        </td>
                        <td class="text-center">{{ number_format($orders->sum('pay'), 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="8" class="text-end">Due</td>
                        <td class="text-center">{{ number_format($orders->sum('total') - $orders->sum('pay'), 2) }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="8" class="text-end">Total</td>
                        <td class="text-center">{{ number_format($orders->sum('total'), 2) }}</td>
                    </tr>
                @endif --}}
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
