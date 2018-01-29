<?php
/**
 * Created by PhpStorm.
 * User: doke
 * Date: 2018/01/24
 * Time: 16:23
 */
require_once './board2.php';
session_start();

    try {
        $db = getDb();
        $stmt = $db->prepare("UPDATE post_table 
                SET contents= {$_POST['contents']}
                WHERE id=  AND user_id= {$_SESSION['id']}");
        $stmt->execute();

        $db = NULL;
    }catch(PDOException $e){
        die("エラーメッセージ：{$e->getMessage()}");
    }
    header('Location:http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/create.php');


