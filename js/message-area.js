// メッセージエリア
const messageArea = document.getElementById('message-area');

/**
 * メッセージ表示処理
 * @param {string} message 表示したいメッセージ内容
 * @param {string} type アラートの種類。bootstarapのカラー参照
 */
const appendMessage = (message, type) => {
  const wrapper = document.createElement('div')
  wrapper.innerHTML = [
    `<div class="alert alert-${type} alert-dismissible" role="alert">`,
    `   <div>${message}</div>`,
    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
    '</div>'
  ].join('')

  messageArea.append(wrapper);
}

export {messageArea, appendMessage};