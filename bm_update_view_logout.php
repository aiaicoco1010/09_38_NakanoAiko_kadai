<?php
include("functions.php"); //functionsの呼び出し

$id = $_GET["id"];
//1.  DB接続します
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id");
$stmt ->bindValue(":id" , $id , PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  error_db_info($stmt);  //functionsの呼び出し
}else{
  //Selectデータの数だけ自動でループしてくれる
  $row = $stmt->fetch();
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ブックマーク登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="bm_list_view_logout.php">ブックマーク一覧</a>
      <a class="navbar-brand" href="login.php">ログイン</a>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="bm_update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ブックマーク</legend>
     <label>書籍名：<?=$row["name"]?></label><br>
     <label>URL  ：<?=$row["url"]?></label><br>
     <label>コメント：<?=$row["text"]?></textArea></label><br>
    </fieldset>
  </div>
</form>
<!-- Main[End] -->
</body>
</html>
