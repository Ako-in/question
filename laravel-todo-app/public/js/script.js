// 「タグの編集用モーダルを開くとき」に以下のイベント処理を行う
// 1.モーダルを開くときにクリックされた編集ボタンを取得する
// その編集ボタンに設定されているdata-tag-id属性とdata-tag-name属性の値を取得する
// 編集用モーダル内にあるformタグのaction属性に、送信先のURL（tags/取得したdata-tag-id属性の値）を代入する
// 編集用モーダル内にあるinputタグのvalue属性に、取得したdata-tag-name属性の値を代入する

// 「タグの削除用モーダルを開くとき」に以下のイベント処理を行う
// モーダルを開くときにクリックされた削除ボタンを取得する
// その削除ボタンに設定されているdata-tag-id属性とdata-tag-name属性の値を取得する
// 削除用モーダル内にあるformタグのaction属性に送信先のURL（tags/取得したdata-tag-id属性の値）を代入する
// 削除用モーダル内にあるh5要素のテキストに、「『取得したdata-tag-name属性の値』を削除してもよろしいですか？」というメッセージを代入する

//1.タグの編集用フォーム
const editTagForm = document.forms.editTagForm;

//2.タグの編集用モーダルを開く時の処理
document.getElementById('editTagModal').addEventListener('show.bs.modal',(event)=>{
  let tagButton = event.relatedTarget;
  let tagId = tagButton.dataset.tagId;
  let tagName = tagButton.dataset.tagName;
  
  editTagForm.action=`tags/${tagId}`;
  editTagForm.name.value=tagName;

});

//タグの削除用フォーム
const deleteTagFrom = document.forms.deleteTagForm;

const deleteMessage = document.getElementById('deleteTagModal')

document.getElementById('deleteTagModal').addEventListener('show.bs.modal',(event)=>{
  let deleteButton = event.relatedTarget;
  let tagId = deleteButton.dataset.tagId;
  let tagName = deleteButton.dataset.tagName;

  deleteTagForm.action = `tags/${tagId}`;
  deleteMessage.textContent=`「${tagName}」を削除してもよろしいですか？`
});
