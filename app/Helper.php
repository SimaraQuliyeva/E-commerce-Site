<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('deleteFunc')){
    function deleteFunc($string){
        if (!empty($string) && Storage::disk('public')->exists($string)) {
            Storage::disk('public')->delete($string);
        }
    }
}

if (!function_exists('generateOTP')){
    function generateOTP($n){
        $generator='1357902468';
        $result='';
        for ($i=0; $i<=$n; $i++){
            $result .=substr($generator,(rand()%(strlen($generator))),1);
        }
        return $result;
    }

    }

