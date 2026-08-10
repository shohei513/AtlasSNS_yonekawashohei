<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <!--IEブラウザ対策-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="ページの内容を表す文章" />
  <title>AtlasSNS / 改修課題</title>
  <!-- Noto Sans JP -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
  <!--スマホ,タブレット対応-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Scripts -->
  <!--サイトのアイコン指定-->
  <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
  <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
  <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
  <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
  <!--iphoneのアプリアイコン指定-->
  <link rel="apple-touch-icon-precomposed" href="画像のURL" />
  <!--OGPタグ/twitterカード-->

</head>

<body>
  <header>
    @include('layouts.navigation')
  </header>
  <!-- Page Content -->
  <div id="row">
    <div id="container">
      {{ $slot }}
    </div>
    <div id="side-bar">
      <div id="confirm">
        <p>{{ Auth::user()->username }}さんの</p>
        <div class="side-bar-containar">
          <p class="side-bar-text">フォロー数</p>
          <p>
            {{ auth()->user()->followings()->count() }}名
          </p>
        </div>
        <div class="side-button-containar">
          <a href="{{ route('follow-list') }}" class="side-button-follow">フォローリスト</a>
        </div>
        <div class="side-bar-containar">
          <p class="side-bar-text">フォロワー数</p>
          <p>
            {{ auth()->user()->followers()->count() }}名
          </p>
        </div>
        <div class="side-button-containar">
          <a href="{{ route('follower-list') }}" class="side-button-follower">フォロワーリスト</a>
        </div>
      </div>
      <div class="button-containar">
        <a href="{{ route('search') }}" class="side-bar-button">ユーザー検索</a>
      </div>
    </div>
  </div>
  <footer>
  </footer>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="{{ asset('js/script.js') }}"></script>

</body>

</html>
