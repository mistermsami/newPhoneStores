<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductModal extends Component
{
	private $product;

	public function mount($product) {
		$this->product = $product;
	}

    public function render()
    {

		// $product = Product

        return view('livewire.product-modal', [
			'product' => $this->product
		]);
    }
}
