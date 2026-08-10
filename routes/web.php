<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('auth')->group(function () {
  // ログイン中だけ使えるSNSページ
  Route::get('top', [PostsController::class, 'index'])
    ->name('top');

  // 投稿内容を登録
  Route::post('post', [PostsController::class, 'store'])
    ->name('post.store');


  // プロフィール編集表示
  Route::get('/profile/edit', [ProfileController::class, 'edit'])
    ->name('profile.edit');
  // プロフィール更新
  Route::put('/profile', [ProfileController::class, 'update'])
    ->name('profile.update');


  Route::get('search', [UsersController::class, 'search'])
    ->name('search');


  Route::get('follow-list', [UsersController::class, 'followList'])
    ->name('follow-list');
  Route::get('follower-list', [UsersController::class, 'followerList'])
    ->name('follower-list');

  Route::get('/users/{user}', [UsersController::class, 'show'])
    ->name('users.show');

  // 投稿削除
  Route::delete('/post/{id}', [PostsController::class, 'destroy'])
    ->name('post.destroy');

  // 投稿編集処理
  Route::put('/post/{post}', [PostsController::class, 'update'])
    ->name('post.update');

  // 【追加】フォローする
  Route::post('/follow/{userId}', [FollowsController::class, 'store'])
    ->name('follow.store');

  // 【追加】フォロー解除
  Route::delete('/follow/{userId}', [FollowsController::class, 'destroy'])
    ->name('follow.destroy');
});

// auth.phpのルートを読み込む
require __DIR__ . '/auth.php';
