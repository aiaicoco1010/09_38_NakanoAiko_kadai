<?php
session_start();
include("functions.php"); //functionsの呼び出し
chkSsid();

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
  <title>ブックマーク更新</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header">
    <a class="navbar-brand" href="bm_list_view.php">ブックマーク一覧</a>
    <?php if($_SESSION["kanri_flg"]=="1"){ ?>  <!--管理者のみ表示させる-->
        <a class="navbar-brand" href="user_index.php">ユーザー登録</a>
        <a class="navbar-brand" href="user_list.php">ユーザー一覧</a>
        <?php } ?>
    <a class="navbar-brand" href="logout.php">ログアウト</a>
    </div>    
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div><?=$_SESSION["name"]?>さん、こんにちは</div>
<form method="post" action="bm_update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ブックマーク登録</legend>
     <label>書籍名：<input type="text" name="name" value="<?=$row["name"]?>"></label><br>
     <label>URL  ：<input type="text" name="url" value="<?=$row["url"]?>"></label><br>
     <label>コメント：<br><textArea name="text" rows="4" cols="40"><?=$row["text"]?></textArea></label><br>
     <input type="submit" value="送信">
     <input type="hidden" name="id" value="<?=$id?>"
    </fieldset>
  </div>
</form>
<!-- Main[End] -->
</body>
</html>
