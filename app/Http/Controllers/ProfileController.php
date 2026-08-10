<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    // プロフィール編集画面表示
    public function edit()
    {
        return view('profiles.edit');
    }


    // プロフィール更新処理
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'username' => [
                'required',
                'string',
                'min:2',
                'max:12',
            ],

            'email' => [
                'required',
                'string',
                'email',
                'min:5',
                'max:40',
                Rule::unique('users', 'email')->ignore($user->id),
            ],

            'new_password' => [
                'nullable',
                'regex:/^[a-zA-Z0-9]+$/',
                'min:8',
                'max:20',
                'confirmed',
            ],

            'new_password_confirmation' => [
                'nullable',
                'regex:/^[a-zA-Z0-9]+$/',
                'min:8',
                'max:20',
            ],

            'bio' => [
                'nullable',
                'string',
                'max:150',
            ],

            'icon_image' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,bmp,gif,svg',
            ],
        ], [
            'username.required' => 'ユーザー名を入力してください。',
            'username.min' => 'ユーザー名は2文字以上で入力してください。',
            'username.max' => 'ユーザー名は12文字以内で入力してください。',

            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => '正しいメールアドレス形式で入力してください。',
            'email.min' => 'メールアドレスは5文字以上で入力してください。',
            'email.max' => 'メールアドレスは40文字以内で入力してください。',
            'email.unique' => 'このメールアドレスはすでに登録されています。',

            'new_password.regex' => 'パスワードは半角英数字のみで入力してください。',
            'new_password.min' => 'パスワードは8文字以上で入力してください。',
            'new_password.max' => 'パスワードは20文字以内で入力してください。',
            'new_password.confirmed' => 'パスワード確認欄と一致していません。',

            'new_password_confirmation.regex' => '確認用パスワードは半角英数字のみで入力してください。',
            'new_password_confirmation.min' => '確認用パスワードは8文字以上で入力してください。',
            'new_password_confirmation.max' => '確認用パスワードは20文字以内で入力してください。',

            'bio.max' => '自己紹介は150文字以内で入力してください。',

            'icon_image.mimes' => 'プロフィール画像はjpg、jpeg、png、bmp、gif、svg形式の画像を選択してください。',
        ]);

        $user->username = $request->username;
        $user->email = $request->email;
        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }
        $user->bio = $request->bio;

        if ($request->hasFile('icon_image')) {
            $path = $request->file('icon_image')->store('icons', 'public');

            $user->icon_image = $path;
        }

        $user->save();

        return redirect()
            ->route('profile.edit')
            ->with('success', 'プロフィールを更新しました。');
    }
}
