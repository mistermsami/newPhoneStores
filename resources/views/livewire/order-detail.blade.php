<div>
    <td class="align-middle text-center">
        {{ $thisorderdetail->quantity }}
    </td>
    <td class="align-middle text-center">
        {{ number_format($thisorderdetail->unitcost, 2) }}
        <form wire:submit.prevent="submitData">
            <td style="min-width: 170px;">
                <div class="input-group">
                    @error('productquantity')
                        <span class="text-danger" style="font-size: 12px; margin-left: 5px;">*{{ $message }}</span>
                    @enderror
                    <!-- Correct wire:model usage -->
                    <input type="number" class="form-control" wire:model="productquantity" required>
                    <input type="hidden" class="form-control" wire:model="product_id" value="{{ $thisorderdetail->id }}">
                </div>
            </td>
            <td style="min-width: 170px;">
                <div class="input-group">
                    <input type="number" class="form-control" wire:model="productprice" step="any">
                    <div class="input-group-append text-center">
                        <button type="submit" class="btn btn-icon btn-success border-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l5 5l10 -10" />
                            </svg>
                        </button>
                    </div>
                </div>
            </td>
        </form>
    </td>
    <td class="align-middle text-center">
        {{ number_format($thisorderdetail->total, 2) }}
    </td>
</div>
