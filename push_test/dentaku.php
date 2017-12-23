<html>
<head>
    <title>denntaku.php</title>
</head>
<body>
<?php
//値を取得
$a = $_POST['txtA'];
//$a = 'string'; $i = 1;
//変数の宣言
$b = $_POST['txtB'];
//$_GET[]でデータの受け取り
/*[  ]のなかに、受け取りたいフォームの name属性を
書くことで受け取ることができます。

*/
$cal = $_POST['selcal'];

//セレクトボックスによって処理を変える
switch ($cal) {
    case "＋":
        $answer = $a + $b;
        break;
    case "－":
        $answer = $a - $b;
        break;
    case "×":
        $answer = $a * $b;
        break;
    case "÷":
        $answer = $a / $b;
        break;
    default:
        break;
}

//計算結果を表示
print ($a.$cal.$b."=".$answer."\n");
?>
<br />
<br />
</body>
</html>