@extends('layouts.tabler')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h3 class="card-title">
                            {{ __('Create Sub Category') }}
                        </h3>
                    </div>
                    <div class="card-actions">
                        <x-action.close route="{{ route('categories.index') }}" />
                    </div>
                </div>
                <form method="POST" action="{{ route('subcategories.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="col-md-12">
                            <x-input name="name" id="name" value="{{ old('name') }}" />
                        </div>

                        <div class="col-sm-6 col-md-12 mb-3">
                            <label for="categories" class="form-label">
                                Category
                            </label>
                            <select name="categories" id="categories" class="form-select">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="card-footer text-end">
                        <x-button type="submit">
                            {{ __('Create') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
