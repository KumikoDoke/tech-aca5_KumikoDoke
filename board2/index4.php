<?php
//新規登録画面
/**
 * Created by PhpStorm.
 * User: doke
 * Date: 2018/01/26
 * Time: 12:23
 */
require_once './board2.php';
require_once './Encode2.php';
require_once 'C:/xampp/php/includes/smarty-2.6.31/smarty/Smarty.class.php';
session_start();

$smarty = new Smarty();
$smarty->template_dir="C:/xampp/htdocs/tech-aca5_KumikoDoke/board2/templates/";
$smarty->compile_dir="C:/xampp/htdocs/tech-aca5_KumikoDoke/board2/templates_c/";


$smarty->register_function("loginbunki","login");

$db = getDb();
$status = "none";
$smarty->register_function("whether_register","registerbunki");

function registerbunki (){
    global $db;
    if (!empty($_POST["id"]) && !empty($_POST["name"]) && !empty($_POST["password"])) {

        //passwordのハッシュ化
//    $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);


        $stt = $db->prepare('INSERT INTO member_table(id,name,password) VALUES(:id, :name, :password)');

        $stt->bindValue(':id', $_POST["id"]);
        $stt->bindValue(':name', $_POST["name"]);
        $stt->bindValue(':password', $_POST["password"]);

        if ($stt->execute())
            register_ok();
        else
            already_registerd();
    }


}

function register_ok (){
    echo "<p>登録完了</p>
    <p><a href='index.php'>ログイン画面に移動</a></p>";
}
function already_registerd (){
    echo"<p>エラー：すでに存在するユーザー名です。</p>
    <p><a href='index.php'>ログイン画面</a></p>";
}
function error_registerd (){
    echo"<p>エラー：入力が間違っています</p>
    <p><a href='index4.php'>ログイン画面</a></p>";
}

$smarty->display("index4.tpl");