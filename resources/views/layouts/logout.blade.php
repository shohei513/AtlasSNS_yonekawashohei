<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AtlasSNS / 改修課題</title>

    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('css/logout.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <a href="{{ route('top') }}"><img class="auth-icon" src="images/atlas.png" alt="ロゴ"></a>
        <p class="auth-title">Social Network Service</p>
    </header>
    <div id="container">
        {{ $slot }}
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
