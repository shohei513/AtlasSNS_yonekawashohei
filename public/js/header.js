// ページのHTMLが読み込まれてから処理する
document.addEventListener('DOMContentLoaded', function () {

  const userMenuButton = document.querySelector('.user-menu-button');
  const userMenuList = document.querySelector('.user-menu-list');

  if (userMenuButton && userMenuList) {
    // ボタンをクリックしたときopenをつける、外す
    userMenuButton.addEventListener('click', function () {
      userMenuList.classList.toggle('open');
      userMenuButton.classList.toggle('open');
    });
  }
});
