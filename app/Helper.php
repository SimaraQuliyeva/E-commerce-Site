<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('deleteFunc')){
    function deleteFunc($string){
        if (!empty($string) && Storage::disk('public')->exists($string)) {
            Storage::disk('public')->delete($string);
        }
    }
}

