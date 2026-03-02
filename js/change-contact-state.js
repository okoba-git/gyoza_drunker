// オブジェクトの取得
const selector = document.getElementById('contact_state');
const updateAt = document.getElementById('update_at');

// ステータス選択イベントを追加
selector.addEventListener('select', async () => {
  const updateTime = await chageState(parseInt(selector.value));
  updateAt.textContent = updateTime !== 0 ? updateTime : updateAt.textContent;
});

/**
 * ステータスの変更を行う
 * @param {int} state ステータスID
 * @returns 更新日時。エラーの時は0を返す
 */
async function chageState(state){
  const response = await fetch(`../admin/contact/contact-do.php?state=${state}`);
  if(!response.ok){
    return 0;
  }
  const json = await response.json();
  return json.updateAt ? json.updateAt : 0; 
}