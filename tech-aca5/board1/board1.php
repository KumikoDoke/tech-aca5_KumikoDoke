<?php


function getDb(){
    $dsn = 'mysql:dbname=board1_db; host=localhost';
    //↑スペースあけたらエラーなる！！！！！！！！！！！！！

    $user = 'root';//MYSQLユーザー名
    $password = '';//MYSQLユーザーパスワード

    try{
        $db = new PDO($dsn,$user,$password);

        //PDOというクラスから作られた$dbというインスタンス
        //new演算子でインスタンスをつくって、変数$dbに代入

        $db->exec('SET NAMES utf8');
        //var_dump('接続できた');
        //exit;
        //exec()...外部コマンドを実行する関数
        //プロパティの参照

    }catch(PDOException $e){
        die("接続エラー：{$e -> getMessage() }");
    }

    return $db;
}

//$host = 'localhost';//接続先ホスト（サーバ）
//$database = 'board1_db';//接続するデータベース（スキーマ）
//MYSQLに接続情報を追加って接続を実行


//$link = mysqli_connect($host, $user, $password, $database);
//if(!$link){
    //falseの場合エラーメッセージを表示
//    echo "Error";
//    exit;
//}
//trueの場合メッセージを表示
//echo "Success  ";

//$result = mysqli_query($link, 'select * from post_table');

//while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
//    echo $row[1],'  ', $row[2];
//}


//接続を切断する
//mysqli_close($link);




