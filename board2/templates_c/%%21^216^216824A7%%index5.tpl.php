<?php /* Smarty version 2.6.31, created on 2018-01-29 11:39:14
         compiled from index5.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'my_comment', 'index5.tpl', 18, false),)), $this); ?>
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
<?php echo scraping_comment(array(), $this);?>