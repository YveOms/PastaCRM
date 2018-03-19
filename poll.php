<?php
@session_start();
require_once("inc/functions.php");
if(checkUserPermissions(3)){
    $siteTitle = "Ankieta";
?>
<!DOCTYPE html>
<html>
<head>
    <title>
        <?= showSiteTitle($siteTitle) ?>
    </title>
    <?php include_once("inc/head.php"); ?>
</head>

<body>
    <div id="wrapper">
        <?php include_once("inc/menus.php"); ?>
        <div id="page-wrapper">
            <div class="container-fluid">

            <!-- HEADER -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <?= $siteTitle ?>
                        <small>Jak klienci oceniają wykonaną pracę?</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>
                            <a href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-pie-chart"></i>
                            <?= $siteTitle ?>
                        </li>
                    </ol>
                </div>
            </div>

<!-- STRONA -->
<div class="row">
    <div class="col-md-8">

        <!-- PANEL: STATYSTYKI OGOLNE -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-line-chart"></i> Garść ogólnych statystyk
            </div>
            <div class="panel-body">

                <div class="alert alert-warning">
                    <b>Panel w trakcie budowy...</b>
                </div>

                <!-- Wykres 1 --
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                            /*
                                $obj_data = getPollResults("all_satisfaction");

                                $data = array("60", "4");
                                $title = "Czy klienci są zadowoleni z usługi?";
                                $labels = array("Tak", "Nie");
                                $colors = array("#4CAF50", "#F44336");
                                
                                showChart("doughnut", $title, $data, $labels, $colors);
                                */
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Wykres 2 --
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                            /*
                                $title = "Ilość głosów w kolejnych miesiącach";
                                $dane = array(5, 10, 15, 20, 25, 40, 50, 68, 80, 90, 95, 105);
                                $labels = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
                                
                                showChart("lineSoft", $title, $dane, $labels);
                                */
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- PANEL STRONY --
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-globe"></i> Statystyki dla stron internetowych
            </div>
            <div class="panel-body">

                <!-- Wykres 1 --
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                            /*
                                $title = "Czy klienci są zadowoleni z usługi? (strony internetowe)";
                                //$dane = getPollResults("websites");
                                $dane = array("60", "10");
                                $labels = array("Tak", "Nie");
                                $colors = array("#4CAF50", "#F44336");
                                
                                showChart("doughnut", $title, $dane, $labels, $colors);
                              */  
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Wykres 2 --
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                            /*
                                $title = "Łączna ilość głosów w kolejnych miesiącach";
                                //$dane = getPollResults("websites");
                                $dane = array(5, 10, 15, 20, 25, 40);
                                $labels = array("Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec");
                                
                                showChart("line", $title, $dane, $labels);
                                */
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Wykres 3 --
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                            /*
                                $title = "Ocena czasu wykonania usługi";
                                //$dane = getPollResults("websites");
                                $dane = array("60",
                                                "50",
                                                "40",
                                                "30",
                                                "20",
                                                "10");
                                $labels = array("6 - Perfekcyjnie",
                                                "5 - Bardzo dobrze",
                                                "4 - Dobrze",
                                                "3 - Średnio",
                                                "2 - Źle",
                                                "1 - Bardzo źle");
                                $colors = array("#4CAF50",
                                                "#81C784",
                                                "#A5D6A7",
                                                "#FFEB3B",
                                                "#EF5350",
                                                "#F44336");
                                showChart("doughnut", $title, $dane, $labels, $colors);
                                */
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Wykres 4 --
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                            /*
                                $title = "Ocena jakości wykonanej usługi";
                                //$dane = getPollResults("websites");
                                $dane = array("60",
                                                "50",
                                                "40",
                                                "30",
                                                "20",
                                                "10");
                                $labels = array("6 - Perfekcyjnie",
                                                "5 - Bardzo dobrze",
                                                "4 - Dobrze",
                                                "3 - Średnio",
                                                "2 - Źle",
                                                "1 - Bardzo źle");
                                $colors = array("#4CAF50",
                                                "#81C784",
                                                "#A5D6A7",
                                                "#FFEB3B",
                                                "#EF5350",
                                                "#F44336");
                                showChart("doughnut", $title, $dane, $labels, $colors);
                                */
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Wykres 5 --
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                            /*
                                $title = "Ocena komunikacji podczas zlecenia";
                                //$dane = getPollResults("websites");
                                $dane = array("60",
                                                "50",
                                                "40",
                                                "30",
                                                "20",
                                                "10");
                                $labels = array("6 - Perfekcyjnie",
                                                "5 - Bardzo dobrze",
                                                "4 - Dobrze",
                                                "3 - Średnio",
                                                "2 - Źle",
                                                "1 - Bardzo źle");
                                $colors = array("#4CAF50",
                                                "#81C784",
                                                "#A5D6A7",
                                                "#FFEB3B",
                                                "#EF5350",
                                                "#F44336");
                                showChart("doughnut", $title, $dane, $labels, $colors);
                                */
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Wykres 6 --
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                                /*
                                $title = "Ocena ceny za wykonaną usługę";
                                //$dane = getPollResults("websites");
                                $dane = array("60",
                                                "50",
                                                "40",
                                                "30",
                                                "20",
                                                "10");
                                $labels = array("6 - Perfekcyjnie",
                                                "5 - Bardzo dobrze",
                                                "4 - Dobrze",
                                                "3 - Średnio",
                                                "2 - Źle",
                                                "1 - Bardzo źle");
                                $colors = array("#4CAF50",
                                                "#81C784",
                                                "#A5D6A7",
                                                "#FFEB3B",
                                                "#EF5350",
                                                "#F44336");
                                showChart("doughnut", $title, $dane, $labels, $colors);
                                */
                            ?>
                        </div>
                    </div>
                </div>
-->
            </div>
        </div>

    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-life-ring"></i> Pomoc</div>
                <div class="panel-body">
                    <div class="alert alert-info">
                        <s>Statystyki są pobierane z zewnętrznego serwera i odświeżane tylko raz w ciągu każdego dnia</s>
                    </div>
                    <hr>
                    <button class="btn btn-warning full-width" disabled>Wymuś pobranie nowych danych z serwera</button>
                    <hr>
                    <button class="btn btn-primary full-width" disabled>Pobierz statystyki jako plik PDF</button>
                    <hr>
                    <button class="btn btn-primary full-width" disabled>Pobierz statystyki jako RAW</button>
                    <hr>
                    <button class="btn btn-primary full-width" onclick="javascript:window.print();">Drukuj stronę ze statystykami</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- KONIEC STRONY -->

</div>
</div>
</body>
</html>
<?php } ?>