<?php
session_start();
include("functions.php"); //functionsの呼び出し
chkSsid();
//index.php（登録フォームの画面ソースコードを全コピーして、このファイルをまるっと上書き保存）
$id = $_GET["id"];
//1.  DB接続します
  $pdo = db_con(); 
  
  //２．データ登録SQL作成
  $stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=:id");
  $stmt ->bindValue(":id" , $id , PDO::PARAM_INT);
  $status = $stmt->execute();
  
  //３．データ表示
  $view="";
  if($status==false){
    error_db_info($stmt);  //functionsの呼び出し
  }else{
    //Selectデータの数だけ自動でループしてくれる
    $row = $stmt->fetch();

    // while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    //   $view .='<p>';
    //   $view .= '<a href="detail.php?id='.$result["id"].'">';
    //   $view .= $result["name"]."[".$result["indate"]."]";
    //   $view .='</a>';
    //   $view .='</p>';
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ修正</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header">
    <?php if($_SESSION["kanri_flg"]=="1"){ ?> 
    <a class="navbar-brand" href="user_list.php">ユーザー一覧</a>
    <?php } ?>
    <a class="navbar-brand" href="bm_index.php">ブックマーク登録</a>
    <a class="navbar-brand" href="bm_list_view.php">ブックマーク一覧</a>
    <a class="navbar-brand" href="logout.php">ログアウト</a>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="user_update.php">
<div><?=$_SESSION["name"]?>さん、こんにちは</div>
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザー修正</legend>
     <label>名前：<input type="text" name="name" value="<?=$row["name"]?>"></label><br>
     <label>ID：<input type="text" name="lid" value="<?=$row["lid"]?>"></label><br>
     <label>パスワード：<input type="text" name="lpw" value="<?=$row["lpw"]?>"></label><br>
     <!--<label>権限：<input type="text" name="kanri_flg" value="<?=$row["kanri_flg"]?>"></label><br>
     <label>使用有無：<input type="text" name="life_flg" value="<?=$row["life_flg"]?>"></label><br>-->
     <input type="submit" value="送信">
     <input type="hidden" name="id" value="<?=$id?>"
    </fieldset>
  </div>
</form>
<!-- Main[End] -->
</body>
</html>