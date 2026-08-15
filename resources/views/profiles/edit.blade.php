<x-login-layout>

  <div class="profile-edit">

    {{-- アイコン --}}
    <div class="profile-edit-icon">
      <img
        src="{{ asset('storage/' . auth()->user()->icon_image) }}"
        alt="{{ auth()->user()->username }}のアイコン">
    </div>

    {{-- 編集フォーム --}}
    <form
      class="profile-edit-form"
      action="{{ route('profile.update') }}"
      method="POST"
      enctype="multipart/form-data">
      @csrf
      @method('PUT')

      {{-- ユーザー名 --}}
      <div class="profile-edit-field">
        <label
          for="username"
          class="profile-edit-label">
          ユーザー名
        </label>

        <div class="profile-edit-input-group">
          <input
            type="text"
            id="username"
            name="username"
            class="profile-edit-input"
            value="{{ auth()->user()->username }}">

          @error('username')
          <p class="validation-error">{{ $message }}</p>
          @enderror
        </div>
      </div>

      {{-- メールアドレス --}}
      <div class="profile-edit-field">
        <label
          for="email"
          class="profile-edit-label">
          メールアドレス
        </label>

        <div class="profile-edit-input-group">
          <input
            type="email"
            id="email"
            name="email"
            class="profile-edit-input"
            value="{{ auth()->user()->email }}">

          @error('email')
          <p class="validation-error">{{ $message }}</p>
          @enderror
        </div>
      </div>



      {{-- パスワード --}}
      <div class="profile-edit-field">
        <label
          for="new_password"
          class="profile-edit-label">
          パスワード
        </label>

        <div class="profile-edit-input-group">
          <input
            type="password"
            id="new_password"
            name="new_password"
            class="profile-edit-input"
            placeholder="パスワード">

          @error('new_password')
          <p class="validation-error">{{ $message }}</p>
          @enderror
        </div>
      </div>

      {{-- パスワード確認 --}}
      <div class="profile-edit-field">
        <label
          for="new_password_confirmation"
          class="profile-edit-label">
          パスワード確認
        </label>

        <div class="profile-edit-input-group">
          <input
            type="password"
            id="new_password_confirmation"
            name="new_password_confirmation"
            class="profile-edit-input"
            placeholder="パスワード">

          @error('new_password_confirmation')
          <p class="validation-error">{{ $message }}</p>
          @enderror
        </div>
      </div>

      {{-- 自己紹介 --}}
      <div class="profile-edit-field">
        <label
          for="bio"
          class="profile-edit-label">
          自己紹介
        </label>

        <div class="profile-edit-input-group">
          <textarea
            id="bio"
            name="bio"
            class="profile-edit-textarea">{{ auth()->user()->bio }}</textarea>

          @error('bio')
          <p class="validation-error">{{ $message }}</p>
          @enderror
        </div>
      </div>

      {{-- アイコン画像 --}}
      <div class="profile-edit-field">
        <label
          for="icon_image"
          class="profile-edit-label">
          アイコン画像
        </label>

        <div class="profile-edit-input-group">
          <input
            type="file"
            id="icon_image"
            name="icon_image"
            class="profile-edit-file"
            accept="image/*">

          @error('icon_image')
          <p class="validation-error">{{ $message }}</p>
          @enderror
        </div>
      </div>

      {{-- 更新ボタン --}}
      <div class="profile-edit-actions">
        <button
          type="submit"
          class="profile-edit-submit">
          更新
        </button>
      </div>

    </form>

  </div>

</x-login-layout>
