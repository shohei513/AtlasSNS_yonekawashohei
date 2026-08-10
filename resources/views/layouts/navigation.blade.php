<div id="head">

    <h1>
        <a href="{{ route('top') }}">
            <img
                src="{{ asset('images/atlas.png') }}"
                alt="ロゴ">
        </a>
    </h1>

    <div class="header-user">
        <div class="user-menu">

            {{-- メニューを開閉するボタン --}}
            <button type="button" class="user-menu-button">
                <span class="user-name">
                    {{ Auth::user()->username }}　さん　
                </span>

                <span class="menu-arrow"></span>
            </button>

            <ul class="user-menu-list">
                <li>
                    <a href="{{ route('top') }}">HOME</a>
                </li>
                <li>
                    <a href="{{ route('profile.edit') }}">プロフィール編集</a>
                </li>
                <li>
                    <form method="post" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-button">
                            ログアウト
                        </button>
                    </form>
                </li>
            </ul>

        </div>

        {{-- ユーザーアイコン --}}
        <img
            src="{{ asset('images/' . Auth::user()->icon_image) }}"
            alt="ユーザーアイコン"
            class="user-icon">

    </div>

</div>

<script src="{{ asset('js/header.js') }}"></script>
