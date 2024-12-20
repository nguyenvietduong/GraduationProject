<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;
use App\Interfaces\Services\AccountServiceInterface;
use App\Models\User;

class ProfilesController extends Controller
{

    protected $imageService;
    protected $accountService;

    public function __construct(
        ImageService $imageService,
        AccountServiceInterface $accountService,
    ) {
        $this->imageService = $imageService;
        $this->accountService = $accountService;
    }

    public function profile()
    {
        $auth = auth()->user();
        return view('frontend.profile', compact('auth'));
    }

    public function update_profile(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => ['required', 'regex:/^[0-9\-\+\(\)\s]+$/', 'max:15'],
            'email' => 'required|email|max:255',
            'address' => 'nullable|string|max:255',
            'birthday' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('image')) {
            $data['image'] = $this->imageService->updateImage('account_files', $request->file('image'), Auth::user()->image);
        }


        $user->update($data);

        return redirect()->back()->with('success', __('messages.system.button.update_profiles'));
    }
}
