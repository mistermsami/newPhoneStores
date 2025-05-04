@extends('layouts.tabler')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center mb-3">
                <div class="col">
                    <h2 class="page-title">
                        {{ __('Edit Product') }}
                    </h2>
                </div>
            </div>

            @include('partials._breadcrumbs', ['model' => $product])
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">

                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        {{ __('Product Image') }}
                                    </h3>

                                    <img class="img-account-profile mb-2"
                                        src="{{ $product->product_image ? asset('storage/' . $product->product_image) : asset('assets/img/products/default.webp') }}"
                                        alt="" id="image-preview">

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
                                <div class="card-body">
                                    <h3 class="card-title">
                                        {{ __('Product Details') }}
                                    </h3>

                                    <div class="row row-cards">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">
                                                    {{ __('Name') }}
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input type="text" id="name" name="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    placeholder="Product name" value="{{ old('name', $product->name) }}">

                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- @livewire('tables.subcategory-select-component', ['product' => $product]) --}}
                                        {{-- @livewire('tables.subcategory-component', ['product' => $product]) --}}

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">
                                                    {{ __('Cost Price') }}
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input type="number" id="cost_price" name="cost_price" step="0.01"
                                                    class="form-control @error('cost_price') is-invalid @enderror"
                                                    placeholder="Cost Price"
                                                    value="{{ old('cost_price', $product->cost_price) }}">

                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">
                                                    {{ __('Sale Price') }}
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input type="number" id="sale_price" name="sale_price" step="0.01"
                                                    class="form-control @error('sale_price') is-invalid @enderror"
                                                    placeholder="Sale Price"
                                                    value="{{ old('sale_price', $product->sale_price) }}">

                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">
                                                    {{ __('Whole Sale Price') }}
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input type="number" id="whole_sale_price" name="whole_sale_price"
                                                    step="0.01"
                                                    class="form-control @error('whole_sale_price') is-invalid @enderror"
                                                    placeholder="Whole Sale Price"
                                                    value="{{ old('whole_sale_price', $product->whole_sale_price) }}">

                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">
                                                    {{ __('Quantity') }}
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input type="number" id="quantity" name="quantity" step="0.01"
                                                    class="form-control @error('quantity') is-invalid @enderror"
                                                    placeholder="Whole Sale Price"
                                                    value="{{ old('quantity', $product->quantity) }}">

                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">
                                                    {{ __('SKU') }}
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input id="sku" name="sku" step="0.01"
                                                    class="form-control @error('sku') is-invalid @enderror"
                                                    placeholder="SKU" value="{{ old('sku', $product->sku) }}">

                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">
                                                    {{ __('Item type') }}
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input id="item_type" name="item_type" step="0.01"
                                                    class="form-control @error('item_type') is-invalid @enderror"
                                                    placeholder="Item type"
                                                    value="{{ old('item_type', $product->item_type) }}">

                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">
                                                    {{ __('Bar code') }}
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <input id="bar_code" name="bar_code" step="0.01"
                                                    class="form-control @error('bar_code') is-invalid @enderror"
                                                    placeholder="Bar code"
                                                    value="{{ old('bar_code', $product->bar_code) }}">

                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="card-footer text-end">
                                            <button class="btn btn-primary" type="submit">
                                                {{ __('Update') }}
                                            </button>

                                            <a class="btn btn-danger" href="{{ url()->previous() }}">
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
