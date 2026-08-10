<x-logout-layout>
  <div id="clear">
    <div class="username">
      <p>{{ session('username') }}さん</p>
      <p>ようこそ！AtlasSNSへ！</p>
    </div>
    <div class="added-text">
      <p>ユーザー登録が完了いたしました。</p>
      <p>早速ログインをしてみましょう！</p>
    </div>
    <div>
      <p class="login-btn"><a href="login">ログイン画面へ</a></p>
    </div>
  </div>
</x-logout-layout>
