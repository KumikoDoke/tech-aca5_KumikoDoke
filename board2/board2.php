<?php

function getDb(){
    $dsn = 'mysql:dbname=board2_db; host=127.0.0.1';
//Data Source Name
    $user = 'root';
    $password = '';

    try{
        $db = new PDO($dsn,$user,$password);
        $db->exec('SET NAMES utf8');

    }catch (PDOException $e){
        die("接続エラー :{$e -> getMessage()}");
    }

    return $db;
}