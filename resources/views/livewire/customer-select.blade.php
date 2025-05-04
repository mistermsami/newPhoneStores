<div>
    {{-- @dd($customer_data); --}}
    <select class="form-select form-control-solid @error('customer_id') is-invalid @enderror" id="customer_id"
        name="customer_id" wire:change="changeEvent($event.target.value)">
        <option selected="" disabled="">
            Select a customer:
        </option>
        @if ($customers)
            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}" @selected(old('customer_id', $customer_data) == $customer->id)>
                    {{ $customer->name }}
                </option>
            @endforeach
        @endif

    </select>

    @error('customer_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
