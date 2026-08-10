<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        //新規登録情報をバリデーション
        $request->validate(
            [
                'username' => [
                    'required',
                    'string',
                    'min:2',
                    'max:12',
                ],
                'email' => [
                    'required',
                    'string',
                    'min:5',
                    'max:40',
                    'email',
                    'unique:users,email',
                ],
                'password' => [
                    'required',
                    'alpha_num',
                    'min:8',
                    'max:20',
                    'confirmed',
                ],
                'password_confirmation' => [
                    'required',
                    'alpha_num',
                    'min:8',
                    'max:20',
                ],
            ],
            [
                // ユーザー名
                'username.required' => 'ユーザー名を入力してください。',
                'username.string' => 'ユーザー名は文字列で入力してください。',
                'username.min' => 'ユーザー名は2文字以上で入力してください。',
                'username.max' => 'ユーザー名は12文字以内で入力してください。',

                // メールアドレス
                'email.required' => 'メールアドレスを入力してください。',
                'email.string' => 'メールアドレスは文字列で入力してください。',
                'email.min' => 'メールアドレスは5文字以上で入力してください。',
                'email.max' => 'メールアドレスは40文字以内で入力してください。',
                'email.email' => '正しいメールアドレス形式で入力してください。',
                'email.unique' => 'このメールアドレスはすでに登録されています。',

                // パスワード
                'password.required' => 'パスワードを入力してください。',
                'password.alpha_num' => 'パスワードは半角英数字のみで入力してください。',
                'password.min' => 'パスワードは8文字以上で入力してください。',
                'password.max' => 'パスワードは20文字以内で入力してください。',
                'password.confirmed' => 'パスワード確認欄と一致していません。',

                // パスワード確認
                'password_confirmation.required' => '確認用パスワードを入力してください。',
                'password_confirmation.alpha_num' => '確認用パスワードは半角英数字のみで入力してください。',
                'password_confirmation.min' => '確認用パスワードは8文字以上で入力してください。',
                'password_confirmation.max' => '確認用パスワードは20文字以内で入力してください。',
            ]
        );

        //入力された情報をusersテーブルに保存
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //登録完了ページに移動して、ユーザー名を渡す
        return redirect('added')
            ->with('username', $user->username);
    }

    public function added(): View
    {
        return view('auth.added');
    }
}
