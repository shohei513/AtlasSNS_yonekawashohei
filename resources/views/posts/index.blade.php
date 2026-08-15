<x-login-layout>


  {{-- 投稿フォーム全体 --}}
  <div class="post-form">

    {{-- ログインユーザーのアイコン --}}
    <div class="post-form-icon">
      <img
        src="{{ Str::startsWith(Auth::user()->icon_image, 'icons/')
        ? asset('storage/' . Auth::user()->icon_image)
        : asset('images/' . Auth::user()->icon_image) }}"
        alt="{{ auth()->user()->username }}のアイコン">
    </div>

    {{-- 投稿送信フォーム --}}
    <form
      action="{{ route('post.store') }}"
      method="POST"
      class="post-form-body">
      @csrf

      {{-- 投稿内容入力欄 --}}
      <input
        type="text"
        name="post"
        class="post-form-input"
        placeholder="投稿内容を入力する。"
        value="{{ old('post') }}">

      {{-- 投稿内容のバリデーションエラー --}}
      @error('post')
      <p class="validation-error">{{ $message }}</p>
      @enderror

      {{-- 投稿ボタン --}}
      <button type="submit" class="post-form-button">
        <img src="{{ asset('images/post.png') }}" alt="投稿">
      </button>

    </form>
  </div>



  {{-- 投稿一覧 --}}
  <div class="post-list">

    {{-- 投稿を1件ずつ繰り返して表示する --}}
    @forelse ($posts as $post)

    {{-- 投稿1件分 --}}
    <div class="post-list-item">

      {{-- 投稿者のアイコン --}}
      <div class="post-list-icon">
        <img
          src="{{ Str::startsWith($post->user->icon_image, 'icons/')
        ? asset('storage/' . $post->user->icon_image)
        : asset('images/' . $post->user->icon_image) }}"
          alt="{{ $post->user->username }}のアイコン">
        <!-- </a> -->
      </div>

      {{-- 投稿情報 --}}
      <div class="post-list-body">

        {{-- ユーザー名と投稿日時 --}}
        <div class="post-list-header">

          {{-- 投稿者名 --}}
          <p class="post-list-username">
            {{ $post->user->username }}
          </p>

          {{-- 投稿日時 --}}
          <p class="post-list-date">
            {{ $post->created_at->format('Y-m-d H:i') }}
          </p>

        </div>

        {{-- 投稿内容 --}}
        <p class="post-list-text">
          {{ $post->post }}
        </p>

      </div>

      {{-- 自分の投稿だけ編集・削除ボタンを表示する  --}}
      @if ((int) Auth::id() === (int) $post->user_id)

      <div class="post-list-actions">

        {{-- 編集ボタン --}}
        <button
          type="button"
          class="post-list-action-button post-list-edit-button"
          data-post-id="{{ $post->id }}"
          data-post-content="{{ $post->post }}">
          <img
            src="{{ asset('images/edit.png') }}"
            alt="編集"
            onmouseover="this.src='{{ asset('images/edit_h.png') }}'"
            onmouseout="this.src='{{ asset('images/edit.png') }}'">
        </button>

        {{-- 削除ボタン --}}
        <form
          action="{{ route('post.destroy', $post->id) }}"
          method="POST"
          onsubmit="return confirm('この投稿を削除しますか？');">

          @csrf
          @method('DELETE')

          <button
            type="button"
            class="post-list-action-button post-list-trash-button"
            data-delete-url="{{ route('post.destroy', $post->id) }}">

            <img
              src="{{ asset('images/trash.png') }}"
              alt="削除"
              onmouseover="this.src='{{ asset('images/trash-h.png') }}'"
              onmouseout="this.src='{{ asset('images/trash.png') }}'">

          </button>
        </form>

      </div>

      @endif

    </div>

    @empty

    {{-- 投稿が1件もない場合 --}}
    <p class="post-list-empty">
      まだ投稿はありません。
    </p>

    @endforelse

  </div>

  {{-- 削除確認モーダル --}}
  <div class="delete-modal" id="deleteModal">
    <div class="delete-modal-content">

      <p class="delete-modal-message">
        この投稿を削除します。よろしいでしょうか？
      </p>

      <div class="delete-modal-buttons">
        {{-- OKボタン --}}
        <form
          action=""
          method="POST"
          id="deleteForm">

          @csrf
          @method('DELETE')

          <button
            type="submit"
            class="delete-modal-ok">
            OK
          </button>
        </form>

        {{-- キャンセルボタン --}}
        <button
          type="button"
          class="delete-modal-cancel"
          id="deleteCancel">
          キャンセル
        </button>
      </div>

    </div>
  </div>

  {{-- 投稿編集モーダル --}}
  <div class="edit-modal" id="edit-modal">
    <div class="edit-modal-overlay"></div>

    <div class="edit-modal-content">
      <form
        method="POST"
        id="edit-form"
        class="edit-modal-form">
        @csrf
        @method('PUT')

        <textarea
          name="post"
          id="edit-post"
          class="edit-modal-textarea"
          maxlength="150"
          required></textarea>
        @error('post')
        <p class="edit-modal-error">
          {{ $message }}
        </p>
        @enderror

        <button
          type="submit"
          class="edit-modal-submit">
          <img
            src="{{ asset('images/edit.png') }}"
            alt="編集内容を保存する">
        </button>
      </form>
    </div>
  </div>

</x-login-layout>
