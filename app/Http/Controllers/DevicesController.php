<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DevicesController extends Controller
{
	public function index()
	{
		$devices = Device::where("user_id", auth()->id())->count();

		return view('devices.index', [
			'devices' => $devices
		]);
	}

	public function create()
	{
		return view('devices.create');
	}

	public function store(Request $request)
	{
		$request->validate([
			'device_name' => 'required|string',
		]);

		Device::create([
			'user_id' => auth()->id(),
			'name' => $request->device_name
		]);

		return redirect()->route('devices.index')->with('success', 'Device has been created!');
	}

	public function edit(Device $device)
	{
		return view('devices.edit', [
			'device' => $device
		]);
	}

	public function update(Request $request, Device $device)
	{
		$request->validate([
			'device_name' => 'required|string',
		]);

		$device->update([
			'name' => $request->device_name
		]);

		return redirect()->route('devices.index')->with('success', 'Device has been updated!');

	}

	public function destroy(Device $device)
	{
		$device->delete();
		return redirect()->route('devices.index')->with('success', 'Device has been deleted!');
	}
}
