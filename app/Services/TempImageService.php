<?php

namespace App\Services;

use App\Interfaces\Services\TempImageServiceInterface;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class TempImageService implements TempImageServiceInterface
{
    public function deleteTempImagesForUser()
    {
        // Determine the temporary directory path for the user
        $tempImagePath = "temp_images/" . auth()->id() . "/"; // Temporary path for the current user

        // Check if the directory exists
        if (Storage::exists($tempImagePath)) {
            // Retrieve the list of all files in the directory
            $files = Storage::files($tempImagePath);
            
            // Delete all files in the directory
            foreach ($files as $file) {
                Storage::delete($file); // Delete each file
            }

            // Remove temporary value in the session
            Session::forget('image_temp');

            return ['message' => 'All temporary files in the directory have been deleted for the user.'];
        }

        return ['message' => 'Temporary directory does not exist.'];
    }
}
