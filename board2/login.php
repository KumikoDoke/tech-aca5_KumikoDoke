<?php

require_once'./board2.php';
$db = getDb();

session_start();

$status = "none";

if (isset($_SESSION["id"]))
    $status = "logged_in";

else if (!empty($_POST["id"])&&
    !empty($_POST["name"])&& !empty($_POST["password"])) {

    $stt = $db->prepare("SELECT * FROM member_table ");
    $stt->bindValue(':id',$_POST["id"]);
    //var_dump($stt);
    //exit;
    $stt->bindValue(':name', $_POST["name"]);
    $stt->bindValue(':password',$_POST["password"]);
    $stt->execute();
    //$stt->store_result();
    //prepareとexecuteの意味がよくわからん
    //executeメソッドは取得した結果セットを自分自身(PDOstatementオブジェクト)にセットする



    while($row = $stt->fetch(PDO::FETCH_ASSOC)){
        if ($row['id'] == $_POST['id'] && $row['name'] == $_POST['name']
         && $row['password'] == $_POST['password']){
                $status = "ok";
                $_SESSION["id"] = $_POST["id"];
                break;
        }else{
            $status = "failed";
            //var_dump($row);
        //    break;
        }
    }
    //$row = $stt->fetchAll(PDO::FETCH_NUM);
    //var_dump($row[2][1]);//3つめのレコードのnameカラム
    //exit;



    //$record_num = 0;
    //while ($record_num <= count($row)) {

    //    if ($row[$record_num][0] == $_POST["id"]) {
      //      $status = "ok";
        //    $_SESSION["id"] = $_POST["id"];

          //  break;
        //} else {
          //  $record_num += 1;
            //break;
        //}



}
//}else{$status = "failed";}
//var_dump($status);
//exit;
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>ログイン</title>
</head>
<body>
<h1>ログイン</h1>
<?php if($status == "logged_in"): ?>
    <p>ログイン済み</p>
    <p><a href="logout.php">ログアウト</a></p>
    <?php $_SESSION = array();
    session_destroy(); ?>
<?php elseif($status == "ok"): ?>
    <p>ログイン成功</p>
    <p><a href="result2.php">けいじばん２</a></p>
    <p><a href ="logout.php">ログアウトする</a></p>
<?php elseif($status == "failed"): ?>
    <p>ログイン失敗</p>
    <p><a href="login.php">ログイン画面に戻る</a></p>
<?php else: ?>
    <form method="POST" action="login.php">
        ID：<input type="number" name="id" />
        <!--掲示板ではidはname="user_id"のもの-->
        ユーザ名：<input type="text" name="name" />
        パスワード：<input type="password" name="password" />
        <input type="submit" value="ログイン" />
        <p><a href="register.php">登録画面に移動</a></p>
    </form>
<?php endif; ?>
</body>
</html>
