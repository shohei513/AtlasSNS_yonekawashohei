<x-login-layout>

  <div class="profile-header">

    {{-- ユーザーアイコン --}}
    <img
      src="{{ Str::startsWith($user->icon_image, 'icons/')
      ? asset('storage/' . $user->icon_image)
      : asset('images/' . $user->icon_image) }}"
      alt="{{ $user->username }}のアイコン"
      class="profile-header-icon">

    {{-- ユーザー情報 --}}
    <div class="profile-header-info">

      <div class="profile-header-row">
        <p class="profile-header-label">
          ユーザー名
        </p>

        <p class="profile-header-name">
          {{ $user->username }}
        </p>
      </div>

      <div class="profile-header-row">
        <p class="profile-header-label">
          自己紹介
        </p>

        <p class="profile-header-bio">{{ $user->bio }}</p>
      </div>

    </div>

    {{-- 自分以外のプロフィールにだけ表示 --}}
    @if (auth()->id() !== $user->id)

    <div class="profile-header-action">

      @if ($isFollowing)

      <form action="{{ route('follow.destroy', $user->id) }}" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit" class="unfollow-button">
          フォロー解除
        </button>
      </form>

      @else

      <form action="{{ route('follow.store', $user->id) }}" method="POST">
        @csrf

        <button type="submit" class="follow-button">
          フォローする
        </button>
      </form>

      @endif
    </div>
    @endif
  </div>




  {{-- 投稿一覧 --}}
  <div class="post-list">

    @forelse ($posts as $post)
    <div class="post-list-item">

      {{-- ユーザーアイコン --}}
      <a
        href="{{ route('users.show', $post->user->id) }}"
        class="post-list-icon">
        <img
          src="{{ Str::startsWith($post->user->icon_image, 'icons/')
      ? asset('storage/' . $post->user->icon_image)
      : asset('images/' . $post->user->icon_image) }}"
          alt="{{ $post->user->username }}のアイコン">
      </a>

      {{-- 投稿情報 --}}
      <div class="post-list-body">

        <div class="post-list-header">

          <p class="post-list-username">
            {{ $post->user->username }}
          </p>

          <p class="post-list-date">
            {{ $post->created_at->format('Y-m-d H:i') }}
          </p>

        </div>

        <p class="post-list-text">
          {{ $post->post }}
        </p>

      </div>

    </div>
    @empty
    <p class="post-list-empty">
      投稿はありません。
    </p>
    @endforelse

  </div>


</x-login-layout>
