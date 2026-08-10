<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    //
    public function index()
    {
        // 自分がフォローしているユーザーIDを取得
        $followingIds = Auth::user()
            ->followings()
            ->pluck('users.id');

        // 自分のIDも表示対象に追加
        $followingIds->push(Auth::id());

        // 自分とフォロー中ユーザーの投稿を取得
        $posts = Post::with('user')
            ->whereIn('user_id', $followingIds)
            ->latest()
            ->get();

        return view('posts.index', compact('posts'));
    }

    /* 投稿内容をデータベースに登録 */
    public function store(Request $request)
    {

        // 投稿内容をバリデーション
        $request->validate([
            'post' => [
                'required',
                'string',
                'min:1',
                'max:150',
            ],
        ], [
            'post.required' => '投稿内容を入力してください。',
            'post.min' => '投稿内容は1文字以上で入力してください。',
            'post.max' => '投稿内容は150文字以内で入力してください。',
        ]);

        Post::create([
            'user_id' => auth()->id(),
            'post' => $request->post,
        ]);

        return redirect()->route('top');
    }

    // 投稿削除
    public function destroy($id)
    {
        // ログインユーザー自身の投稿だけを取得
        $post = Post::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // 投稿を削除
        $post->delete();

        return redirect()->route('top');
    }

    // 投稿編集処理
    public function update(Request $request, Post $post)
    {
        // 自分以外の投稿は編集できない
        abort_if($post->user_id !== Auth::id(), 403);

        // 投稿内容をバリデーション
        $validated = $request->validate([
            'post' => ['required', 'string', 'max:150'],
        ]);

        // 投稿内容を更新
        $post->update([
            'post' => $validated['post'],
        ]);

        // 更新後にトップページを再表示
        return redirect()->route('top');
    }
}
