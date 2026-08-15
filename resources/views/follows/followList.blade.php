<x-login-layout>

  <div class="user-list">

    {{-- フォローしているユーザー一覧 --}}
    <section class="user-list-users">

      {{-- ページタイトル --}}
      <h2 class="user-list-title">
        フォローリスト
      </h2>

      {{-- ユーザーアイコン一覧 --}}
      <div class="user-list-icons">

        @forelse ($users as $user)

        {{-- ユーザープロフィールへのリンク --}}
        <a
          href="{{ route('users.show', $user->id) }}"
          class="user-list-user user-icon-link"
          aria-label="{{ $user->username }}のプロフィールを見る">
          {{-- ユーザーアイコン --}}
          <img
            src="{{ Str::startsWith($user->icon_image, 'icons/')
      ? asset('storage/' . $user->icon_image)
      : asset('images/' . $user->icon_image) }}"
            alt="{{ $user->username }}のアイコン"
            class="user-list-icon">
        </a>

        @empty

        {{-- フォロー中ユーザーが0人の場合 --}}
        <p class="user-list-empty">
          フォローしているユーザーはいません。
        </p>

        @endforelse

      </div>

    </section>


    {{-- フォロー中ユーザーの投稿一覧 --}}
    <div class="post-list">

      @forelse ($posts as $post)

      {{-- 投稿1件 --}}
      <article class="post-list-item">

        {{-- 投稿者アイコン --}}
        <a
          href="{{ route('users.show', $post->user->id) }}"
          class="post-list-icon user-icon-link"
          aria-label="{{ $post->user->username }}のプロフィールを見る">
          <img
            src="{{ Str::startsWith($post->user->icon_image, 'icons/')
      ? asset('storage/' . $post->user->icon_image)
      : asset('images/' . $post->user->icon_image) }}"
            alt="{{ $post->user->username }}のアイコン">
        </a>

        {{-- 投稿内容 --}}
        <div class="post-list-body">

          <div class="post-list-header">

            <p class="post-list-username">
              {{ $post->user->username }}
            </p>

            <time
              class="post-list-date"
              datetime="{{ $post->created_at->toIso8601String() }}">
              {{ $post->created_at->format('Y-m-d H:i') }}
            </time>

          </div>

          <p class="post-list-text">
            {{ $post->post }}
          </p>

        </div>

      </article>

      @empty

      <p class="post-list-empty">
        フォローしているユーザーの投稿はありません。
      </p>

      @endforelse

    </div>
  </div>

</x-login-layout>
