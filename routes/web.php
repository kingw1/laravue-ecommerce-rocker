<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin/index');
});

Route::get('/login', function () {
    return view('auth/sign-in');
});

Route::post('/login_user', [AuthController::class, 'login']);

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
});
