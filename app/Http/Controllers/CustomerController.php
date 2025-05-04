<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use Str;

class CustomerController extends Controller
{
	public function index()
	{
		$customers = Customer::all()->count();

		return view('customers.index', [
			'customers' => $customers
		]);
	}

	public function create()
	{
		return view('customers.create');
	}

	public function store(StoreCustomerRequest $request)
	{
		/**
		 * Handle upload an image
		 */
		$image = '';
		if ($request->hasFile('photo')) {
			$image = $request->file('photo')->store('customers', 'public');
		}

		// dd($request);

		Customer::create([
			'user_id' => auth()->id(),
			'uuid' => Str::uuid(),
			'photo' => $image,
			'name' => $request->name,
			'customer_type' => $request->customer_type,
			'email' => $request->email,
			'store_address' => $request->store_address,
			'phone' => $request->phone,
			'address' => $request->address,
		]);


		if (str_contains(url()->previous(), '/orders/create')) {
			return redirect()->route('orders.create');
		} else {
			return redirect()
				->route('customers.index')
				->with('success', 'New customer has been created!');
		}
	}

	public function show($uuid)
	{
		$customer = Customer::where('uuid', $uuid)->firstOrFail();
		$customer->loadMissing(['quotations', 'orders'])->get();

		return view('customers.show', [
			'customer' => $customer
		]);
	}

	public function edit($uuid)
	{
		$customer = Customer::where('uuid', $uuid)->firstOrFail();
		return view('customers.edit', [
			'customer' => $customer
		]);
	}

	public function update(UpdateCustomerRequest $request, $uuid)
	{
		$customer = Customer::where('uuid', $uuid)->firstOrFail();

		/**
		 * Handle upload image with Storage.
		 */
		$image = $customer->photo;
		if ($request->hasFile('photo')) {
			if ($customer->photo) {
				unlink(public_path('storage/') . $customer->photo);
			}
			$image = $request->file('photo')->store('customers', 'public');
		}

		$customer->update([
			'photo' => $image,
			'name' => $request->name,
			'email' => $request->email,
			'phone' => $request->phone,
			'customer_type' => $request->customer_type,
			'store_address' => $request->store_address,
			'address' => $request->address,
		]);
		// dd($request->customer_type." ".$customer);

		return redirect()
			->route('customers.index')
			->with('success', 'Customer has been updated!');
	}

	public function destroy($uuid)
	{
		$customer = Customer::where('uuid', $uuid)->firstOrFail();
		if ($customer->photo) {
			unlink(public_path('storage/') . $customer->photo);
		}

		$customer->delete();

		return redirect()
			->back()
			->with('success', 'Customer has been deleted!');
	}
}
