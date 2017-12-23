<?php

require_once './board2.php';

$db = getDb();
$status = "none";

if(!empty($_POST["id"]) && !empty($_POST["name"]) && !empty($_POST["password"])){

    //passwordのハッシュ化
//    $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);


    $stt = $db->prepare('INSERT INTO member_table(id,name,password) VALUES(:id, :name, :password)');

    $stt->bindValue(':id', $_POST["id"]);
    $stt->bindValue(':name', $_POST["name"]);
    $stt->bindValue(':password', $_POST["password"]);

    if($stt->execute())
        $status = "ok";
    else
        $status = "failed";
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>新規登録</title>
</head>
<body>
    <h1>新規登録</h1>
    <?php if($status == "ok"): ?>
    <p>登録完了</p>
    <p><a href="login.php">ログイン画面に移動</a></p>
    <p></p>
    <?php elseif($status == "failed"): ?>
    <p>エラー：すでに存在するユーザー名です。</p>
    <p><a href="login.php">ログイン画面</a></p>
    <?php else: ?>
    <form method="POST" action="register.php">
        ID:<input type="number" name="id">
        ユーザー名：<input type="text" name="name" />
        パスワード：<input type="password" name="password" />
        <!-- inputタグのname属性はinput要素の名前を指定する -->
        <input type="submit" value="登録" />
    </form>
    <?php endif; ?>
</body>
</html>
