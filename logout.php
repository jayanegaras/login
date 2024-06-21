<?php 

session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie('id', '', time()-100000);
setcookie('key', '', time()-100000);

header('Location: index.php');
