<?php

namespace App\Http\Controllers\repairParts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RepairParts;

class RepairPartsController extends Controller
{
	public function index()
	{
		$repairParts = RepairParts::all()->count();

		return view('repairParts.index', compact('repairParts'));
	}

	public function create()
	{
		return view('repairParts.create');
	}

	public function store(Request $request)
	{
		$request->validate(['name' => 'required']);

		RepairParts::create([
			'name' => $request->name,
			'user_id' => auth()->id()
		]);

		return redirect()->route('repair-parts.index')->with('success', 'Repair Part has been created!');
	}

	public function edit(RepairParts $repairPart)
	{
		return view('repairParts.edit', ['repairPart' => $repairPart]);
	}

	public function update(Request $request, RepairParts $repairPart)
	{
		$request->validate(['name' => 'required']);

		$repairPart->update([
			'name' => $request->name,
		]);

		return redirect()->route('repair-parts.index')->with('success', 'Repair Part has been updated!');
	}

	public function destroy(RepairParts $repairPart)
	{
		$repairPart->delete();

		return redirect()->route('repair-parts.index')->with('success', 'Repair Part has been deleted!');
	}
}
