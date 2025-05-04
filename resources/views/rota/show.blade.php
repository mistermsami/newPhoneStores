@extends('layouts.tabler')

@section('content')
    <style>
        td {
            padding-top: 25px;
            padding-bottom: 25px;
        }
    </style>
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center mb-3">
                <div class="col">
                    <h2 class="page-title">
                        {{ $rota->User->name }}
                    </h2>
                </div>
            </div>

            @include('partials._breadcrumbs', ['model' => $rota])
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="row d-flex justify-content-center">


                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    {{ __('Rota Details') }}
                                </h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered card-table table-vcenter text-nowrap datatable">
                                    <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td>{{ $rota->User->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email address</td>
                                            <td>{{ $rota->User->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Assigned City</td>
                                            <td>{{ $rota->Cities->city_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Assigned Region</td>
                                            <td>{{ $rota->Regions->region_name }}</td>
                                        </tr>

                                        <tr>
                                            <td>Assigned Address</td>
                                            <td>
                                                @if ($rota->Addresses && $rota->Addresses->rota_address)
                                                    {{ $rota->Addresses->rota_address }}
                                                @else
                                                    <span class="text-danger">No Address</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Assigned PostCode</td>
                                            <td>
                                                @if ($rota->Addresses && $rota->Addresses->postcode)
                                                    {{ $rota->Addresses->postcode }}
                                                @else
                                                    <span class="text-danger">No Postcode</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Rota Status</td>
                                            {{-- <td>{{ $rota->rota_status }}</td> --}}
                                            <td>
                                                <x-status dot
                                                    color="{{ $rota->rota_status === 'visited' ? 'green' : ($rota->rota_status === 'not visited' ? 'orange' : '') }}"
                                                    class="text-uppercase">
                                                    {{ ucfirst($rota->rota_status) }}
                                                </x-status>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Visit Picture</td>
                                            <td>
                                                @if ($rota->rotavisit_image)
                                                    <img src="{{ Url(Storage::url($rota->rotavisit_image)) }}"
                                                        alt="Visit Image" width="100" height="100">
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Assigned Date</td>
                                            <td>{{ $rota->date_assigned }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                            <div class="card-footer text-end">
                                <a class="btn btn-info" href="{{ route('rota.index') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M5 12l14 0" />
                                        <path d="M5 12l6 6" />
                                        <path d="M5 12l6 -6" />
                                    </svg>
                                    {{ __('Back') }}
                                </a>

                                <a class="btn btn-warning" href="{{ route('rota.edit', $rota->rota_id) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                        <path d="M13.5 6.5l4 4" />
                                    </svg>
                                    {{ __('Edit') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
