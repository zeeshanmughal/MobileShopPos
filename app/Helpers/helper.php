<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('admin_asset')) {
    function admin_asset($path)
    {
        return asset("admin/assets/{$path}");
    }
}

if (!function_exists('retailer_asset')) {
    function retailer_asset($path)
    {
        return asset("shop_retailer/{$path}");
    }
}

if (!function_exists('createSlug')) {
    function createSlug($string, $separator = '-')
    {
        // Replace spaces with the separator
        $slug = str_replace(' ', $separator, $string);
        
        // Remove special characters
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug);

        // Replace multiple occurrences of the separator with a single occurrence
        $slug = preg_replace('/' . $separator . '{2,}/', $separator, $slug);

        // Convert the slug to lowercase
        $slug = strtolower($slug);

        return $slug;
    }
}

if(!function_exists('saveImage')){
     function saveImage($image, $folder)
    {
        $imageName = time() . '_' . $image->getClientOriginalName();
        if (!Storage::exists('public/' . $folder)) {
            Storage::makeDirectory('public/' . $folder);
        }
        $image->storeAs('public/' . $folder, $imageName);

        $imagePath = 'storage/' . $folder . '/' . $imageName;

        // Additional logic for storing in the database here
        // For example, you can use Eloquent to save the path to the database

        return $imagePath;
    }
}
