<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Booking;
use Carbon\Carbon;

class ProfileController extends Controller
{

    public function edit(Request $request): View
{
    $user = Auth::user();
    $activeBookings = Booking::where('user_id', $user->id)
                            ->isActive()
                            ->orderBy('start_time')
                            ->get();

    $pastBookings = Booking::where('user_id', $user->id)
                            ->where('start_time', '<', Carbon::now())
                            ->orderByDesc('start_time')
                            ->get();

    return view('profile.edit', [
        'user' => $request->user(),
        'activeBookings' => $activeBookings,
        'pastBookings' => $pastBookings,
    ]);
}

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
