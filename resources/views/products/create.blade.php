@extends('layouts.tabler')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-alert />

            <div class="row row-cards">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        {{ __('Product Image') }}
                                    </h3>

                                    <img class="img-account-profile mb-2"
                                        src="{{ asset('assets/img/products/default.webp') }}" alt=""
                                        id="image-preview" />

                                    <div class="small font-italic text-muted mb-2">
                                        JPG or PNG no larger than 2 MB
                                    </div>

                                    <input type="file" accept="image/*" id="image" name="product_image"
                                        class="form-control @error('product_image') is-invalid @enderror"
                                        onchange="previewImage();">

                                    @error('product_image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <div>
                                        <h3 class="card-title">
                                            {{ __('Product Create') }}
                                        </h3>
                                    </div>

                                    <div class="card-actions">
                                        <a href="{{ route('products.index') }}" class="btn-action">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M18 6l-12 12"></path>
                                                <path d="M6 6l12 12"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row row-cards">
                                        <div class="col-md-12">
                                            <x-input name="name" id="name" value="{{ old('name') }}" />
                                        </div>
                                        {{-- @livewire('tables.subcategory-select-component', ['product' => $product]) --}}
                                        {{-- @livewire('tables.subcategory-component', ['product' => $product]) --}}

                                        <div class="col-12">
                                            <x-input label="Cost Price" name="cost_price" id="cost_price" type="number"
                                                value="{{ old('cost_price') }}" />
                                        </div>
                                        <div class="col-12">
                                            <x-input label="Whole Sale Price" name="whole_sale_price" id="whole_sale_price"
                                                type="number" value="{{ old('whole_sale_price') }}" />
                                        </div>
                                        <div class="col-12">
                                            <x-input label="Sale Price" name="sale_price" id="sale_price" type="number"
                                                value="{{ old('sale_price') }}" />
                                        </div>
                                        <div class="col-12">
                                            <x-input label="Quantity" name="quantity" id="quantity" type="number"
                                                value="{{ old('quantity') }}" />
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <x-input label="SKU" name="sku" id="sku"
                                                value="{{ old('sku') }}" />
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <x-input label="Bar code" name="bar_code" id="bar_code"
                                                value="{{ old('bar_code') }}" />
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <x-input label="Item type" name="item_type" id="item_type"
                                                value="{{ old('item_type') }}" />
                                        </div> 
                                    </div>
                                </div>

                                <div class="card-footer text-end">
                                    <x-button.save type="submit">
                                        {{ __('Save') }}
                                    </x-button.save>

                                    <a class="btn btn-warning" href="{{ url()->previous() }}">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@pushonce('page-scripts')
    <script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endpushonce
