<?php
session_start();
session_unset();
session_destroy();

setcookie('loginAuto', '', time() - 3600);
setcookie('id', '', time() - 3600);
setcookie('code', '', time() - 3600);
header("Location: login.php");
exit;
