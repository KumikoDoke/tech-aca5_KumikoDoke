<html>
<head>
    <title>データの登録</title>
</head>
<body>
<form method = "POST" action = "insert_process.php">
    <p>
        ID：<br />
        <input type="text" name="id" size="25" maxlength="5" />
    </p><p>
        名前：<br />
        <input type="text" name="name" size="35" maxlength="20" />
    </p><p>
        コメント：<br />
        <input type="text" name="contents" size="6" maxlength="150" />
    </p><p>
        <input type="submit" value="登録" />
    </p>
</form>
</body>
</html>
