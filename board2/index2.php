<?php
require_once './board2.php';
require_once './Encode2.php';
require_once 'C:/xampp/php/includes/smarty-2.6.31/smarty/Smarty.class.php';
session_start();

$smarty = new Smarty();
$smarty->template_dir="C:/xampp/htdocs/tech-aca5_KumikoDoke/board2/templates/";
$smarty->compile_dir="C:/xampp/htdocs/tech-aca5_KumikoDoke/board2/templates_c/";
//mein gamen

$smarty->assign("name","world");
$smarty->register_function('mein_gamen','meinboard');


function meinboard(){
    try{
        $db = getDb();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->beginTransaction();
        //$sttはstatementって意味
        $stt = $db->prepare('SELECT * FROM post_table');
        $stt->execute();
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

$smarty->display("index2.tpl");