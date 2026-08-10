<x-logout-layout>

  <!-- 適切なURLを入力してください -->
  {!! Form::open(['url' => 'login','method' => 'post','class' => 'login-form']) !!}

  <div class="login-title">
    <p>AtlasSNSへようこそ</p>
  </div>

  <div class="login-box">
    {{ Form::label('email','メールアドレス') }}
    {{ Form::text('email',null,['class' => 'input']) }}
  </div>

  <div class="login-box">
    {{ Form::label('password','パスワード') }}
    {{ Form::password('password',['class' => 'input']) }}
  </div>

  {{ Form::submit('ログイン') }}

  <p class="register-link"><a href="register">新規ユーザーの方はこちら</a></p>

  {!! Form::close() !!}

</x-logout-layout>
