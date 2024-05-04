<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['prefix'=>'/'],function(){

    Route::group(['middleware'=>'guest'],function(){

        Route::get('register',[AuthController::class,'register'])->name('account.register');
        Route::post('register_hendle',[AuthController::class,'register_hendle'])->name('account.register_hendle');
        Route::get('login',[AuthController::class,'login'])->name('account.login');
        Route::post('login_hendle',[AuthController::class,'login_hendle'])->name('account.login_hendle');

    });
    Route::group(['middleware'=>'auth'],function(){

        // Route::get('/',[TaskController::class,'index'])->name('index');
        // Route::get('/create',[TaskController::class,'create'])->name('create');
        // Route::get('/store',[TaskController::class,'store'])->name('store');
        // Route::get('/edit',[TaskController::class,'edit'])->name('edit');
        // Route::get('/update',[TaskController::class,'update'])->name('update');
        // Route::get('/destroy',[TaskController::class,'destroy'])->name('destroy');
        Route::resource('/task',TaskController::class);

        Route::get('logout',[AuthController::class,'logout'])->name('account.logout');  
    });
});







