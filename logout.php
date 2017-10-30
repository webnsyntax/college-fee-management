<?php
session_start();
unset($_SESSION['uname']);
session_destroy();
include("login.php");
echo '<script> alert("Your are successfully logged out") </script>';
echo '<script language="JavaScript"> window.location.href ="login.php" </script>';
//header('Location:login.php');
?>