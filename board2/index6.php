<?php
/**
 * Created by PhpStorm.
 * User: doke
 * Date: 2018/01/29
 * Time: 19:21
 */
require_once './board2.php';
require_once './Encode2.php';
require_once 'C:/xampp/php/includes/smarty-2.6.31/smarty/Smarty.class.php';
session_start();
//編集画面
$smarty = new Smarty();
$smarty->template_dir="C:/xampp/htdocs/tech-aca5_KumikoDoke/board2/templates/";
$smarty->compile_dir="C:/xampp/htdocs/tech-aca5_KumikoDoke/board2/templates_c/";

$smarty->register_function("update_function","update_kinou");



function update_kinou(){
    global $errMsg;
    $db = getDb();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->beginTransaction();
//$sttはstatementって意味
    $stt = $db->prepare("SELECT * FROM post_table WHERE user_id= {$_SESSION['id']}");
    $stt->execute();
    $db = NULL;
    $bno =NULL;

    if(isset($_POST["hensyu"])){
        if(!$_POST["no"]){$errMsg = "idを入力してください<br>";}

        elseif(!$errMsg){
            $bno = $_POST["no"];
            //$bnoはポストされたid

            while($row = $stt->fetch(PDO::FETCH_ASSOC)){

                if ($row['id'] == $bno){
                    $_SESSION['contents'] = $row['contents'];
                    echo "id{$bno}の書き込みを編集できます<br>";
                    echo "<form method='POST' action='index6.php'>";
                    echo "<input type='text' name='no' size='4' value={$bno}>";
                    echo "<input type='text' name='contents' size='60' value={$_SESSION['contents']}>";
                    echo "<input type='submit' name='uwagaki' value='上書き保存'>";
                    echo "</form>";
                    break;
                }
            }

        }else {$errMsg = "{$bno}は見当たりません";}
    }
    elseif (isset($_POST["delete"])){
        if(!$_POST["no"]){$errMsg = "idを入力してください<br>";}

        elseif(!$errMsg){
            $bno = $_POST["no"];
            //$bnoはポストされたid
            try{
                $db = getDb();
                $sttm = $db->prepare("DELETE FROM post_table
            WHERE id= {$_POST['no']} AND user_id= {$_SESSION['id']}");


                $sttm->execute();
                $db = NULL;
            }catch(PDOException $e){
                die("エラーメッセージ：{$e->getMessage()}");
            }
            header('Location:http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/index5.php');

        }
    }

    if (isset($_POST["uwagaki"])){
        $con = $_POST["contents"];
        if(!$con){$errMsg = "コメントを入力してください<br>";}

        elseif(!$errMsg){
            try {
                //exit;
                $db = getDb();
                var_dump($con);
                var_dump(gettype($con));
                //exit;
                $stmt = $db->prepare("UPDATE post_table SET contents= '$con' WHERE id= {$_POST['no']} AND user_id= {$_SESSION['id']}");
                var_dump($stmt);
                //$stmt = $db->prepare("UPDATE post_table
                //  SET contents= {$_POST['contents']}
                //WHERE id= {$_POST['no']} AND user_id= {$_SESSION['id']}");
                $stmt->execute();
                //exit;

                $db = NULL;
            }catch(PDOException $e){
                die("エラーメッセージ：{$e->getMessage()}");
            }
            header('Location:http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/index5.php');
        }}
}


$smarty->display("index6.tpl");