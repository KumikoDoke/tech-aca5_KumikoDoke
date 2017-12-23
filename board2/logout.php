<?php
session_start();
$_SESSION = array();
session_destroy();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>ログアウト</title>
</head>
<body>
<h1>ログアウト</h1>
<p>完了</p>
<p><a href="login.php">ログイン画面に戻る</a></p>
</body>
</html>