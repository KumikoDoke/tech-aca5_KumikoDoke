<?php
/**
 * Created by PhpStorm.
 * User: doke
 * Date: 2018/01/29
 * Time: 18:55
 */
//create.php
require_once './board2.php';
require_once './Encode2.php';
require_once 'C:/xampp/php/includes/smarty-2.6.31/smarty/Smarty.class.php';
session_start();
//ログイン分岐
$smarty = new Smarty();
$smarty->template_dir="C:/xampp/htdocs/tech-aca5_KumikoDoke/board2/templates/";
$smarty->compile_dir="C:/xampp/htdocs/tech-aca5_KumikoDoke/board2/templates_c/";

$smarty->register_function("my_comment","scraping_comment");


function scraping_comment(){
    try{
        $db = getDb();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->beginTransaction();
        //$sttはstatementって意味
        $stt = $db->prepare("SELECT * FROM post_table WHERE user_id= {$_SESSION['id']}");
        $stt->execute();

//for文は繰り返す条件が"繰り返す回数"に特化されることが多いため、指定回数の繰り返しを記述する際に便利である。
        while($row = $stt->fetch(PDO::FETCH_ASSOC)){
            ?>
            <tr>
                <td><?php e($row['id']); ?></td>
                <td><?php e($row['contents']); ?></td>
                <td><?php e($row['user_id']); ?></td>
            </tr>
            <?php
        }
        $db = NULL;
    }catch(PDOException $e) {
        $db->rollBack();
        die("エラーメッセージ：{$e->getMessage()}");
    }

}



$smarty->display("index5.tpl");