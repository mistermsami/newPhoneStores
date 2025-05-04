<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\WearhouseLocations;
use Str;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        // TODO: Select columns
        $users = User::all();

        return view('users.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        $wearhouselocations = WearhouseLocations::all();
        return view('users.create', [
            'wearhouselocations' => $wearhouselocations
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        // dd($request->all());
        $user = User::create([
            'name'  => $request->name,
            'uuid' => Str::uuid(),
            'username'  =>  $request->email,
            'email'  =>  $request->email,
            'password'  => Hash::make($request->password),
            'wearhouse_id' => $request->wearhouselocations,
        ]);


        /**
         * Handle upload an image
         */
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

            $file->storeAs('profile/', $filename, 'public');
            $user->update([
                'photo' => $filename
            ]);
        }

        return redirect()
            ->route('users.index')
            ->with('success', 'New User has been created!');
    }

    public function show($uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();
        return view('users.show', [
            'user' => $user
        ]);
    }
    public function edit(User $user)
    {
        $wearhouselocations = WearhouseLocations::all();
        return view('users.edit', [
            'user' => $user,
            'wearhouselocations' => $wearhouselocations
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {

        //        if ($validatedData['email'] != $user->email) {
        //            $validatedData['email_verified_at'] = null;
        //        }

        $user->update($request->except('photo'));


        /**
         * Handle upload image with Storage.
         */
        if ($request->hasFile('photo')) {

            // Delete Old Photo
            if ($user->photo) {
                unlink(public_path('storage/profile/') . $user->photo);
            }

            // Prepare New Photo
            $file = $request->file('photo');
            $fileName = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();

            // Store an image to Storage
            $file->storeAs('profile/', $fileName, 'public');

            // Save DB
            $user->update([
                'photo' => $fileName
            ]);
        }

        return redirect()
            ->route('users.index')
            ->with('success', 'User has been updated!');
    }

    public function updatePassword(Request $request, User $user)
    {
        # Validation
        $validated = $request->validate([
            'password' => 'required_with:password_confirmation|min:6',
            'password_confirmation' => 'same:password|min:6',
        ]);
        # Update the new Password
        User::where('username', $user->email)->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User has been updated!');
    }

    public function destroy(User $user)
    {
        /**
         * Delete photo if exists.
         */
        if ($user->photo) {

            // Log an info message to the custom log file
            // Log::channel('info_logs')->info($user->photo);
            unlink(public_path('storage/profile/') . $user->photo);
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User has been deleted!');
    }

    public function usercustomers(){
        return view('users.usercustomers');
    }
}
