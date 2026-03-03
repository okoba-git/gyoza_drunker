import { messageArea, appendMessage } from "./message-area.js";

// オブジェクトの取得
const tbody = document.getElementById('contact_tbody');

// ステータス選択イベントを追加
tbody.addEventListener('change', async (event) => {
    // 変更された要素がセレクトボックス（name="state"）かどうかを確認
    if (event.target && event.target.name === 'state') {
        const select = event.target;
        
        // 1. 選択された新しいステータスの値を取得
        const newState = select.value;

        // 2. PHP側で設定した data-contact-id を親の <tr> から取得
        const tr = select.closest('tr');
        const contactId = tr.getAttribute('data-contact-id');

        // Fetch API を呼び出す関数を実行
        const json = await updateState(contactId, newState);

        // メッセージを表示
        messageArea.textContent = '';
        if(json.status === 200){
          appendMessage(json.message, 'success');
          // update_atを更新
          const updateAt = tr.querySelector('.update-at-column');
          if (updateAt && json.updateAt) {
              updateAt.textContent = json.updateAt;
          }
        }else{
          appendMessage(`エラーコード:${json.status}<br>${json.message}`, 'danger');
        }
    }
});

/**
 * ステータスの変更を行う
 * @param {int} id お問い合わせID
 * @param {int} state ステータスID
 * @returns \{status(レスポンスコード), message(レスポンスメッセージ), updateAt(更新時間、エラーの場合はnull)}Jsonを返す
 */
async function updateState(id, state){
  // 呼び出しファイル(contact-do.php)からのパスを指定
  const response = await fetch(`./contact-do.php?id=${id}&state=${state}`);
  // レスポンス失敗時
  if(!response.ok){ 
    return {
      status : response.status,
      message : response.statusText,
      updateAt : null,
    };
  }
  const json = await response.json();
  return json; 
}