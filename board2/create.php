<?php

require_once './board2.php';
require_once './Encode2.php';
session_start();
$errMsg = "";

?>

<html>
<head>
    <title>編集</title>
</head>
<body>
<form method="POST" action="create3.php">
    id<input type="text" name="no" size="4">
    <input type="submit" name="hensyu" value="編集">
    <input type='submit' name='delete' value='削除'>
  </form>
<table boarder="1">
    <tr>
        <th>id</th><th>contents</th><th>user_id</th>
    </tr>

<?php


try{
    $db = getDb();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->beginTransaction();
    //$sttはstatementって意味
    $stt = $db->prepare("SELECT * FROM post_table WHERE user_id= {$_SESSION['id']}");
    $stt->execute();

//for文は繰り返す条件が"繰り返す回数"に特化されることが多いため、指定回数の繰り返しを記述する際に便利である。
    while($row = $stt->fetch(PDO::FETCH_ASSOC)){
        ?>
        <tr>
            <td><?php e($row['id']); ?></td>
            <td><?php e($row['contents']); ?></td>
            <td><?php e($row['user_id']); ?></td>
        </tr>
        <?php
    }
    $db = NULL;
}catch(PDOException $e) {
    $db->rollBack();
    die("エラーメッセージ：{$e->getMessage()}");
}
?>
    <p><a href="result2.php">一覧に戻る</a></p>
