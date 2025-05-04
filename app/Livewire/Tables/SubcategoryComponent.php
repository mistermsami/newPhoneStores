<?php

namespace App\Livewire\Tables;

use App\Models\Category;
use Livewire\Component;

class SubcategoryComponent extends Component
{
	public $selectedCategory = null;
	public $selectedSubCategory;

	public function mount($product)
	{
		if ($product) {
			$this->selectedCategory = $product->category_id;
			$this->selectedSubCategory = $product->sub_category;
		}
	}

	public function render()
	{
		$categories = Category::where("user_id", auth()->id())->get(['id', 'name']);

		if (!$this->selectedCategory && count($categories) > 0) {
			$this->selectedCategory = $categories[0]['id'];
		}

		// $sub_categories = SubCategory::all();
		return view('livewire.tables.subcategory-component', compact('categories'));
	}
}
