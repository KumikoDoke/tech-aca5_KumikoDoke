<?php /* Smarty version 2.6.31, created on 2018-01-25 18:02:00
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'loginbunki', 'index.tpl', 11, false),)), $this); ?>
<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8" />
    <title>ログイン</title>
</head>
<body>
<h1>ログイン</h1>
Hello <?php echo $this->_tpl_vars['name']; ?>
!
<?php echo login(array(), $this);?>

</body>
</html>