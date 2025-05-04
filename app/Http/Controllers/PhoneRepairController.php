<?php

namespace App\Http\Controllers;

use App\Http\Requests\phoneRepairs\StorePhoneRepairRequest;
use App\Models\PhoneRepair;
use App\Models\Product;
use App\Models\RepairParts;
use Illuminate\Http\Request;
use PHPUnit\Framework\MockObject\Stub\ReturnStub;

class PhoneRepairController extends Controller
{
	public function index()
	{
		$repairs = PhoneRepair::where("user_id", auth()->id())->count();

		return view("phone-repairs.index", compact("repairs"));
	}

	public function create()
	{
		$repairParts = RepairParts::where('user_id', auth()->id())->get();

		return view('phone-repairs.create', ['repairParts' => $repairParts]);
	}

	public function show($id)
	{
		$phoneRepair = PhoneRepair::where('phone_repairs.id', $id)
			->join('repair_parts', 'phone_repairs.repair_part_id', '=', 'repair_parts.id')
			->select('phone_repairs.*', 'repair_parts.name as repair_part_name')
			->first();

		return view('phone-repairs.show', ['phoneRepair' => $phoneRepair]);
	}

	public function store(StorePhoneRepairRequest $request)
	{
		// dd($request, ['user_id' => auth()->id()]);
		$request->validated();

		PhoneRepair::create([
			'user_id' => auth()->id(),
			'phone_name' => $request->phone_name,
			'repair_part_id' => $request->repair_part_id,
			'description' => $request->description,
			'status' => $request->status ?? 'pending',
		]);

		return redirect()->route('phone-repairs.index')->with('success', 'Phone Repair has been created!');
	}

	public function edit($id)
	{
		$phoneRepair = PhoneRepair::where('phone_repairs.id', $id)->first();
		$repairParts = RepairParts::where('user_id', auth()->id())->get();

		return view('phone-repairs.edit', ['phoneRepair' => $phoneRepair, 'repairParts' => $repairParts]);
	}

	public function update(Request $request, $id)
	{
		$phoneRepair = PhoneRepair::where('phone_repairs.id', $id)->first();

		$phoneRepair->update([
			'phone_name' => $request->phone_name,
			'repair_part_id' => $request->repair_part_id,
			'description' => $request->description,
			'status' => $request->status ?? 'pending',
		]);

		return redirect()->route('phone-repairs.index')->with('success', 'Phone Repair has been updated!');
	}

	public function destroy($id)
	{
		$phoneRepair = PhoneRepair::where('phone_repairs.id', $id)->first();
		$phoneRepair->delete();

		return redirect()->route('phone-repairs.index')->with('success', 'Phone Repair has been deleted!');
	}

}
