<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use App\Interfaces\Services\AccountServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\BackEnd\Accounts\UpdateRequest as AccountUpdateRequest;

class ProfileController extends Controller
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

    /**
     * Update the account's profile image.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfileImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $account = Auth::user();

        try {
            // Update image using local storage
            $newImagePath = $this->imageService->updateImage(
                'profile_images',
                $request->file('profile_image'),
                $account->image // Old image path to delete if exists
            );

            // Update account's profile image
            $account->image = $newImagePath;
            $account->save();

            // Return JSON response with the new image URL
            return response()->json([
                'success' => true,
                'new_image_url' => Storage::url($newImagePath),
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update profile image.']);
        }
    }

    public function updateProfile(AccountUpdateRequest $request)
    {
        $idProfile = $request->id;
        if ($this->accountService->updateAccount($idProfile, $request)) {
            return redirect()->route('admin.profile')->with('success', 'Record updated successfully');
        }
        return redirect()->route('admin.profile')->with('error', 'Failed to update record. Please try again');
    }
}
