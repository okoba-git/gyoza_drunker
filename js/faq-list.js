import { messageArea, appendMessage } from "./message-area.js";



// 初期処理
async function init() {
  // selectorにchangeイベントを追加
  const selector = document.getElementById('category-selector');
  selector.addEventListener('change', () => {
    changeCategory(selector.value);
  });

  // DBからデータを取得
  const json = await getFaqList();

  renderTable(json.faqList);
}

// データベースからfaqデータ取得
async function getFaqList(id = 0) {
  // 呼び出しファイル(contact-do.php)からのパスを指定
  const response = await fetch(`./faq-list-do.php?category_id=${id}`);
  // レスポンス失敗時
  if (!response.ok) {
    return {
      status: response.status,
      message: response.statusText,
      updateAt: null,
    };
  }
  const json = await response.json();
  return json;
}

// セレクター切り替え時処理
async function changeCategory(categoryId) {

  // Fetch API を呼び出す関数を実行
  const json = await getFaqList(categoryId);
  renderTable(json.faqList);

  // メッセージを表示
  messageArea.textContent = '';
  if (json.status !== 200) {
    appendMessage(`エラーコード:${json.status}<br>${json.message}`, 'danger');
  }
}

// faqテーブル表示処理
function renderTable(faqListData) {
  const tbody = document.getElementById('contact-tbody');
  tbody.innerHTML = '';

  const fragment = document.createDocumentFragment();
  faqListData.forEach(faq => {
    // tr要素を生成
    const trElm = document.createElement('tr');

    // 各セルを作成
    const tdId = document.createElement('td');
    tdId.className = 'col';
    tdId.textContent = faq.id;

    const tdCategory = document.createElement('td');
    tdCategory.className = 'col-2';
    tdCategory.textContent = faq.category_name;

    const tdQuestion = document.createElement('td');
    tdQuestion.className = 'col-3';
    tdQuestion.textContent = faq.question;

    const tdAnswer = document.createElement('td');
    tdAnswer.className = 'col-4';
    tdAnswer.textContent = faq.answer;

    const tdCreateAt = document.createElement('td');
    tdCreateAt.className = 'col';
    tdCreateAt.textContent = faq.create_at;

    const tdUpdateAt = document.createElement('td');
    tdUpdateAt.className = 'col';
    tdUpdateAt.textContent = faq.update_at;

    const tdAction = document.createElement('td');
    tdAction.className = 'col-1 text-center align-middle';
    tdAction.innerHTML = `<a href="./faq-detail.php?id=${faq.id}" class="btn btn-sm btn-primary">詳細</a>`;

    // 行に結合
    trElm.appendChild(tdId);
    trElm.appendChild(tdCategory);
    trElm.appendChild(tdQuestion);
    trElm.appendChild(tdAnswer);
    trElm.appendChild(tdCreateAt);
    trElm.appendChild(tdUpdateAt);
    trElm.appendChild(tdAction);

    //trをテーブルに追加
    fragment.appendChild(trElm);
  });
  tbody.appendChild(fragment);
}

init();