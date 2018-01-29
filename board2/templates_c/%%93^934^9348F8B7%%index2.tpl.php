<?php /* Smarty version 2.6.31, created on 2018-01-29 11:49:54
         compiled from index2.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'mein_gamen', 'index2.tpl', 15, false),)), $this); ?>
<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8" />
    <title>Smartyの掲示板２</title>
</head>
<body>
<h1>Smartyの掲示板２</h1>
Hello <?php echo $this->_tpl_vars['name']; ?>
!
<table boarder="1">
    <tr>
        <th>id</th><th>contents</th><th>user_id</th>
    </tr>
    <?php echo meinboard(array(), $this);?>


    <form method = "POST" action = "insert_process2.php">
        <p>
            ID：<br />
            <input type="text" name="id" size="25" maxlength="5" />
        </p><p>
            コメント：<br />
            <input type="text" name="contents" size="30" maxlength="150" />
        </p><p>
            ユーザーid：<br />
            <input type="text" name="user_id" size="10" maxlength="20" value="<?php echo $_SESSION['id']; ?>
"/>
        </p><p>
            <input type="submit" value="登録" />
        </p>
        <p><a href="index5.php">編集・削除</a></p>
        <p><a href ="index7.php">ログアウトする</a></p>
    </form>
</body>
</html>