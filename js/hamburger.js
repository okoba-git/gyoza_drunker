// ハンバーガーメニューの開閉処理
//必要な要素の取得(ハンバーガーボタン、body)
const hamBtn = document.getElementById('js-ham-button');
const bodyElm = document.querySelector('body');

//ハンバーガーボタンにクリックイベントを登録
hamBtn.addEventListener('click', () => {
  bodyElm.classList.toggle('open');
});
