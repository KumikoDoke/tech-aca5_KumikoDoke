<?php
require_once './board2.php';
require_once './Encode2.php';
session_start();

?>

<html>
<head>
    <title>掲示板2</title>
</head>
<body>
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
    $stt = $db->prepare('SELECT * FROM post_table');

    $stt->execute();


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
</table>
</body>
</html>
<html>
<head>
    <title>データの登録</title>
</head>
<body>
<form method = "POST" action = "insert_process2.php">
    <p>
        ID：<br />
        <input type="text" name="id" size="25" maxlength="5" />
    </p><p>
        コメント：<br />
        <input type="text" name="contents" size="30" maxlength="150" />
    </p><p>
        ユーザーid：<br />
        <input type="text" name="user_id" size="10" maxlength="20" value="<?php e($_SESSION["id"]); ?>"/>
    </p><p>
        <input type="submit" value="登録" />
    </p>
    <p><a href ="logout.php">ログアウトする</a></p>
</form>
</body>
</html>

