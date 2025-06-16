<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the participant's profile form.
     */
    public function edit(Request $request): View
    {
        return view('participants.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the participant's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Fill user data from validated request
        $request->user()->fill($request->validated());

        // Save changes
        $request->user()->save();

        return Redirect::route('participant.profile.edit')->with('status', 'Profil Berhasil Diperbarui!');
    }

    /**
     * Delete the participant's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Validate password
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Logout user
        Auth::logout();

        // Delete user
        $user->delete();

        // Invalidate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('status', 'Akun Anda telah dihapus');
    }
}