<?php
require_once './board2.php';
session_start();

try{
    $db = getDb();

    $stt = $db -> prepare('INSERT INTO post_table(id, contents, user_id) VALUES(:id, :contents, :user_id )');
    //$sttはPDOstatementオブジェクトで、データベースに一連の命令を発行する
    //PDOStatementオブジェクトはPDOオブジェクトの$dbからprepareメソッドを呼び出すことで取得できる



    $stt->bindValue(':id', $_POST['id']);
    $stt->bindValue(':contents', $_POST['contents']);
    $stt->bindValue(':user_id', $_POST['user_id']);
    //$_POST['user_id'] = $_SESSION["name"];
    $stt->execute();
    //var_dump($stt->execute());
    //exit;

    $db = NULL;
}catch(PDOException $e){

    die("エラーメッセージ：{$e->getMessage()}");
}

header('Location:http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/result2.php');

?>

}