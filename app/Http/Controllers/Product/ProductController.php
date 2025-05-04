<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Category;
use App\Models\Device;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Str;

class ProductController extends Controller
{

	public function index()
	{
		$products = Product::all()->sortByDesc("id");;

		return view('products.index', [
			'products' => $products,
		]);
	}

	public function create(Request $request)
	{

		// if(auth()->user()->role !== 'admin') {
		// 	return abort(404);
		// }

		$categories = Category::where("user_id", auth()->id())->get(['id', 'name']);
		$product = Product::where('uuid', auth()->id())->first();
		// $devices = Device::where('user_id', auth()->id())->get(['id', 'name']);

		// $sub_categories = SubCategory::where("category_id", $categories[0]['id'])->get(['id', 'sub_category_name']);

		if ($request->has('category')) {
			$categories = Category::where("user_id", auth()->id())->whereSlug($request->get('category'))->get();
		}

		return view('products.create', [
			'categories' => $categories,
			'product' => $product,
			// 'devices' => $devices,
		]);
	}

	public function store(StoreProductRequest $request)
	{
		/**
		 * Handle upload image
		 */

		//  if(auth()->user()->role !== 'admin') {
		// 	return abort(404);
		//  }
		// dd($request);
		$imageName = "";
		if ($request->hasFile('product_image')) {
			// $image = $request->file('product_image')->store('products', 'public');
			$image = $request->file('product_image');
			$imageName = time() . '.' . $image->getClientOriginalExtension();
			$request->file('product_image')->move(public_path('storage/products'), $imageName);
		}

		$Product = Product::create([
			'name' => $request->name,
			'cost_price' => $request->cost_price,
			'whole_sale_price' => $request->whole_sale_price,
			'sale_price' => $request->sale_price,
			'quantity' => $request->quantity,
			'sku' => $request->sku,
			'bar_code' => $request->bar_code,
			'product_image' => 'products/' . $imageName,
			'item_type' => $request->item_type,
			'user_id' => auth()->id(),
			'uuid' => Str::uuid(),
		]);
		// dd($Product);
		if (str_contains(url()->previous(), '/orders/create')) {
			return to_route('orders.create');
		}

		return to_route('products.index')->with('success', 'Product has been created!');
	}

	public function show($uuid)
	{
		// if(auth()->user()->role !== 'admin') {
		// 	return abort(404);
		// }

		$product = Product::where('products.id', $uuid)->firstOrFail();

		// Generate a barcode
		// $generator = new BarcodeGeneratorHTML();
		// dd($product);
		// $barcode = $generator->getBarcode($product->code, $generator::TYPE_CODE_128);

		return view('products.show', [
			'product' => $product,
			// 'barcode' => $barcode,
		]);
	}

	public function edit($uuid)
	{
		// if(auth()->user()->role !== 'admin') {
		// 	return abort(404);
		// }

		$product = Product::where("id", $uuid)->firstOrFail();

		return view('products.edit', [
			'product' => $product,
		]);
	}

	public function update(UpdateProductRequest $request, $uuid)
	{
		// if(auth()->user()->role !== 'admin') {
		// 	return abort(404);
		// }
		$imageName = '';
		$product = Product::where("id", $uuid)->firstOrFail();
		$product->update($request->except('product_image'));

		if ($request->hasFile('product_image')) {
			$image = $request->file('product_image');

			// Delete Old Photo
			if ($product->product_image) {
				unlink(public_path('storage/') . $product->product_image);
			}
			// $image = $request->file('product_image')->store('products', 'public');
			$imageName = time() . '.' . $image->getClientOriginalExtension();
			$request->file('product_image')->move(public_path('storage/products'), $imageName);
		}

		$product->name = $request->name;
		$product->cost_price = $request->cost_price;
		$product->sale_price = $request->sale_price;
		$product->whole_sale_price = $request->whole_sale_price;
		$product->quantity = $request->quantity;
		$product->sku = $request->sku;
		$product->item_type = $request->item_type;
		$product->bar_code = $request->bar_code;
		$product->product_image = 'products/'.$imageName;
		$product->user_id = auth()->id();
		$product->uuid = Str::uuid();
		$product->save();

		if (str_contains(url()->previous(), '/orders/create')) {
			return to_route('orders.create');
		}


		return redirect()
			->route('products.index')
			->with('success', 'Product has been updated!');
	}

	public function destroy($uuid)
	{
		// if(auth()->user()->role !== 'admin') {
		// 	return abort(404);
		// }

		$product = Product::where("id", $uuid)->firstOrFail();
		/**
		 * Delete photo if exists.
		 */
		// if ($product->product_image) {
		// 	// check if image exists in our file system
		// 	if (file_exists(public_path('storage/') . $product->product_image)) {
		// 		dd(unlink(public_path('storage/') . $product->product_image));
		// 	}
		// }

		$product->delete();

		return redirect()
			->route('products.index')
			->with('success', 'Product has been deleted!');
	}
}
