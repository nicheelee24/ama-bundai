<?php
session_start();
//$_SESSION["storedSecrect"]="";
//unset($_SESSION["storedSecrect"]);

session_destroy();

session_abort();


header('Location: index.php ',true);
exit();
?>