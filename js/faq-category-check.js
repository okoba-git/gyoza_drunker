import { messageArea, appendMessage, jsonErrorMessage } from "./message-area.js";

const form = document.getElementById('category-form');
const sortOrder = document.getElementById('sort_order');
const submit = document.getElementById('btn-submit');
const idElm = document.getElementById('faq-id');

submit.addEventListener('click', async event => {
  event.preventDefault();

  const num = parseInt(sortOrder.value);

  // 入力された値が数値じゃない時
  if (!Number.isInteger(num)) {
    appendMessage('ソート番号は整数を入力してください。', 'danger');
    return;
  }

  messageArea.textContent = '';

  // 存在チェック
  const checkJson = await checkAvailable(sortOrder.value);
  // 失敗していればエラー表示
  if (checkJson.status !== 200) {
    jsonErrorMessage(checkJson);
    return;
  }
  
  if (!checkJson.isAvailable || isSelfId(idElm, checkJson.id)) {
    // ソート番号がまだないまたは自分自身なのでそのまま登録
    form.submit();
  } else {
    // ソート番号がすでにあるので登録するか確認
    if (window.confirm('入力したソート番号は既に使用されています。順番を入れ替えて登録しますか?')) {
      // 変更phpを呼び出す
      const updateJson = await updateSortOrder(checkJson.id);
      // 問題があればメッセージを表示する
      if (updateJson.status !== 200) {
        jsonErrorMessage(updateJson);
        return;
      }
      // 変更後にPOST送信
      form.submit();
    } else {
      appendMessage('ソート番号を変更してください。', 'danger');
      window.scrollTo({ top: 0 });
    }
  }
});

/**
 * ソート番号が存在しているかチェックする
 * @param {int} sortOrder 登録したいソート番号
 * @returns json.isAvailable:存在していればtrueを返す, json.id:存在していればfaqカテゴリIDを返す
 */
async function checkAvailable(sortOrder) {
  // 呼び出しファイルからのパスを指定
  const response = await fetch(`./category-check-do.php?sort_order=${sortOrder}`);
  // レスポンス失敗時
  if (!response.ok) {

    return {
      status: response.status,
      message: response.statusText
    };
  }
  const json = await response.json();
  return json;
}

/**
 * 
 * @param {int} id 
 * @param {int} sortOrder 
 * @returns 
 */
async function updateSortOrder(id) {
  // 呼び出しファイルからのパスを指定
  const response = await fetch(`./category-update-do.php?id=${id}`);
  // レスポンス失敗時
  if (!response.ok) {
    return {
      status: response.status,
      message: response.statusText,
    };
  }
  const json = await response.json();
  return json;
}

/**
 * ソート番号が一致するレコードが自分自身かどうか
 * @param {HTMLElement} elm 自身のIDを持つ要素
 * @param {int} id ソート番号が一致するFAQカテゴリID
 * @returns ソート番号が一致するIDが自分自身の場合true。一致するのが自分以外または追加の時はfalse
 */
function isSelfId(elm, id) {
  return elm ? parseInt(elm.value) === id : false;
}