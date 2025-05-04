@extends('layouts.tabler')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h3 class="card-title">
                            {{ __('Edit Category') }}
                        </h3>
                    </div> 
                    <div class="card-actions">
                        <x-action.close route="{{ route('expenses.index') }}" />
                    </div>
                </div>
                <form action="{{ route('expenses.update', $Expense->slug) }}" method="POST">
                    @csrf
                    @method('put') 
                    <div class="card-body">
                        <div class="row row-cards">
                            <div class="col-sm-6 col-md-6">
                                <x-input label="Expenses Name" name="expenses_name" id="expenses_name"
                                    value="{{ old('expenses_name', $Expense->expenses_name) }}" />
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <x-input label="Expenses Date" name="expenses_date" id="expenses_date"
                                    value="{{ old('expenses_date', $Expense->expenses_date) }}" />
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <x-input label="Expenses Amount" name="expenses_amount" id="expenses_amount"
                                    value="{{ old('expenses_amount', $Expense->expenses_amount) }}" />
                            </div>
                            <div class="col-sm-6 col-md-6 mb-3">
                                <label for="expenses_category_id" class="form-label">
                                    Expenses Category
                                </label>
                                <select name="expenses_category_id" id="expenses_category_id" class="form-select">
                                    @foreach ($expensescategories as $expensescategory)
                                        <option value="{{ $expensescategory->id }}" @if(old('expenses_category_id', $expensescategory->id) == $Expense->expenses_category_id) selected="selected"@endif> {{ $expensescategory->expenses_category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="expenses_notes" class="form-label">
                                    {{ __('Expenses Notes') }}
                                </label>
                                <textarea name="expenses_notes" id="expenses_notes" rows="5" class="form-control" placeholder="expenses_notes...">{{ old('expenses_notes', $Expense->expenses_notes) }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <x-button type="submit">
                            {{ __('Update') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@pushonce('page-scripts')
    <script>
        // Slug Generator
        const title = document.querySelector("#name");
        const slug = document.querySelector("#slug");
        title.addEventListener("keyup", function() {
            let preslug = title.value;
            preslug = preslug.replace(/ /g, "-");
            slug.value = preslug.toLowerCase();
        });
    </script>
@endpushonce
