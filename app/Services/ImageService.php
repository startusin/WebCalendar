<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function deleteImage($column, $path, $settings)
    {
        if ($path != null) {
            Storage::disk('public')->delete($path);
            if ($column == 'bg') {
                $settings['bg_image'] = null;
            }
            if ($column == 'lg') {
                $settings['logo'] = null;
            }
            if ($column == 'bn') {
                $settings['banner'] = null;
            }
            $settings->save();
        }
        return 200;
    }
}
