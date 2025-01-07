<?php
session_start();
//$_SESSION["storedSecrect"]="";
unset($_SESSION["qrscanned"]);


header('Location: index.php ',true);
exit();
?>