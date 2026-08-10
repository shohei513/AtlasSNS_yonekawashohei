<x-logout-layout>

    <!-- /registerにpostで入力値を送信 -->
    {!! Form::open([
    'url' => '/register',
    'method' => 'post',
    'class' => 'register-form'
    ]) !!}

    <div class="register-title">
        <h2>新規ユーザー登録</h2>
    </div>

    <div class="register-box">
        {{ Form::label('username', 'ユーザー名') }}
        {{ Form::text('username', null, ['class' => 'input']) }}

        @error('username')
        <p class="validation-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="register-box">
        {{ Form::label('email', 'メールアドレス') }}
        {{ Form::email('email', null, ['class' => 'input']) }}

        @error('email')
        <p class="validation-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="register-box">
        {{ Form::label('password', 'パスワード') }}
        {{ Form::password('password', ['class' => 'input']) }}

        @error('password')
        <p class="validation-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="register-box">
        {{ Form::label('password_confirmation', 'パスワード確認') }}
        {{ Form::password('password_confirmation', ['class' => 'input']) }}
    </div>

    {{ Form::submit('新規登録', ['class' => 'register-submit']) }}

    <p class="login-link">
        <a href="login">ログイン画面に戻る</a>
    </p>

    {!! Form::close() !!}

</x-logout-layout>
