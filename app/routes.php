<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
Route::get('/', function(){
    $about = Artisan::call('app:test-art');
    return $about;
});