<?php

use Illuminate\Http\Request;
use Illuminate\Support\Faceades\Route;

use App\Illuminate\Http\Controllers\API\RegisterController;
use App\Illuminate\Http\Controllers\API\ProductController;

Route:: post('register',[RegisterController::class, 'register']);
Route:: post('login', [RegisterController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::resource('products', ProductController::class);
    
        
    });
    
?>
