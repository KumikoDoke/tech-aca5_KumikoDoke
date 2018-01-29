<?php /* Smarty version 2.6.31, created on 2018-01-29 10:36:34
         compiled from index4.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'whether_register', 'index4.tpl', 17, false),)), $this); ?>

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
<?php echo registerbunki(array(), $this);?>

</body>