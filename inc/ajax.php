<?php

require_once("functions.php");

/* --------------------------------------------------
 * 0. Przyjmowanie i uruchamianie funkcji przez AJAX
 * -------------------------------------------------- */

$f = @$_GET['f'];
if($f){
    switch($f){
        case "login":
            login($_POST['login'], $_POST['passwd']);
            break;
        case "addNewPayment":
            addNewPayment($_GET['mode'], $_GET['id'], $_GET['date'], $_GET['amount'], $_GET['name']);
            break;
        case "showConnectedPayments":
            showConnectedPayments($_GET['mode'], $_GET['id'], $_GET['editable']);
            break;
        case "deletePayment":
            deletePayment($_GET['id']);
            break;
        default:
            return false;
            break;
    }
}

?>