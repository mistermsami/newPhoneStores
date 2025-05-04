<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
	public function index()
	{
		$subcategories = SubCategory::all("id", "sub_category_name");

		return view('subcategories.index', [
			'subcategories' => $subcategories,
		]);
	}

	public function create()
	{
		$categories = Category::all("id", "name");
		return view('subcategories.create', [
			'categories' => $categories
		]);
	}

	public function store(Request $request)
	{
		SubCategory::create([
			"sub_category_name" => $request->name,
			"category_id" => $request->categories
		]);

		return redirect()
			->route('subcategories.index')
			->with('success', 'Sub Category has been created!');
	}

	public function show(SubCategory $subcategory)
	{
		return view('categories.show', [
			'subcategory' => $subcategory
		]);
	}

	public function edit(SubCategory $subcategory)
	{
		return view('subcategories.edit', [
			'subcategory' => $subcategory
		]);
	}
	public function update(UpdateSubCategoryRequest $request, SubCategory $subcategory)
	{
		$subcategory->update([
			"sub_category_name" => $request->sub_category_name,
		]);

		return redirect()
			->route('subcategories.index')
			->with('success', 'Sub Category has been updated!');
	}

	public function destroy(SubCategory $subcategory)
	{
		$subcategory->delete();

		return redirect()
			->route('subcategories.index')
			->with('success', 'Sub Category has been deleted!');
	}
}
