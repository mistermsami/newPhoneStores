@extends('layouts.tabler')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <x-alert />
            <div class="row row-cards">
                <form action="{{ route('expenses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <div>
                                        <h3 class="card-title">
                                            {{ __('Expenses Create') }}
                                        </h3>
                                    </div> 
                                    <div class="card-actions">
                                        <a href="{{ route('expenses.index') }}" class="btn-action">
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
                                        <div class="col-sm-6 col-md-6">
                                            <x-input label="Expenses Name" name="expenses_name" id="expenses_name"
                                                value="{{ old('expenses_name') }}" />
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <x-input type="date" label="Expenses Date" name="expenses_date" id="expenses_date"
                                                value="{{ old('expenses_date') }}" />
                                        </div>
                                        <div class="col-sm-6 col-md-6">
                                            <x-input label="Expenses Amount" name="expenses_amount" id="expenses_amount"
                                                value="{{ old('expenses_amount') }}" />
                                        </div>
                                        <div class="col-sm-6 col-md-6 mb-3">
                                            <label for="expenses_category_id" class="form-label">
                                                Expenses Category
                                            </label>
                                            <select name="expenses_category_id" id="expenses_category_id"
                                                class="form-select">
                                                @foreach ($expensescategories as $expensescategory)
                                                    <option value="{{ $expensescategory->id }}">{{ $expensescategory->expenses_category_name }}</option>
                                                @endforeach 
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label for="expenses_notes" class="form-label">
                                                {{ __('Expenses Notes') }}
                                            </label>
                                            <textarea name="expenses_notes" id="expenses_notes" rows="5" class="form-control" placeholder="expenses_notes...">{{ old('expenses_notes') }}</textarea>
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
