<?php

use Illuminate\Support\Facades\Route;

if(! function_exists('bsIsActive')){
    function bsIsActive($key,$class='active'){
        if(is_array($key)){
            return in_array(Route::currentRouteName(),$key) ? $class : '';
        }
        return Route::currentRouteName() == $key ? $class : null;
    }
}