<?php

require_once './board1.php';

try{

    $db = getDb();

    //$text = $db->query('SELECT * FROM post_table')->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($text);
    $stt = $db -> prepare('INSERT INTO post_table(id, name, contents) VALUES(:id, :name, :contents )');
    //$sttはPDOstatementオブジェクトで、データベースに一連の命令を発行する
    //PDOStatementオブジェクトはPDOオブジェクトの$dbからprepareメソッドを呼び出すことで取得できる



    $stt->bindValue(':id', $_POST['id']);
    $stt->bindValue(':name', $_POST['name']);
    $stt->bindValue(':contents', $_POST['contents']);

    $stt->execute();
    //var_dump($stt->execute());
    //exit;

    $db = NULL;
}catch(PDOException $e){

    die("エラーメッセージ：{$e->getMessage()}");
}

header('Location:http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/result.php');

?>
