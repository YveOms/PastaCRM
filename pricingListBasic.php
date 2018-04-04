<?php
/*
 * UWAGA! Ta strona wyswietla sam cennik bez mozliwosci nawigacji po PastaCRM!
 * Uzywana na potrzeby aplikacji "Cennik" dla systemu Android.
 */
require_once("inc/functions.php");

$siteTitle = "Szybki Cennik";
$key = "[UNIKALNY KOD ID]";
@$android_ID = $_GET['android_ID'];
?>
<!DOCTYPE HTML>
<html>
<head>
    <title><?= showSiteTitle($siteTitle) ?></title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Basic Pricing List View">
    <meta name="author" content="PastaMedia | Patryk Szulc">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
    
    <!-- Android Chrome Navibar Color -->
    <meta name="theme-color" content="#222222"/>
    
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    
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
            if($android_ID === $key){ // Android Unique ID
                showInfo("Podane ceny nie zawierają kosztów podzespołów (w przypadku kosztów serwisowania sprzętu)
                        <br>Podane ceny są cenami <b>netto</b> oraz <b>brutto</b>.");
                showPricingList(false);
            }else{
                showError("Nie masz dostepu do tych danych!<br>Pobierz aplikację Cennik, a następnie uwierzytelnij swoje urządzenie.<br>Możesz to zrobić kontaktując się z administratorem.");
            }
        ?>
        <div class="alert alert-info">
            <a href="downloads/Cennik.apk" class="alert-link">Pobierz aplikację "Cennik.apk"</a>
        </div>
    </div>
    <!-- KONIEC STRONY -->
</body>
</html>