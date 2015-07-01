<?php
if (!isset($_SESSION)) {
  session_start();
}

//假设在登录验证成功以后，设置了 $_SESSION['admin_id']
if((!isset($_SESSION['admin_id']) || $_SESSION['admin_id']==""))
{
    header("Location: index.php");
    exit;
}

?>
