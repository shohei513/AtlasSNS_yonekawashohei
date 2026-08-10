$(function () {
  // 削除アイコンを押したとき
  $('.post-list-trash-button').on('click', function () {
    // 押された投稿の削除URLを取得
    const deleteUrl = $(this).data('delete-url');

    // モーダル内のフォームに削除URLを設定
    $('#deleteForm').attr('action', deleteUrl);

    // 削除確認モーダルを表示
    $('#deleteModal').fadeIn(200);
  });

  // キャンセルボタンを押したとき
  $('#deleteCancel').on('click', function () {
    $('#deleteModal').fadeOut(200);
  });

  // モーダルの背景部分を押したとき
  $('#deleteModal').on('click', function (event) {
    if ($(event.target).is('#deleteModal')) {
      $('#deleteModal').fadeOut(200);
    }
  });
});


$(function () {
  // 投稿一覧の編集ボタンを押したとき
  $('.post-list-edit-button').on('click', function () {
    const postId = $(this).data('post-id');
    const postContent = $(this).data('post-content');

    // 現在の投稿内容を入力欄へ表示
    $('#edit-post').val(postContent);

    // 編集する投稿に合わせて送信先を変更
    $('#edit-form').attr('action', `/post/${postId}`);

    // モーダルを表示
    $('#edit-modal').addClass('is-open');
  });

  // モーダルの背景を押したら閉じる
  $('.edit-modal-overlay').on('click', function () {
    $('#edit-modal').removeClass('is-open');
  });
});
