<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    // ログイン画面を表示
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');
    // ログイン処理
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    //新規登録画面の表示
    Route::get('register', [RegisteredUserController::class, 'create']);
    //入力された新規登録情報をデータベースに保存
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('added', [RegisteredUserController::class, 'added']);
    Route::post('added', [RegisteredUserController::class, 'added']);
});

//ログアウト処理
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
