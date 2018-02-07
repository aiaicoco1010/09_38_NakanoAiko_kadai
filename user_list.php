<?php
session_start();
include("functions.php"); //functionsの呼び出し
chkSsid();

//1.  DB接続します
$pdo = db_con(); 

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  error_db_info($stmt);  //functionsの呼び出し
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .='<p>';
    $view .= '<a href="user_update_page.php?id='.$result["id"].'">';
    $view .= $result["name"]."/".$result["lid"]."/".$result["lpw"]."/".$result["kanri_flg"]."/".$result["life_flg"];
    $view .='</a>';
    $view .=' ';
    $view .= '<a href="user_delete.php?id='.$result["id"].'">';
    $view .= '[削除]';
    $view .='</a>';
    $view .='</p>';
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ユーザー一覧</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <?php if($_SESSION["kanri_flg"]=="1"){ ?>  <!--管理者のみ表示させる-->
      <a class="navbar-brand" href="user_index.php">ユーザー登録</a>
      <?php } ?>
      <a class="navbar-brand" href="bm_index.php">ブックマーク登録</a>
    <a class="navbar-brand" href="bm_list_view.php">ブックマーク一覧</a>
    <a class="navbar-brand" href="logout.php">ログアウト</a>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
  <div><?=$_SESSION["name"]?>さん、こんにちは</div>
  <div class="container jumbotron"><?=$view?></div>
</div>
<!-- Main[End] -->

</body>
</html>