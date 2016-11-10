
<?php
session_start();
require_once "class.login.php";
$login = new login;
$login->cleanSESSION();
var_dump($_SESSION);
echo '<br>';
?>
