<?php
/**
 * Plik kierujacy do panelu logowania lub zarzadzania - w zaleznosci
 * od tego czy uzytkownik jest zalogowany czy nie.
 * 
 * @category Components
 * @package  PastaCRM
 * @author   Patryk Szulc <patryk-szulc@outlook.com>
 * @license  CC BY-NC-ND 4.0 https://creativecommons.org/licenses/by-nc-nd/4.0/
 * @link     https://github.com/psc1997/PastaCRM
 */
@session_start();
error_reporting(0);

if (!isset($_SESSION['JezusServerHome'])) {
    echo "Zaloguj się <a href='login.php'>tutaj</a>";
    header("Location: login.php");
} else {
    header("Location: dashboard.php");
}
?>