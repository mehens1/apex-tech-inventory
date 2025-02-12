<?php

namespace App\Services;

use Cloudinary\Cloudinary;
use Cloudinary\Transformation\Format;

Class FileUploadService
{
    protected $cloudinary;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary(config('cloudinary.cloud_url'));
    }

    public function uploadFile($file, $folder)
    {
        \Log::debug("file from file upload service: ");
        \Log::debug($file);

        \Log::debug("");

        \Log::debug("folder from file upload service: ");
        \Log::debug($folder);

        $response = $this->cloudinary->uploadApi()->upload($file->getRealPath(), [
            'folder' => $folder,
            'response_type' => 'auto',
        ]);

        return $response['secure_url'];
    }
}
