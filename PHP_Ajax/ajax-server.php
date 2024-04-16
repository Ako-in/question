<?php
//Ajaxリクエストを取得
// var_dump('111');
$ajax_request = file_get_contents('php://input');
// var_dump($ajax_request);
//AjaxリクエストをPHPで扱える連想配列に変換
$data = json_decode($ajax_request,true);

//受け取ったデータに応じて処理を行う
// var_dump($data);
if($data['name']==='SAMURAI'){
  $data['name']='TERAKOYA';
};

//Ajaxレスポンスを生成(連想配列としてセット)
var_dump('111');
$response = [
  'message'=>$data['name']
];
var_dump('222');
//JSON形式を指定してブラウザ側へ返信

header('Content-Type:application/json');
var_dump(json_encode($response));
var_dump('333333');
echo json_encode($response);

?>