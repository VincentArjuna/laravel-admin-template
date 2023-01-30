<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasProfilePhoto
{
    /**
     * Update the user's profile photo.
     *
     * @param  \Illuminate\Http\UploadedFile  $photo
     * @return void
     */
    public function updateProfilePhoto(UploadedFile $photo)
    {
        $fileName = $this->id . '.' . $photo->getClientOriginalExtension();
        $path = $photo->storePubliclyAs('ProfilePhoto', $fileName, 'public');
        $path = "/storage/" . $path;
        $this->forceFill([
            'profile_photo' => $path,
        ])->save();
    }

    /**
     * Delete the user's profile photo.
     *
     * @return void
     */
    public function deleteProfilePhoto()
    {
        $path = str_replace("/storage/", '', $this->profile_photo);
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        } else {
        }
        $this->forceFill([
            'profile_photo' => 'https://ui-avatars.com/api/?name=' . str_replace(' ', '+', $this->name),
        ])->save();
    }
}
