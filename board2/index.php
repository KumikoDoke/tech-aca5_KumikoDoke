<?php
require_once './board2.php';
require_once './Encode2.php';
require_once 'C:/xampp/php/includes/smarty-2.6.31/smarty/Smarty.class.php';
session_start();
//ログイン分岐
$smarty = new Smarty();
$smarty->template_dir="C:/xampp/htdocs/tech-aca5_KumikoDoke/board2/templates/";
$smarty->compile_dir="C:/xampp/htdocs/tech-aca5_KumikoDoke/board2/templates_c/";


$smarty->assign("name","world");
$smarty->register_function("loginbunki","login");

function login(){
    $db = getDb();
    global $status;
    //↑nande $status dake local kannsu nandesu?
    $status = "none";
    if (isset($_SESSION["id"])) {
        $status = "logged_in";
        $_SESSION = array();
        session_destroy();
    }elseif(!empty($_POST["id"])&&!empty($_POST["name"])&&!empty($_POST["password"])){
        $stt = $db->prepare("SELECT * FROM member_table ");
        $stt->bindValue(':id',$_POST["id"]);
        $stt->bindValue(':name', $_POST["name"]);
        $stt->bindValue(':password',$_POST["password"]);
        $stt->execute();
        while($row = $stt->fetch(PDO::FETCH_ASSOC)){
            if ($row['id'] == $_POST['id'] && $row['name'] == $_POST['name']
                && $row['password'] == $_POST['password']){
                $status = "ok";
                $_SESSION["id"] = $_POST["id"];
                break;
            }else{
                $status = "failed";
            }
        }
    }
//command + R で置換
    $sudeni = "<p>ログイン済み</p>
    <p><a href='index.php'>ログアウト</a></p>";

    $loginok = "<p>ログイン成功</p>
    <p><a href='index2.php'>けいじばん２</a></p>
    <p><a href ='index7.php'>ログアウトする</a></p>";

    $loginfailed = "<p>ログイン失敗</p>
    <p><a href='index.php'>ログイン画面に戻る</a></p>";

    $logingamen = "<form method='POST' action='index.php'>
        ID：<input type='number' name='id' />
        <!--掲示板ではidはname='user_id'のもの-->
        ユーザ名：<input type='text' name='name' />
        パスワード：<input type='password' name='password' />
        <input type='submit' value='ログイン' />
        <p><a href='index4.php'>登録画面に移動</a></p>
    </form>";

    if($status == "logged_in"){
        return $sudeni;
    }elseif($status == "ok"){
        return $loginok;
    }elseif($status == "failed"){
        return $loginfailed;
    }else{
        return $logingamen;
    }
}


$smarty->display("index.tpl");