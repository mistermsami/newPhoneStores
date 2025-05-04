<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        {{ config('app.name') }}
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=0.5">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/invoice/css/bootstrap.min.css') }}">
    <link type="text/css" rel="stylesheet"
        href="{{ asset('assets/invoice/fonts/font-awesome/css/font-awesome.min.css') }}">
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/invoice/css/style.css') }}">
</head>
<style>
    .invoice {
        text-align: right;
    }
</style>

<body>
    <div class="invoice-16 invoice-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice-inner-9" id="invoice_wrapper">
                        <div class="invoice-top">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6">
                                    <div class="logo">
                                        {{-- <h1>{{ Str::title(auth()->user()->name) }}</h1> --}}
                                        <img src="{{ asset('assets/img/logo.PNG') }}" style="width: 125px; height:125px"
                                            alt="Panther Force">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="invoice">
                                        <h1>
                                            Delivery note # <span>{{ $order->invoice_no }}</span>
                                        </h1>
                                        <div class="invoice_details">
                                            <div class="invoice-number d-flex justify-content-end">
                                                <h4 class="inv-title-1">
                                                    Invoice date:&nbsp;
                                                </h4>
                                                <p class="invo-addr-1">
                                                    {{ $order->order_date }}
                                                </p>
                                            </div>
                                            <div class="invoice-number d-flex justify-content-end">
                                                <h4 class="inv-title-1">
                                                    Bank Name:&nbsp;
                                                </h4>
                                                <p class="invo-addr-1">
                                                    LLOYDS BANK
                                                </p>
                                            </div>
                                            <div class="invoice-number d-flex justify-content-end">
                                                <h4 class="inv-title-1">
                                                    Bank Title:&nbsp;
                                                </h4>
                                                <p class="invo-addr-1">
                                                    PANTHER FORCE RETAIL LIMITED
                                                </p>
                                            </div>
                                            <div class="invoice-number d-flex justify-content-end">
                                                <h4 class="inv-title-1">
                                                    Sort Code:&nbsp;
                                                </h4>
                                                <p class="invo-addr-1">
                                                    30-99-50
                                                </p>&nbsp; &nbsp;
                                                <h4 class="inv-title-1">
                                                    Account No:&nbsp;
                                                </h4>
                                                <p class="invo-addr-1">
                                                    50539663
                                                </p>
                                            </div>
                                            {{-- <div class="invoice-number d-flex mt-0">
                                                <h4 class="inv-title-1">
                                                    Account No:&nbsp;
                                                </h4>
                                                <p class="invo-addr-1">
                                                    50539663
                                                </p>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-info">
                            {{-- <div class="row">
                                <div class="col-sm-6 mb-50">
                                    <div class="invoice-number">
                                        <h4 class="inv-title-1">
                                            Invoice date:
                                        </h4>
                                        <p class="invo-addr-1">
                                            {{ $order->order_date }}
                                        </p>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="row">
                                <div class="col-sm-6 mb-30">
                                    <h4 class="inv-title-1">Customer</h4>
                                    <p class="inv-from-1">{{ $order->customer->name }}</p>
                                    <p class="inv-from-1">{{ $order->customer->phone }}</p>
                                    <p class="inv-from-1">{{ $order->customer->email }}</p>
                                </div>
                                @php
                                    $user = auth()->user();
                                @endphp
                                <div class="col-sm-6 text-end mb-30">
                                    <h4 class="inv-title-1">Store</h4>
                                    <p class="inv-from-1">{{ Str::title($order->customer->store_address) }}</p>
                                    <p class="inv-from-1">{{ $order->customer->address }}</p>
                                    <p class="inv-from-1">{{ $user->store_email }}</p>
                                    <p class="inv-from-2">{{ $user->store_address }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="order-summary">
                            <div class="table-outer">
                                <table class="default-table invoice-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">SKU</th>
                                            <th class="align-middle">Item</th>
                                            <th class="align-middle text-center">Price</th>
                                            <th class="align-middle text-center">Quantity</th>
                                            <th class="align-middle text-center">Subtotal</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        {{-- @foreach ($orderDetails as $item) --}}
                                        @php
                                            $totalqty = 0;
                                            $totalitems = 0;
                                        @endphp
                                        @foreach ($order->details as $item)
                                            <tr>
                                                <td class="align-middle">
                                                    {{ $item->product->sku }}
                                                </td>
                                                <td class="align-middle">
                                                    {{ $item->product->name }}
                                                </td>
                                                <td class="align-middle text-center">
                                                    {{ Number::currency($item->unitcost, 'GBP') }}
                                                </td>
                                                <td class="align-middle text-center">
                                                    {{ $item->quantity }}
                                                </td>
                                                <td class="align-middle text-center">
                                                    {{ Number::currency($item->total, 'GBP') }}
                                                </td>
                                            </tr>
                                            @php
                                                $totalqty += $item->quantity;
                                                $totalitems = $loop->iteration;
                                                // $totalitems++;
                                            @endphp
                                        @endforeach
                                        <tr>
                                            <td colspan="2" class="text-end"><strong>Total Items</strong></td>
                                            <td class="text-center">
                                                <strong>{{ $totalitems }}</strong>
                                            </td>
                                            {{-- <td  class="text-end">
                                                <strong>
                                                    Subtotal
                                                </strong>
                                            </td>
                                            <td class="align-middle text-center">
                                                <strong>
                                                    {{ Number::currency($order->sub_total, 'GBP') }}
                                                </strong>
                                            </td> --}}
                                            <td class="text-end">
                                                <strong>Paid</strong>
                                            </td>
                                            <td class="align-middle text-center">
                                                <strong>
                                                    {{ Number::currency($order->pay, 'GBP') }}
                                                </strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-end"><strong>Total Qty</strong></td>
                                            <td class="text-center">
                                                <strong>{{ $totalqty }}</strong>
                                            </td>
                                            {{-- <td  class="text-end">
                                                <strong>Tax</strong>
                                            </td>
                                            <td class="align-middle text-center">
                                                <strong>
                                                    {{ Number::currency($order->vat, 'GBP') }}
                                                </strong>
                                            </td> --}}
                                            <td class="text-end">
                                                <strong>Sub Total</strong>
                                            </td>
                                            <td class="align-middle text-center">
                                                <strong>
                                                    {{ Number::currency($thissubtotal, 'GBP') }}
                                                </strong>
                                            </td>
                                        </tr>
                                        {{-- <tr>
                                            <td colspan="4" class="text-end">
                                                <strong>Paid</strong>
                                            </td>
                                            <td class="align-middle text-center">
                                                <strong>
                                                    {{ Number::currency($order->pay, 'GBP') }}
                                                </strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="text-end">
                                                <strong>Pending</strong>
                                            </td>
                                            <td class="align-middle text-center">
                                                <strong>
                                                    {{ Number::currency($order->total - $order->pay, 'GBP') }}
                                                </strong>
                                            </td>
                                        </tr> --}}
                                        <tr>
                                            <td colspan="4" class="text-end">
                                                <strong>Returns</strong>
                                            </td>
                                            <td class="align-middle text-center">
                                                <strong>
                                                    {{ Number::currency($totalreturns, 'GBP') }}
                                                </strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="text-end">
                                                <strong>Pending</strong>
                                            </td>
                                            <td class="align-middle text-center">
                                                <strong>
                                                    {{ Number::currency($order->total - $order->pay, 'GBP') }}
                                                </strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="text-end">
                                                <strong>Total</strong>
                                            </td>
                                            <td class="align-middle text-center">
                                                <strong>
                                                    {{ Number::currency($order->total, 'GBP') }}
                                                </strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- <div class="invoice-informeshon-footer">
                                <ul>
                                    <li><a href="#">www.website.com</a></li>
                                    <li><a href="mailto:sales@hotelempire.com">info@example.com</a></li>
                                    <li><a href="tel:+088-01737-133959">+62 123 123 123</a></li>
                                </ul>
                            </div> --}}
                    </div>
                    <div class="invoice-btn-section clearfix d-print-none">
                        <a href="javascript:window.print()" class="btn btn-lg btn-print">
                            <i class="fa fa-print"></i>
                            Print Invoice
                        </a>
                        <a id="invoice_download_btn" class="btn btn-lg btn-download">
                            <i class="fa fa-download"></i>
                            Download Invoice
                        </a>
                    </div>

                    {{-- back button --}}
                    <div class="invoice-btn-section clearfix d-print-none">
                        <a href="{{ route('orders.index') }}" class="btn btn-lg btn-print">
                            <i class="fa fa-arrow-left"></i>
                            Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/invoice/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/invoice/js/jspdf.min.js') }}"></script>
    <script src="{{ asset('assets/invoice/js/html2canvas.js') }}"></script>
    <script src="{{ asset('assets/invoice/js/app.js') }}"></script>
</body>

</html>
