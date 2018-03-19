<?php
@session_start();
error_reporting(0);

if(!isset($_SESSION['JezusServerHome'])){
    echo "Zaloguj się <a href='login.php'>tutaj</a>";
    header("Location: login.php");
}else{
    header("Location: dashboard.php");
}
?>