<?php
/**
 * Plik zawierajacy podstawowy widok cennika.
 * Strona wyswietla sam cennik bez mozliwosci nawigacji po PastaCRM!
 * Uzywana na potrzeby aplikacji "Cennik" dla systemu Android.
 * 
 * @category Components
 * @package  PastaCRM
 * @author   Patryk Szulc <patryk-szulc@outlook.com>
 * @license  CC BY-NC-ND 4.0 https://creativecommons.org/licenses/by-nc-nd/4.0/
 * @link     https://github.com/psc1997/PastaCRM
 */
require_once "inc/functions.php";
$siteTitle = "Szybki Cennik";
@$android_ID = $_GET['android_ID'];
?>
<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo getSiteTitle($siteTitle) ?></title>
    <?php require_once "inc/head.php"; ?>
    <style>
        h1{
            text-align: center;
        }
        
        .col-lg-12{
            padding-right: 0px !important;
            padding-left: 0px !important;
        }
        
        .panel-body{
            padding: 0px;
            padding-top: 15px;
            padding-bottom: 15px;
        }
    </style>
</head>
<body>
    <!-- STRONA -->
    <div class="col-lg-12">
        <h1>Cennik PastaMedia</h1>
        <?php
        if ($android_ID === ANDROID_KEY) {
            showInfo(
                "Podane ceny nie zawierają kosztów podzespołów (w przypadku kosztów serwisowania sprzętu)
                <br>Podane ceny są cenami <b>netto</b> oraz <b>brutto</b>."
            );
        ?>
        <div class="form-group">
            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                <div class="input-group-addon"><i class="fa fa-fw fa-search"></i></div>
                <input type="text" class="form-control" id="pricinglist_search_input" placeholder="Szukaj usługi..." onkeyup="searchInsideTable('pricinglist_search_input', 'pricing_table', 0)">
            </div>
        </div>
        <?php
            showPricingList(false);
        } else {
            showError(
                "Nie masz dostepu do tych danych!
                <br>Pobierz aplikację Cennik, a następnie uwierzytelnij swoje urządzenie.
                <br>Możesz to zrobić kontaktując się z administratorem."
            );
        }
        ?>
        <div class="alert alert-info">
            <a href="downloads/Cennik.apk" class="alert-link">Pobierz aplikację "Cennik.apk"</a>
        </div>
    </div>
    <!-- KONIEC STRONY -->
</body>
</html>