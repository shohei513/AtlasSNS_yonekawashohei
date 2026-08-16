<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;

class UsersController extends Controller
{

    public function show($id)
    {
        // 表示するユーザーを取得
        $user = User::findOrFail($id);

        // フォロー状態を確認
        $isFollowing = auth()->user()
            ->followings()
            ->where('users.id', $id)
            ->exists();

        // ユーザーの投稿を取得
        $posts = Post::with('user')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view(
            'profiles.profile',
            compact('user', 'posts', 'isFollowing')
        );
    }


    public function followList()
    {
        // フォロー中ユーザーを取得
        $users = auth()->user()
            ->followings()
            ->get();

        // フォロー中ユーザーのIDを取得
        $followingIds = $users->pluck('id');

        // フォロー中ユーザーの投稿を新しい順で取得
        $posts = Post::with('user')
            ->whereIn('user_id', $followingIds)
            ->latest()
            ->get();

        // ユーザーと投稿をBladeへ渡す
        return view('follows.followList', compact('users', 'posts'));
    }


    public function followerList()
    {
        // ログインユーザーをフォローしているユーザーを取得
        $users = auth()->user()
            ->followers()
            ->get();

        // フォロワーのIDを取得
        $followerIds = $users->pluck('id');

        // フォロワーの投稿を取得
        $posts = Post::with('user')
            ->whereIn('user_id', $followerIds)
            ->latest()
            ->get();

        return view('follows.followerList', compact('users', 'posts'));
    }




    public function search(Request $request)
    {
        // URLから検索ワードを取得
        $keyword = $request->input('keyword');

        // 自分以外のユーザーを取得するための検索処理
        $users = User::query()
            ->where('id', '!=', Auth::id())

            // 検索ワードが入力されている場合だけユーザー名を絞り込む
            ->when($keyword, function ($query, $keyword) {
                $query->where('username', 'like', '%' . $keyword . '%');
            })

            // ユーザーIDの昇順で取得
            ->orderBy('id', 'desc')
            ->get();

        $followingIds = auth()->user()
            ->followings()
            ->pluck('users.id');

        // 検索ワードとユーザー情報をBladeへ渡す
        return view('users.search', compact('users', 'keyword', 'followingIds'));
    }
}
