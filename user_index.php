<?php
session_start();
include("functions.php"); //functionsの呼び出し
chkSsid();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ユーザー登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header">
    <?php if($_SESSION["kanri_flg"]=="1"){ ?>  <!--管理者のみ表示させる-->
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



<form method="post" action="user_insert.php">
<div><?=$_SESSION["name"]?>さん、こんにちは</div>
  <div class="jumbotron">
   <fieldset>
    <legend>新規ユーザー登録</legend>
    <label>名前：<input type="text" name="name"></label><br>
    <label>ID：<input type="text" name="lid"></label><br>
    <label>パスワード：<input type="text" name="lpw"></label><br>
    <label>権限：
      <input type="radio" name="kanri_flg" value="0" checked="checked">一般
      <input type="radio" name="kanri_flg" value="1">管理者
    </label><br>
    <label>使用有無：
      <input type="radio" name="life_flg" value="0" checked="checked">使用中
      <input type="radio" name="life_flg" value="1">使用していない
    </label><br><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
