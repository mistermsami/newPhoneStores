<div>
    <div class="row">

        <div class="col-sm-6 col-md-6 mb-3">
            <label for="category" class="form-label">
                Categories
            </label>
            <select wire:model.live="selectedCategory" name="category" id="category" class="form-select">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" class="">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-6 col-md-6 mb-3">
            <label for="sub_category" class="form-label">
                Sub Categories
            </label>
            <select wire:model="selectedSubCategory" name="sub_category" id="sub_category" class="form-select">
                @if ($selectedCategory)
                    @foreach (App\Models\SubCategory::where('category_id', $selectedCategory)->get() as $subcategory)
                        <option value="{{ $subcategory->id }}" 
                            @if (old('sub_category', $subcategory->id) == $selectedSubCategory) selected="selected" @endif>
                            {{ $subcategory->sub_category_name }}</option>
                    @endforeach
                @endif
            </select>
        </div>


        {{-- <div class="col-sm-6 col-md-6">
				<div class="mb-3">
						<label for="category_id" class="form-label">
								Product category
								<span class="text-danger">*</span>
						</label>

						<select name="category_id" id="category_id"
								class="form-select @error('category_id') is-invalid @enderror">
								<option selected="" disabled="">Select a category:</option>
								@foreach ($categories as $category)
										<option value="{{ $category->id }}"
												@if (old('category_id', $selectedCategory) == $category->id) selected="selected" @endif>
												{{ $category->name }}</option>
								@endforeach
						</select>

						@error('category_id')
								<div class="invalid-feedback">
										{{ $message }}
								</div>
						@enderror
				</div>
		</div> --}}

    </div>
</div>
{{-- <script>
    $(document).ready(function() {
        // $('.selectpicker').selectpicker();
    });
</script> --}}
