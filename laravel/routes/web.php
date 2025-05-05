<?php

use App\Http\Controllers\TestController;
use Symfony\Component\Routing\Annotation\Route;

Route::get('/',function(){
    return view('welcome');
});
Route::get('/test', [TestController::class, 'test']);
