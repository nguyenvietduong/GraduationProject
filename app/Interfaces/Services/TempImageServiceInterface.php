<?php

namespace App\Interfaces\Services;

use Illuminate\Http\UploadedFile;

interface TempImageServiceInterface
{
    public function deleteTempImagesForUser();
}
