
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>新規登録</title>
</head>
<body>
<h1>新規登録</h1>
<form method="POST" action="index4.php">
    ID:<input type="number" name="id">
    ユーザー名：<input type="text" name="name" />
    パスワード：<input type="password" name="password" />
    <!-- inputタグのname属性はinput要素の名前を指定する -->
    <input type="submit" value="登録" />
</form>
{whether_register}
</body>