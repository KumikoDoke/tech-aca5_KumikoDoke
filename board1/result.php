<?php
require_once './board1.php';
require_once './Encode.php';

?>

<html>
<head>
    <title>掲示板１</title>
</head>
<body>
<table boarder="1">
    <tr>
        <th>id</th><th>name</th><th>contents</th>
    </tr>

<?php
try{

    $db = getDb();

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->beginTransaction();

    //$sttはstatementって意味
    $stt = $db->prepare('SELECT * FROM post_table');
    //var_dump($stt);
    //exit;
    $stt->execute();
    //var_dump($test);
    //exit;


    while($row = $stt->fetch(PDO::FETCH_ASSOC)){
?>
    <tr>
        <td><?php e($row['id']); ?></td>
        <td><?php e($row['name']); ?></td>
        <td><?php e($row['contents']); ?></td>
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
<form method = "POST" action = "insert_process.php">
    <p>
        ID：<br />
        <input type="text" name="id" size="25" maxlength="5" />
    </p><p>
        名前：<br />
        <input type="text" name="name" size="35" maxlength="20" />
    </p><p>
        コメント：<br />
        <input type="text" name="contents" size="6" maxlength="150" />
    </p><p>
        <input type="submit" value="登録" />
    </p>
</form>
</body>
</html>