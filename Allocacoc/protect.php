<?php
if (!isset($_SESSION)) {
  session_start();
}

//假设在登录验证成功以后，设置了 $_SESSION['userid']

if(empty($_SESSION['userid']))
{
  header("Location: index.php");
  exit;
}

