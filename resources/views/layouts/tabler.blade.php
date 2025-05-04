<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <link rel="shortcut icon" href="{{ asset('fav.png') }}" type="image/x-icon" />

    <!-- CSS files -->
    <link href="{{ asset('dist/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-flags.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-payments.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/demo.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

        .form-control:focus {
            box-shadow: none;
        }

        .pagination {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .pagination .page-item {
            flex: 1 0 auto;
        }
    </style>

    {{-- - Page Styles - --}}
    @stack('page-styles')
    @livewireStyles
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>
</head>

<body>
    <script src="{{ asset('dist/js/demo-theme.min.js') }}"></script>

    <div class="page">
        <header class="navbar navbar-expand-md d-print-none">
            <div class="container-xl">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                    aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                    <a href="{{ url('/') }}">
                        {{-- <img src="{{ asset('assets/img/logo.PNG') }}" alt="Panther Force" width="60"
                            height="auto"> --}}
                        <img src="https://pantherforce.co.uk/cdn/shop/files/logo-pf_529ab6b6-8198-41c4-8071-3d610222d418_210x@2x.png?v=1720617728"
                            alt="Panther Force" width="100" height="auto">
                    </a>
                </h1>
                <div class="navbar-nav flex-row order-md-last">
                    <div class="d-none d-md-flex">

                        {{-- -
                            <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip"
                               data-bs-placement="bottom">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
                            </a>
                            <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip"
                               data-bs-placement="bottom">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
                            </a>
                            - --}}



                        {{-- -
                            <div class="dropdown">
                                <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">Open dropdown</a>
                                <div class="dropdown-menu">
                                    <span class="dropdown-header">Dropdown header</span>
                                    <a class="dropdown-item" href="#">
                                        Action
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        Another action
                                    </a>
                                </div>
                            </div>
                            - --}}

                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                            aria-label="Open user menu">
                            {{-- <span class="avatar avatar-sm shadow-none"
                                style="background-image: url({{ Auth::user()->photo ? asset('storage/profile/' . Auth::user()->photo) : asset('assets/img/illustrations/profiles/admin.jpg') }})">
                            </span> --}}
                            <span class="avatar avatar-sm shadow-none"
                                style="background-image: url({{ asset('assets/img/user.jpg') }})">
                            </span>

                            <div class="d-none d-xl-block ps-2">
                                <div>{{ Auth::user()->role }}</div>
                                {{-- <div>{{ Auth::user()->name }}</div> --}}
                                {{--                                    <div class="mt-1 small text-muted">UI Designer</div> --}}
                            </div>
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon dropdown-item-icon icon-tabler icon-tabler-settings" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path
                                        d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z">
                                    </path>
                                    <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                </svg>
                                Account
                            </a>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="icon dropdown-item-icon icon-tabler icon-tabler-logout" width="24"
                                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path
                                            d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                        <path d="M9 12h12l-3 -3" />
                                        <path d="M18 15l3 -3" />
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- -
                        <div class="dropdown">
                            <a href="#" class="btn dropdown-toggle" data-bs-toggle="dropdown">Open dropdown</a>
                            <div class="dropdown-menu">

                                <a class="dropdown-item" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon icon-tabler icon-tabler-settings" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path>
                                        <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                    </svg>
                                    Action
                                </a>
                                <a class="dropdown-item" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon dropdown-item-icon icon-tabler icon-tabler-pencil" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path>
                                        <path d="M13.5 6.5l4 4"></path>
                                    </svg>
                                    Another action
                                </a>
                            </div>
                        </div>
                        - --}}


                </div>
            </div>
        </header>

        <header class="navbar-expand-md">
            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="navbar">
                    <div class="container-xl">
                        @if (auth()->user()->role != 'admin' && auth()->user()->role != 'superAdmin')
                            <ul class="navbar-nav">
                                <li class="nav-item {{ request()->is('products*') ? 'active' : null }}">
                                    <a class="nav-link" href="{{ route('products.index') }}">
                                        <span
                                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-packages" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M7 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                                <path d="M2 13.5v5.5l5 3" />
                                                <path d="M7 16.545l5 -3.03" />
                                                <path d="M17 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                                <path d="M12 19l5 3" />
                                                <path d="M17 16.5l5 -3" />
                                                <path d="M12 13.5v-5.5l-5 -3l5 -3l5 3v5.5" />
                                                <path d="M7 5.03v5.455" />
                                                <path d="M12 8l5 -3" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('Products') }}
                                        </span>
                                    </a>
                                </li>


                                <li class="nav-item dropdown {{ request()->is('orders*') ? 'active' : null }}">
                                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                                        data-bs-auto-close="outside" role="button" aria-expanded="false">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-package-export" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 21l-8 -4.5v-9l8 -4.5l8 4.5v4.5" />
                                                <path d="M12 12l8 -4.5" />
                                                <path d="M12 12v9" />
                                                <path d="M12 12l-8 -4.5" />
                                                <path d="M15 18h7" />
                                                <path d="M19 15l3 3l-3 3" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('Orders') }}
                                        </span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="dropdown-menu-columns">
                                            <div class="dropdown-menu-column">
                                                <a class="dropdown-item" href="{{ route('orders.index') }}">
                                                    {{ __('All') }}
                                                </a>
                                                <a class="dropdown-item" href="{{ route('orders.complete') }}">
                                                    {{ __('Completed') }}
                                                </a>
                                                <a class="dropdown-item" href="{{ route('orders.pending') }}">
                                                    {{ __('Pending') }}
                                                </a>
                                                <a class="dropdown-item" href="{{ route('due.index') }}">
                                                    {{ __('Due') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item {{ request()->is('credit_history*') ? 'active' : null }}">
                                    <a class="nav-link" href="#">
                                        {{-- {{ route('customers.index') }} --}}
                                        <span
                                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-packages" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M7 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                                <path d="M2 13.5v5.5l5 3" />
                                                <path d="M7 16.545l5 -3.03" />
                                                <path d="M17 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                                <path d="M12 19l5 3" />
                                                <path d="M17 16.5l5 -3" />
                                                <path d="M12 13.5v-5.5l-5 -3l5 -3l5 3v5.5" />
                                                <path d="M7 5.03v5.455" />
                                                <path d="M12 8l5 -3" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('Credit History') }}
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item {{ request()->is('customers*') ? 'active' : null }}">
                                    <a class="nav-link" href="{{ route('customers.index') }}">
                                        <span
                                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-packages" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M7 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                                <path d="M2 13.5v5.5l5 3" />
                                                <path d="M7 16.545l5 -3.03" />
                                                <path d="M17 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                                <path d="M12 19l5 3" />
                                                <path d="M17 16.5l5 -3" />
                                                <path d="M12 13.5v-5.5l-5 -3l5 -3l5 3v5.5" />
                                                <path d="M7 5.03v5.455" />
                                                <path d="M12 8l5 -3" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('Customers') }}
                                        </span>
                                    </a>
                                </li>
                                @if (auth()->user()->role == 'user')
                                    {{-- <a class="dropdown-item" href="{{ route('rota.index') }}">
                                        {{ __('Rota') }}
                                    </a> --}}
                                    <li class="nav-item {{ request()->is('rota*') ? 'active' : null }}">
                                        <a class="nav-link" href="{{ route('rota.index') }}">
                                            <span class="nav-link-icon d-md-none d-lg-inline-block">

                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-packages" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                                    <path d="M2 13.5v5.5l5 3" />
                                                    <path d="M7 16.545l5 -3.03" />
                                                    <path d="M17 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                                    <path d="M12 19l5 3" />
                                                    <path d="M17 16.5l5 -3" />
                                                    <path d="M12 13.5v-5.5l-5 -3l5 -3l5 3v5.5" />
                                                    <path d="M7 5.03v5.455" />
                                                    <path d="M12 8l5 -3" />
                                                </svg>
                                            </span>
                                            <span class="nav-link-title">
                                                {{ __('Rota') }}
                                            </span>
                                        </a>
                                    </li>
                                @endif
                                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'superAdmin')
                                    <li class="nav-item dropdown {{ request()->is('purchases*') ? 'active' : null }}">
                                        <a class="nav-link dropdown-toggle" href="#navbar-base"
                                            data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button"
                                            aria-expanded="false">
                                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-package-import" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 21l-8 -4.5v-9l8 -4.5l8 4.5v4.5" />
                                                    <path d="M12 12l8 -4.5" />
                                                    <path d="M12 12v9" />
                                                    <path d="M12 12l-8 -4.5" />
                                                    <path d="M22 18h-7" />
                                                    <path d="M18 15l-3 3l3 3" />
                                                </svg>
                                            </span>
                                            <span class="nav-link-title">
                                                {{ __('Purchases') }}
                                            </span>
                                        </a>
                                        <div class="dropdown-menu">
                                            <div class="dropdown-menu-columns">
                                                <div class="dropdown-menu-column">
                                                    <a class="dropdown-item" href="{{ route('purchases.index') }}">
                                                        {{ __('All') }}
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('purchases.approvedPurchases') }}">
                                                        {{ __('Approval') }}
                                                    </a>
                                                    {{-- <a class="dropdown-item" href="{{ route('purchases.purchaseReport') }}">
                                                {{ __('Daily Purchase Report') }}
                                            </a> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="nav-item dropdown {{ request()->is('suppliers*') ? 'active' : null }}">
                                        <a class="nav-link dropdown-toggle" href="#navbar-base"
                                            data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button"
                                            aria-expanded="false">
                                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-layers-subtract"
                                                    width="24" height="24" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M8 4m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z" />
                                                    <path
                                                        d="M16 16v2a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2v-8a2 2 0 0 1 2 -2h2" />
                                                </svg>
                                            </span>
                                            <span class="nav-link-title">
                                                {{ __('Pages') }}
                                            </span>
                                        </a>
                                        <div class="dropdown-menu">
                                            <div class="dropdown-menu-columns">
                                                <div class="dropdown-menu-column">
                                                    <a class="dropdown-item" href="{{ route('suppliers.index') }}">
                                                        {{ __('Suppliers') }}
                                                    </a>
                                                    {{-- <a class="dropdown-item" href="{{ route('customers.index') }}">
                                                {{ __('Customers') }}
                                            </a> --}}
                                                    <a class="dropdown-item" href="{{ route('expenses.index') }}">
                                                        {{ __('Expenses') }}
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('expensescategory.index') }}">
                                                        {{ __('Expenses Category') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li
                                        class="nav-item dropdown {{ request()->is('users*', 'categories*', 'units*') ? 'active' : null }}">
                                        <a class="nav-link dropdown-toggle" href="#navbar-base"
                                            data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button"
                                            aria-expanded="false">
                                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-settings" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                                    <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                                </svg>
                                            </span>
                                            <span class="nav-link-title">
                                                {{ __('Settings') }}
                                            </span>
                                        </a>
                                        <div class="dropdown-menu">
                                            <div class="dropdown-menu-columns">
                                                <div class="dropdown-menu-column">
                                                    {{-- <a class="dropdown-item" href="{{ route('users.index') }}">
                                                    {{ __('Users') }}
                                                </a> --}}
                                                    <a class="dropdown-item" href="{{ route('categories.index') }}">
                                                        {{ __('Categories') }}
                                                    </a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('subcategories.index') }}">
                                                        {{ __('Sub categories') }}
                                                    </a>
                                                    {{-- <a class="dropdown-item" href="{{ route('repair-parts.index') }}">
                                                {{ __('Repair Parts') }}
                                            </a> --}}
                                                    <a class="dropdown-item" href="{{ route('devices.index') }}">
                                                        {{ __('Devices') }}
                                                    </a>
                                                    {{-- <a class="dropdown-item" href="{{ route('units.index') }}">
                                                {{ __('Units') }}
                                            </a> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                @if (auth()->user()->role == 'customer')
                                    <li class="nav-item {{ request()->is('users*') ? 'active' : null }}">
                                        <a class="nav-link" href="{{ route('users.index') }}">
                                            {{-- {{ route('customers.index') }} --}}
                                            <span
                                                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-packages" width="24"
                                                    height="24" viewBox="0 0 24 24" stroke-width="2"
                                                    stroke="currentColor" fill="none" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                                    <path d="M2 13.5v5.5l5 3" />
                                                    <path d="M7 16.545l5 -3.03" />
                                                    <path d="M17 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                                    <path d="M12 19l5 3" />
                                                    <path d="M17 16.5l5 -3" />
                                                    <path d="M12 13.5v-5.5l-5 -3l5 -3l5 3v5.5" />
                                                    <path d="M7 5.03v5.455" />
                                                    <path d="M12 8l5 -3" />
                                                </svg>
                                            </span>
                                            <span class="nav-link-title">
                                                {{ __('User Log') }}
                                            </span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        @else
                            <ul class="navbar-nav">
                                <li class="nav-item {{ request()->is('dashboard*') ? 'active' : null }}">
                                    <a class="nav-link" href="{{ route('dashboard') }}">
                                        <span
                                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('Dashboard') }}
                                        </span>
                                    </a>
                                </li>


                                <li class="nav-item {{ request()->is('products*') ? 'active' : null }}">
                                    <a class="nav-link" href="{{ route('products.index') }}">
                                        <span
                                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-packages" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M7 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                                <path d="M2 13.5v5.5l5 3" />
                                                <path d="M7 16.545l5 -3.03" />
                                                <path d="M17 16.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                                <path d="M12 19l5 3" />
                                                <path d="M17 16.5l5 -3" />
                                                <path d="M12 13.5v-5.5l-5 -3l5 -3l5 3v5.5" />
                                                <path d="M7 5.03v5.455" />
                                                <path d="M12 8l5 -3" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('Products') }}
                                        </span>
                                    </a>
                                </li>


                                <li class="nav-item dropdown {{ request()->is('orders*') ? 'active' : null }}">
                                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                                        data-bs-auto-close="outside" role="button" aria-expanded="false">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-package-export" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 21l-8 -4.5v-9l8 -4.5l8 4.5v4.5" />
                                                <path d="M12 12l8 -4.5" />
                                                <path d="M12 12v9" />
                                                <path d="M12 12l-8 -4.5" />
                                                <path d="M15 18h7" />
                                                <path d="M19 15l3 3l-3 3" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('Orders') }}
                                        </span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="dropdown-menu-columns">
                                            <div class="dropdown-menu-column">
                                                <a class="dropdown-item" href="{{ route('orders.index') }}">
                                                    {{ __('All') }}
                                                </a>
                                                <a class="dropdown-item" href="{{ route('orders.complete') }}">
                                                    {{ __('Completed') }}
                                                </a>
                                                <a class="dropdown-item" href="{{ route('orders.pending') }}">
                                                    {{ __('Pending') }}
                                                </a>
                                                <a class="dropdown-item" href="{{ route('due.index') }}">
                                                    {{ __('Due') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item dropdown {{ request()->is('returns*') ? 'active' : null }}">
                                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                                        data-bs-auto-close="outside" role="button" aria-expanded="false">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-package-export" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 21l-8 -4.5v-9l8 -4.5l8 4.5v4.5" />
                                                <path d="M12 12l8 -4.5" />
                                                <path d="M12 12v9" />
                                                <path d="M12 12l-8 -4.5" />
                                                <path d="M15 18h7" />
                                                <path d="M19 15l3 3l-3 3" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('Returns') }}
                                        </span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="dropdown-menu-columns">
                                            <div class="dropdown-menu-column">
                                                <a class="dropdown-item" href="{{ route('return.create') }}">
                                                    {{ __('Add Return Items') }}
                                                </a>
                                                <a class="dropdown-item" href="{{ route('return.index') }}">
                                                    {{ __('View All Returns') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item dropdown {{ request()->is('purchases*') ? 'active' : null }}">
                                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                                        data-bs-auto-close="outside" role="button" aria-expanded="false">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-package-import" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 21l-8 -4.5v-9l8 -4.5l8 4.5v4.5" />
                                                <path d="M12 12l8 -4.5" />
                                                <path d="M12 12v9" />
                                                <path d="M12 12l-8 -4.5" />
                                                <path d="M22 18h-7" />
                                                <path d="M18 15l-3 3l3 3" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('Purchases') }}
                                        </span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="dropdown-menu-columns">
                                            <div class="dropdown-menu-column">
                                                <a class="dropdown-item" href="{{ route('purchases.index') }}">
                                                    {{ __('All') }}
                                                </a>
                                                <a class="dropdown-item"
                                                    href="{{ route('purchases.approvedPurchases') }}">
                                                    {{ __('Approval') }}
                                                </a>
                                                {{-- <a class="dropdown-item" href="{{ route('purchases.purchaseReport') }}">
											{{ __('Daily Purchase Report') }}
										</a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item {{ request()->is('Map*') ? 'active' : null }}">
                                    <a class="nav-link" href="{{ route('Map') }}">
                                        <span
                                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('Map') }}
                                        </span>
                                    </a>
                                </li>


                                {{-- <li class="nav-item {{ request()->is('Phone-repairs*') ? 'active' : null }}">
							<a class="nav-link" href="{{ route('phone-repairs.index') }}">
								<span
									class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
									<svg xmlns="http://www.w3.org/2000/svg"
										class="icon icon-tabler icon-tabler-file" width="24" height="24"
										viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
										fill="none" stroke-linecap="round" stroke-linejoin="round">
										<path fill="#607D8B"
											d="M52,2H12a4,4,0,0,0-4,4V58a4,4,0,0,0,4,4H52a4,4,0,0,0,4-4V6A4,4,0,0,0,52,2ZM50,56H14V6H50Z" />
										<rect fill="#78909C" x="22" y="2" width="20" height="4" />
										<rect fill="#78909C" x="18" y="8" width="28" height="46" />
										<circle fill="#546E7A" cx="32" cy="54" r="2" />
									</svg>


								</span>
								<span class="nav-link-title">
									{{ __('Phone repair') }}
								</span>
							</a>
						</li> --}}
                                <li
                                    class="nav-item dropdown {{ request()->is('suppliers*', 'customers*') ? 'active' : null }}">
                                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                                        data-bs-auto-close="outside" role="button" aria-expanded="false">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-layers-subtract" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M8 4m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z" />
                                                <path
                                                    d="M16 16v2a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2v-8a2 2 0 0 1 2 -2h2" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('Pages') }}
                                        </span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="dropdown-menu-columns">
                                            <div class="dropdown-menu-column">
                                                <a class="dropdown-item" href="{{ route('suppliers.index') }}">
                                                    {{ __('Suppliers') }}
                                                </a>
                                                <a class="dropdown-item" href="{{ route('users.usercustomers') }}">
                                                    {{ __('User Customers list') }}
                                                </a>
                                                <a class="dropdown-item" href="{{ route('customers.index') }}">
                                                    {{ __('Customers') }}
                                                </a>
                                                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'superAdmin')
                                                    <a class="dropdown-item" href="{{ route('ledger.customer') }}">
                                                        {{ __('Customer Ledger') }}
                                                    </a>
                                                @endif
                                                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'superAdmin')
                                                    <a class="dropdown-item" href="{{ route('ledger.userledger') }}">
                                                        {{ __('User Ledger') }}
                                                    </a>
                                                @endif
                                                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'superAdmin')
                                                    <a class="dropdown-item" href="{{ route('users.index') }}">
                                                        {{ __('Users') }}
                                                    </a>
                                                @endif
                                                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'superAdmin')
                                                    <a class="dropdown-item" href="{{ route('rota.index') }}">
                                                        {{ __('Rota') }}
                                                    </a>
                                                @endif
                                                <a class="dropdown-item" href="{{ route('expenses.index') }}">
                                                    {{ __('Expenses') }}
                                                </a>
                                                <a class="dropdown-item"
                                                    href="{{ route('expensescategory.index') }}">
                                                    {{ __('Expenses Category') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li
                                    class="nav-item dropdown {{ request()->is('users*', 'categories*', 'units*') ? 'active' : null }}">
                                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                                        data-bs-auto-close="outside" role="button" aria-expanded="false">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-settings" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                                <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('Settings') }}
                                        </span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="dropdown-menu-columns">
                                            <div class="dropdown-menu-column">
                                                {{-- <a class="dropdown-item" href="{{ route('users.index') }}">
												{{ __('Users') }}
											</a> --}}
                                                <a class="dropdown-item" href="{{ route('categories.index') }}">
                                                    {{ __('Categories') }}
                                                </a>
                                                <a class="dropdown-item" href="{{ route('subcategories.index') }}">
                                                    {{ __('Sub categories') }}
                                                </a>
                                                {{-- <a class="dropdown-item" href="{{ route('repair-parts.index') }}">
											{{ __('Repair Parts') }}
										</a> --}}
                                                <a class="dropdown-item" href="{{ route('devices.index') }}">
                                                    {{ __('Devices') }}
                                                </a>
                                                {{-- <a class="dropdown-item" href="{{ route('units.index') }}">
											{{ __('Units') }}
										</a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @endif


                        <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
                            <form action="./" method="get" autocomplete="off" novalidate>
                                <div class="input-icon">
                                    <span class="input-icon-addon">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/search -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                            <path d="M21 21l-6 -6" />
                                        </svg>
                                    </span>
                                    <input type="text" name="search" id="search" value=""
                                        class="form-control" placeholder="Search…" aria-label="Search in website">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="page-wrapper">
            <div>
                @yield('content')
            </div>
            <div style="display: none;">
                @livewire('location-component')
            </div>
            {{-- <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-lg-auto ms-lg-auto">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item"><a href="https://tabler.io/docs" target="_blank"
                                        class="link-secondary" rel="noopener">Documentation</a></li>
                                <li class="list-inline-item"><a href="" class="link-secondary">License</a>
                                </li>
                                <li class="list-inline-item"><a href="https://github.com/tabler/tabler"
                                        target="_blank" class="link-secondary" rel="noopener">Source code</a></li>
                                <li class="list-inline-item">
                                    <a href="https://github.com/sponsors/codecalm" target="_blank"
                                        class="link-secondary" rel="noopener">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon text-pink icon-filled icon-inline" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
                                        </svg>
                                        Sponsor
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    Copyright &copy; {{ now()->year }}
                                    <a href="." class="link-secondary">Tabler</a>.
                                    All rights reserved.
                                </li>
                                <li class="list-inline-item">
                                    <a href="./changelog.html" class="link-secondary" rel="noopener">
                                        v1.0.0-beta19
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer> --}}
        </div>
    </div>
    <!-- Libs JS -->
    @stack('page-libraries')
    <!-- Tabler Core -->
    <script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>
    <script src="{{ asset('dist/js/demo.min.js') }}" defer></script>
    {{-- - Page Scripts - --}}
    @stack('page-scripts')
    @livewireScripts
    <script>
        //  setInterval(function() {
        //     Livewire.dispatch('customerLocation', {
        //         latitude: '53.8149729',
        //         longitude: '53.8149729',
        //     });
        //     console.log("longitude: '53.8149729',");
        // }, 500);
        // Function to handle errors from geolocation API
        function handleLocationError(error) {
            console.error("Error getting location:", error.message);
        }
        // Function to update marker position with live tracking
        function showPosition(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            Livewire.dispatch('customerLocation', {
                latitude: latitude,
                longitude: longitude,
            });

        }
        // Get user's current location and update marker position
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(showPosition, handleLocationError);
        } else {
            console.error("Geolocation is not supported by this browser.");
        }
    </script>
</body>

</html>
