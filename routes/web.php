<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\loginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::group(['prefix'=>'account'],function(){

    Route::group(['middleware' => 'guest'],function(){

                Route::get('login',[loginController::class, 'LoginIndex'])->name('account.login');
                Route::get('registration',[loginController::class, 'RegisterIndex'])->name('account.registration');
                Route::post('Auth-Login',[loginController::class, 'AuthLogin'])->name('account.AuthLogin');
                Route::post('Auth-Registration',[loginController::class, 'AuthRegistration'])->name('account.AuthRegistration'); 

    });

    Route::group(['middleware' => 'auth'],function(){
                Route::get('dashboard',[DashboardController::class, 'dashboard'])->name('account.dashboard');
                Route::get('logout',[loginController::class, 'logout'])->name('account.logout');

});
});

Route::group(['prefix'=>'admin'],function(){

  
    Route::group(['middleware' => 'admin.guest'],function(){
        Route::get('login',[AdminLoginController::class, 'LoginIndex'])->name('admin.login');
       Route::post('Auth-Login',[AdminLoginController::class, 'AuthLogin'])->name('admin.AuthLogin');


    });

    Route::group(['middleware' => 'admin.auth'],function(){
        Route::get('dashboard',[AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('logout',[AdminLoginController::class, 'logout'])->name('admin.logout');



    });

});








