import { messageArea, appendMessage } from "./message-area.js";

// 各フォームオブジェクトを取得
const form = document.getElementById('contact_form');
const userName = document.getElementById('user_name');
const userEmail = document.getElementById('user_email');
const userTel = document.getElementById('user_tel');
const userMes = document.getElementById('uese_mes');
const submitBtn = document.getElementById('submit_btn')

// フォームボタンのクリックイベント登録
submitBtn.addEventListener('click', event => {
  event.preventDefault();
  // メッセージ内容をリセット
  messageArea.textContent = '';

  const errMes = validateForm(userName.value, userEmail.value, userTel.value, userMes.value);
  if(errMes.length === 0){ // 問題なければ確認画面を表示
    form.submit();
  }else{ // 問題があればメッセージを表示
    errMes.forEach(message => {
      appendMessage(message, 'danger');
    });
    // 画面上部に戻す
    window.scrollTo({top:0});
  }
});

/**
 * 入力内容をチェックし、エラーメッセージを返す
 * @returns {string} エラーメッセージ配列
 */
function validateForm(name, email, tel, mes) {
  let errors = [];

  // 1. 必須チェック
  if (isEmpty(name)) errors.push('名前を入力してください。');
  if (isEmpty(email)) errors.push('メールアドレスを入力してください。');
  if (isEmpty(mes)) errors.push('お問い合わせ内容を入力してください。');

  // 2. 形式チェック
  if (!isEmpty(email) && !validateEmail(email)) {
    errors.push('メールアドレスの形式が正しくありません。');
  }
  if (!isEmpty(tel) && !validateTel(tel)) {
    errors.push('電話番号は半角数字とハイフンのみで入力してください。');
  }

  // 配列を改行コードでつなげて一つの文字列にする（空なら "" になる）
  return errors;
}

/**
 * 文字列が空かどうか
 * @param {string} str 
 * @returns null,undefined,空文字または空白文字だけの場合はtrue,それ以外はfaleseを返す
 */
function isEmpty(str) {
  return !str || str.trim().length === 0;
}

/**
 * メールアドレスのバリデーション
 * @param {string} email 
 * @returns メールアドレスとして適正であればtrue,そうでなければfalseを返す
 */
function validateEmail(email) {
  // ^[a-zA-Z0-9._+-]+  : @の前。半角英数と . _ - + が1文字以上
  // @                  : @マーク必須
  // [a-zA-Z0-9.-]+     : @の後（ドメイン名）。半角英数と . - が1文字以上
  // \.[a-zA-Z]{2,}$    : 最後は必ず . と 2文字以上の英字で終わる (例: .com, .jp)
  const regex = /^[a-zA-Z0-9._+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  return regex.test(email);
}

/**
 * 電話番号のバリデーション
 * @param {string} tel 
 * @returns 電話番号として適正であればtrue,そうでなければfalseを返す
 */
function validateTel(tel) {
  // ^0 : 日本の電話番号なので0から始まる
  // [0-9-]+ : 間に数字かハイフンが入る
  // [0-9]$ : 最後は必ず数字で終わる
  const regex = /^0[0-9-]+[0-9]$/;
  return regex.test(tel);
}