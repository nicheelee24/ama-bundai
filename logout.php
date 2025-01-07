<?php
session_start();
//$_SESSION["storedSecrect"]="";
unset($_SESSION["qrscanned"]);
//unset($_SESSION['storedSecrect']);

header('Location: index.php ',true);
exit();
?>