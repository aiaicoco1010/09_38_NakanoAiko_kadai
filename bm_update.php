<?php
include("functions.php"); //functionsの呼び出し

//入力チェック(受信確認処理追加)
if(
  !isset($_POST["id"]) || $_POST["id"]=="" ||
  !isset($_POST["name"]) || $_POST["name"]=="" ||
  !isset($_POST["url"]) || $_POST["url"]=="" ||
  !isset($_POST["text"]) || $_POST["text"]==""
){
  exit('ParamError');
}

//1. POSTデータ取得
$id     =$_POST["id"];
$name   = $_POST["name"];
$url   = $_POST["url"];
$text  = $_POST["text"];

//2. DB接続します(エラー処理追加)
$pdo = db_con();


//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE gs_bm_table SET name = :name, url = :url, text=:text WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':url', $url, PDO::PARAM_STR);
$stmt->bindValue(':text', $text, PDO::PARAM_STR);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  error_db_info($stmt);  //functionsの呼び出し
}else{
  //５．indexへリダイレクト
  header("Location: bm_list_view.php");
  exit;
}
?>
