<html>
<head>
    <title>編集</title>
</head>
<body>
<form method="POST" action="index6.php">
    id<input type="text" name="no" size="4">
    <input type="submit" name="hensyu" value="編集">
    <input type='submit' name='delete' value='削除'>
</form>

<p><a href="index2.php">一覧に戻る</a></p>

<table boarder="1">
    <tr>
        <th>id</th><th>contents</th><th>user_id</th>
    </tr>
{my_comment}