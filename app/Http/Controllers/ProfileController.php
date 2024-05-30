<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
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
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function showVisitedPages(Request $request)
    {
        $visitedPages = $request->session()->get('visited_pages', []);

        return view('visited_pages', ['visitedPages' => $visitedPages]);
    }

    public function logVisitedPages(Request $request)
    {
        $visitedPages = $request->session()->get('visited_pages', []);
        $currentPage = $request->fullUrl();

        if (!in_array($currentPage, $visitedPages)) {
            $visitedPages[] = $currentPage;
            $request->session()->put('visited_pages', $visitedPages);
        }
    }

    public function sendEmail(Request $request)
    {
        $user = User::all();

        $token = csrf_token();

        Mail::to($user)->send(new UserEmail($user));

        return response()->json(['success'=>'Send email successfully.']);
    }
    public function trackExternalLink(Request $request)
    {
        return response()->json(['success' => true]);
    }


}
