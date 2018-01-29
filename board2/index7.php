<?php
/**
 * Created by PhpStorm.
 * User: doke
 * Date: 2018/01/29
 * Time: 19:46
 */
require_once './board2.php';
require_once './Encode2.php';
require_once 'C:/xampp/php/includes/smarty-2.6.31/smarty/Smarty.class.php';

//ログアウト
$smarty = new Smarty();
$smarty->template_dir="C:/xampp/htdocs/tech-aca5_KumikoDoke/board2/templates/";
$smarty->compile_dir="C:/xampp/htdocs/tech-aca5_KumikoDoke/board2/templates_c/";

$smarty->register_function("logout_gamen","logouts");

function logouts(){
    session_start();
    $_SESSION = array();
    session_destroy();
    echo"<p>完了</p>
<p><a href='index.php'>ログイン画面に戻る</a></p>";
};
$smarty->display("index7.tpl");
