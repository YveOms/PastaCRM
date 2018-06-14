<?php
/**
 * AJAX
 * 
 * Plik kontrolujacy wykonywanie funkcji AJAX.
 * 
 * @category Components
 * @package  PastaCRM
 * @author   Patryk Szulc <patryk-szulc@outlook.com>
 * @license  CC BY-NC-ND 4.0 https://creativecommons.org/licenses/by-nc-nd/4.0/
 * @link     https://github.com/psc1997/PastaCRM
 */
require_once "functions.php";

if (!DEBUG) {
    error_reporting(0);
}

/* --------------------------------------------------
 * 0. Przyjmowanie i uruchamianie funkcji przez AJAX
 * -------------------------------------------------- */

$f = @$_GET['f'];
if ($f) {
    if ($f === "login") {
        login($_POST['login'], $_POST['passwd']);
    } else if (checkUserPermissions(0)
        || checkUserPermissions(1)
        || checkUserPermissions(2)
        || checkUserPermissions(3)
    ) {
        switch($f) {
        case "addNewPayment":
            addNewPayment($_GET['mode'], $_GET['id'], $_GET['date'], $_GET['amount'], $_GET['name']);
            break;
        case "showConnectedPayments":
            showConnectedPayments($_GET['mode'], $_GET['id'], $_GET['editable']);
            break;
        case "deletePayment":
            deletePayment($_GET['id']);
            break;
        case "movePricingListItem":
            movePricingListItem($_GET['id'], $_GET['direction']);
            break;
        default:
            return false;
            break;
        }
    }
}
?>