<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use App\Interfaces\Services\AccountServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;

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
     * @return \Illuminate\Http\JsonResponse
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
            return response()->json(['success' => false, 'message' => 'Failed to update profile image: ' . $e->getMessage()]);
        }
    }

    public function updateProfile(Request $request)
    {
        // Validate input data
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => [
                'required',
                'regex:/^(0|\+84)[1-9][0-9]{8}$/', // Số điện thoại Việt Nam: bắt đầu bằng 0 hoặc +84 và có 9 chữ số tiếp theo
                'max:10'
            ],
            'email' => 'required|email|max:255',
            'address' => 'nullable|string|max:255',
        ]);        

        // Update user profile if no validation errors
        $user = Auth::user();
        $user->update($request->all());

        // Return success response
        return response()->json(['success' => 'Cập nhật thông tin thành công!']);
    }
}
