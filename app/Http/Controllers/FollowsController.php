<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowsController extends Controller
{
    //
    // public function followList()
    // {
    //     return view('follows.followList');
    // }
    // public function followerList()
    // {
    //     return view('follows.followerList');
    // }

    // フォロー登録処理
    public function store($userId)
    {
        // 自分自身をフォローしようとした場合は何もしない
        if (auth()->id() === (int) $userId) {
            return redirect()->back();
        }

        // ログインユーザーとフォロー対象ユーザーを紐づける
        auth()->user()
            ->followings()
            ->syncWithoutDetaching([$userId]);
        // ->attach($userId);だと重複する可能性がある

        // 元の画面へ戻る
        return redirect()->back();
    }

    // フォロー解除処理
    public function destroy($userId)
    {
        // ログインユーザーと対象ユーザーの紐づけを削除
        auth()->user()
            ->followings()
            ->detach($userId);

        // 元の画面へ戻る
        return redirect()->back();
    }
}
