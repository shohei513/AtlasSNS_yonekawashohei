<x-login-layout>
  <div class="search-containar">
    {{-- ユーザー検索フォーム --}}
    <form
      action="{{ route('search') }}"
      method="GET"
      class="user-search">
      {{-- ユーザー名入力欄 --}}
      <input
        type="text"
        name="keyword"
        class="user-search-input"
        placeholder="ユーザー名"
        value="{{ request('keyword') }}">

      {{-- 検索ボタン --}}
      <button
        type="submit"
        class="user-search-button">
        <img
          src="{{ asset('images/search.png') }}"
          alt="検索">
      </button>
    </form>

    {{-- 検索ワード --}}
    @if ($keyword !== '')
    <p class="user-search-keyword">
      検索ワード：{{ $keyword }}
    </p>
    @endif

  </div>


  {{-- 検索ワードを表示 --}}

  {{-- ユーザー一覧 --}}
  <div class="user-search-list">

    @forelse ($users as $user)

    <div class="user-search-item">

      {{-- ユーザーアイコン --}}
      <div class="user-search-icon">
        <img
          src="{{ asset('images/' . $user->icon_image) }}"
          alt="{{ $user->username }}のアイコン">
      </div>

      {{-- ユーザー名 --}}
      <p class="user-search-username">
        {{ $user->username }}
      </p>

      {{-- フォローボタン部分 --}}
      <div class="user-search-actions">

        {{-- 自分自身にはフォローボタンを表示しない --}}
        @if ($user->id !== auth()->id())

        {{-- フォローしているユーザーの場合 --}}
        @if ($followingIds->contains($user->id))

        <form action="{{ route('follow.destroy', $user->id) }}" method="POST">
          @csrf
          @method('DELETE')

          <button type="submit" class="unfollow-button">
            フォロー解除
          </button>
        </form>

        {{-- フォローしていないユーザーの場合 --}}
        @else

        <form action="{{ route('follow.store', $user->id) }}" method="POST">
          @csrf

          <button type="submit" class="follow-button">
            フォローする
          </button>
        </form>

        @endif

        @endif

      </div>


    </div>

    @empty

    <p class="user-search-empty">
      該当するユーザーはいません。
    </p>

    @endforelse

  </div>

</x-login-layout>
