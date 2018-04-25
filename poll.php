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

                <!-- Wykres 1 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                                $obj_data = getPollResults("all_satisfaction");
                                $data = array($obj_data->TAK, $obj_data->NIE);
                                $title = "Czy klienci są zadowoleni z usługi? (".$obj_data->SUMA_GLOSOW." głosów)";
                                $labels = array("Tak", "Nie");
                                $colors = array("#4CAF50", "#F44336");
                                showChart("doughnut", $title, $data, $labels, $colors, "percent");
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Wykres 2 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                                $arr_data =  array_replace(array_fill(1, 12, 0), (array)getPollResults("all_votes_count"));
                                $title = "Ilość głosów w kolejnych miesiącach";
                                $dane = array($arr_data[1], $arr_data[2], $arr_data[3], $arr_data[4], $arr_data[5], $arr_data[6], $arr_data[7], $arr_data[8], $arr_data[9], $arr_data[10], $arr_data[11], $arr_data[12]);
                                $labels = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
                                showChart("lineSoft", $title, $dane, $labels);
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- PANEL STRON INTERNETOWYCH -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-globe"></i> Statystyki dla stron internetowych
            </div>
            <div class="panel-body">

                <!-- Wykres 1 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                                $obj_data = getPollResults("websites_satisfaction");
                                $data = array($obj_data->TAK, $obj_data->NIE);
                                $title = "Czy klienci są zadowoleni z usługi? (".$obj_data->SUMA_GLOSOW." głosów)";
                                $labels = array("Tak", "Nie");
                                $colors = array("#4CAF50", "#F44336");
                                showChart("doughnut", $title, $data, $labels, $colors, "percent");
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Wykres 2 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                                $arr_data =  array_replace(array_fill(1, 12, 0), (array)getPollResults("websites_votes_count"));
                                $title = "Ilość głosów w kolejnych miesiącach";
                                $dane = array($arr_data[1], $arr_data[2], $arr_data[3], $arr_data[4], $arr_data[5], $arr_data[6], $arr_data[7], $arr_data[8], $arr_data[9], $arr_data[10], $arr_data[11], $arr_data[12]);
                                $labels = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
                                showChart("lineSoft", $title, $dane, $labels);
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Wykres 3 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                                $arr_data =  array_replace(array_fill(0, 6, 0), (array)getPollResults("websites_time"));
                                $title = "Ocena czasu wykonania usługi";
                                $dane = array($arr_data[6], $arr_data[5], $arr_data[4], $arr_data[3], $arr_data[2], $arr_data[1]);
                                $labels = array("Perfekcyjnie",
                                                "Bardzo dobrze",
                                                "Dobrze",
                                                "Średnio",
                                                "Słabo",
                                                "Bardzo słabo");
                                $colors = array("#4CAF50",
                                                "#81C784",
                                                "#A5D6A7",
                                                "#FFEB3B",
                                                "#EF5350",
                                                "#F44336");
                                showChart("doughnut", $title, $dane, $labels, $colors, "percent, right");
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Wykres 4 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                                $arr_data =  array_replace(array_fill(0, 6, 0), (array)getPollResults("websites_quality"));
                                $title = "Ocena jakości wykonanej usługi";
                                $dane = array($arr_data[6], $arr_data[5], $arr_data[4], $arr_data[3], $arr_data[2], $arr_data[1]);
                                $labels = array("Perfekcyjnie",
                                                "Bardzo dobrze",
                                                "Dobrze",
                                                "Średnio",
                                                "Słabo",
                                                "Bardzo słabo");
                                $colors = array("#4CAF50",
                                                "#81C784",
                                                "#A5D6A7",
                                                "#FFEB3B",
                                                "#EF5350",
                                                "#F44336");
                                showChart("doughnut", $title, $dane, $labels, $colors, "percent, right");
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Wykres 5 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                                $arr_data =  array_replace(array_fill(0, 6, 0), (array)getPollResults("websites_communication"));
                                $title = "Ocena komunikacji podczas zlecenia";
                                $dane = array($arr_data[6], $arr_data[5], $arr_data[4], $arr_data[3], $arr_data[2], $arr_data[1]);
                                $labels = array("Perfekcyjnie",
                                                "Bardzo dobrze",
                                                "Dobrze",
                                                "Średnio",
                                                "Słabo",
                                                "Bardzo słabo");
                                $colors = array("#4CAF50",
                                                "#81C784",
                                                "#A5D6A7",
                                                "#FFEB3B",
                                                "#EF5350",
                                                "#F44336");
                                showChart("doughnut", $title, $dane, $labels, $colors, "percent, right");
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Wykres 6 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                                $arr_data =  array_replace(array_fill(0, 6, 0), (array)getPollResults("websites_price"));
                                $title = "Ocena ceny za wykonaną pracę";
                                $dane = array($arr_data[6], $arr_data[5], $arr_data[4], $arr_data[3], $arr_data[2], $arr_data[1]);
                                $labels = array("Perfekcyjnie",
                                                "Bardzo dobrze",
                                                "Dobrze",
                                                "Średnio",
                                                "Słabo",
                                                "Bardzo słabo");
                                $colors = array("#4CAF50",
                                                "#81C784",
                                                "#A5D6A7",
                                                "#FFEB3B",
                                                "#EF5350",
                                                "#F44336");
                                showChart("doughnut", $title, $dane, $labels, $colors, "percent, right");
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PANEL SERWISU KOMPUTEROWEGO -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-laptop"></i> Statystyki dla serwisu komputerowego
            </div>
            <div class="panel-body">

                <!-- Wykres 1 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                                $obj_data = getPollResults("computer_service_satisfaction");
                                $data = array($obj_data->TAK, $obj_data->NIE);
                                $title = "Czy klienci są zadowoleni z usługi? (".$obj_data->SUMA_GLOSOW." głosów)";
                                $labels = array("Tak", "Nie");
                                $colors = array("#4CAF50", "#F44336");
                                showChart("doughnut", $title, $data, $labels, $colors, "percent");
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Wykres 2 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                                $arr_data =  array_replace(array_fill(1, 12, 0), (array)getPollResults("computer_service_votes_count"));
                                $title = "Ilość głosów w kolejnych miesiącach";
                                $dane = array($arr_data[1], $arr_data[2], $arr_data[3], $arr_data[4], $arr_data[5], $arr_data[6], $arr_data[7], $arr_data[8], $arr_data[9], $arr_data[10], $arr_data[11], $arr_data[12]);
                                $labels = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
                                showChart("lineSoft", $title, $dane, $labels);
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Wykres 3 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                                $arr_data =  array_replace(array_fill(0, 6, 0), (array)getPollResults("computer_service_time"));
                                $title = "Ocena czasu wykonania usługi";
                                $dane = array($arr_data[6], $arr_data[5], $arr_data[4], $arr_data[3], $arr_data[2], $arr_data[1]);
                                $labels = array("Perfekcyjnie",
                                                "Bardzo dobrze",
                                                "Dobrze",
                                                "Średnio",
                                                "Słabo",
                                                "Bardzo słabo");
                                $colors = array("#4CAF50",
                                                "#81C784",
                                                "#A5D6A7",
                                                "#FFEB3B",
                                                "#EF5350",
                                                "#F44336");
                                showChart("doughnut", $title, $dane, $labels, $colors, "percent, right");
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Wykres 4 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                                $arr_data =  array_replace(array_fill(0, 6, 0), (array)getPollResults("computer_service_quality"));
                                $title = "Ocena jakości wykonanej usługi";
                                $dane = array($arr_data[6], $arr_data[5], $arr_data[4], $arr_data[3], $arr_data[2], $arr_data[1]);
                                $labels = array("Perfekcyjnie",
                                                "Bardzo dobrze",
                                                "Dobrze",
                                                "Średnio",
                                                "Słabo",
                                                "Bardzo słabo");
                                $colors = array("#4CAF50",
                                                "#81C784",
                                                "#A5D6A7",
                                                "#FFEB3B",
                                                "#EF5350",
                                                "#F44336");
                                showChart("doughnut", $title, $dane, $labels, $colors, "percent, right");
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Wykres 5 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                                $arr_data =  array_replace(array_fill(0, 6, 0), (array)getPollResults("computer_service_communication"));
                                $title = "Ocena komunikacji podczas zlecenia";
                                $dane = array($arr_data[6], $arr_data[5], $arr_data[4], $arr_data[3], $arr_data[2], $arr_data[1]);
                                $labels = array("Perfekcyjnie",
                                                "Bardzo dobrze",
                                                "Dobrze",
                                                "Średnio",
                                                "Słabo",
                                                "Bardzo słabo");
                                $colors = array("#4CAF50",
                                                "#81C784",
                                                "#A5D6A7",
                                                "#FFEB3B",
                                                "#EF5350",
                                                "#F44336");
                                showChart("doughnut", $title, $dane, $labels, $colors, "percent, right");
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Wykres 6 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                                $arr_data =  array_replace(array_fill(0, 6, 0), (array)getPollResults("computer_service_price"));
                                $title = "Ocena ceny za wykonaną pracę";
                                $dane = array($arr_data[6], $arr_data[5], $arr_data[4], $arr_data[3], $arr_data[2], $arr_data[1]);
                                $labels = array("Perfekcyjnie",
                                                "Bardzo dobrze",
                                                "Dobrze",
                                                "Średnio",
                                                "Słabo",
                                                "Bardzo słabo");
                                $colors = array("#4CAF50",
                                                "#81C784",
                                                "#A5D6A7",
                                                "#FFEB3B",
                                                "#EF5350",
                                                "#F44336");
                                showChart("doughnut", $title, $dane, $labels, $colors, "percent, right");
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- PANEL 'INNE' -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-globe"></i> Statystyki dla innych usług
            </div>
            <div class="panel-body">

                <!-- Wykres 1 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                                $obj_data = getPollResults("other_satisfaction");
                                $data = array($obj_data->TAK, $obj_data->NIE);
                                $title = "Czy klienci są zadowoleni z usługi? (".$obj_data->SUMA_GLOSOW." głosów)";
                                $labels = array("Tak", "Nie");
                                $colors = array("#4CAF50", "#F44336");
                                showChart("doughnut", $title, $data, $labels, $colors, "percent");
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Wykres 2 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                                $arr_data =  array_replace(array_fill(1, 12, 0), (array)getPollResults("other_votes_count"));
                                $title = "Ilość głosów w kolejnych miesiącach";
                                $dane = array($arr_data[1], $arr_data[2], $arr_data[3], $arr_data[4], $arr_data[5], $arr_data[6], $arr_data[7], $arr_data[8], $arr_data[9], $arr_data[10], $arr_data[11], $arr_data[12]);
                                $labels = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
                                showChart("lineSoft", $title, $dane, $labels);
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Wykres 3 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                                $arr_data =  array_replace(array_fill(0, 6, 0), (array)getPollResults("other_time"));
                                $title = "Ocena czasu wykonania usługi";
                                $dane = array($arr_data[6], $arr_data[5], $arr_data[4], $arr_data[3], $arr_data[2], $arr_data[1]);
                                $labels = array("Perfekcyjnie",
                                                "Bardzo dobrze",
                                                "Dobrze",
                                                "Średnio",
                                                "Słabo",
                                                "Bardzo słabo");
                                $colors = array("#4CAF50",
                                                "#81C784",
                                                "#A5D6A7",
                                                "#FFEB3B",
                                                "#EF5350",
                                                "#F44336");
                                showChart("doughnut", $title, $dane, $labels, $colors, "percent, right");
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Wykres 4 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                                $arr_data =  array_replace(array_fill(0, 6, 0), (array)getPollResults("other_quality"));
                                $title = "Ocena jakości wykonanej usługi";
                                $dane = array($arr_data[6], $arr_data[5], $arr_data[4], $arr_data[3], $arr_data[2], $arr_data[1]);
                                $labels = array("Perfekcyjnie",
                                                "Bardzo dobrze",
                                                "Dobrze",
                                                "Średnio",
                                                "Słabo",
                                                "Bardzo słabo");
                                $colors = array("#4CAF50",
                                                "#81C784",
                                                "#A5D6A7",
                                                "#FFEB3B",
                                                "#EF5350",
                                                "#F44336");
                                showChart("doughnut", $title, $dane, $labels, $colors, "percent, right");
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Wykres 5 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                                $arr_data =  array_replace(array_fill(0, 6, 0), (array)getPollResults("other_communication"));
                                $title = "Ocena komunikacji podczas zlecenia";
                                $dane = array($arr_data[6], $arr_data[5], $arr_data[4], $arr_data[3], $arr_data[2], $arr_data[1]);
                                $labels = array("Perfekcyjnie",
                                                "Bardzo dobrze",
                                                "Dobrze",
                                                "Średnio",
                                                "Słabo",
                                                "Bardzo słabo");
                                $colors = array("#4CAF50",
                                                "#81C784",
                                                "#A5D6A7",
                                                "#FFEB3B",
                                                "#EF5350",
                                                "#F44336");
                                showChart("doughnut", $title, $dane, $labels, $colors, "percent, right");
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Wykres 6 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php
                                $arr_data =  array_replace(array_fill(0, 6, 0), (array)getPollResults("other_price"));
                                $title = "Ocena ceny za wykonaną pracę";
                                $dane = array($arr_data[6], $arr_data[5], $arr_data[4], $arr_data[3], $arr_data[2], $arr_data[1]);
                                $labels = array("Perfekcyjnie",
                                                "Bardzo dobrze",
                                                "Dobrze",
                                                "Średnio",
                                                "Słabo",
                                                "Bardzo słabo");
                                $colors = array("#4CAF50",
                                                "#81C784",
                                                "#A5D6A7",
                                                "#FFEB3B",
                                                "#EF5350",
                                                "#F44336");
                                showChart("doughnut", $title, $dane, $labels, $colors, "percent, right");
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-md-4">
    
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-life-ring"></i> Pomoc
            </div>
            <div class="panel-body">
                <div class="alert alert-info">
                    Data pobrania statystyk z serwera: <?= substr(file_get_contents("temp/all_satisfaction.json"), 0, 10) ?>
                    <br><i>Podana data odnosi się do pierwszego wykresu, nie mniej jednak przy prawidłowej konfiguracji systemu wszystkie wykresy odświeżają się równocześnie.</i>
                </div>
                <button class="btn btn-primary full-width" disabled>Pobierz statystyki jako plik PDF</button>
                <hr>
                <button class="btn btn-primary full-width" onclick="javascript:window.print();">Drukuj stronę ze statystykami</button>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-comment"></i> Dodatkowe komentarze dot. usług
            </div>
            <div class="panel-body">

                <!-- Komentarze STRON INTERNETOWYCH -->
                <?php $arr_data = (array)getPollResults("websites_additional_comment"); ?>
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a data-toggle="collapse" href="#collapse_websites">
                                <i class="fa fa-globe"></i> Strony internetowe <label class="label label-info pull-right"><?= sizeof($arr_data); ?> komentarzy</label>
                            </a>
                        </div>
                        <div id="collapse_websites" class="panel-collapse collapse">
                            <ul class="list-group">
                                <?php
                                    if(sizeof($arr_data) > 0){
                                        foreach ($arr_data as $key => $value) {
                                            echo "<li class='list-group-item'>".$value."</li>";
                                        }
                                    }else{
                                        echo "<li class='list-group-item'><i>Brak komentarzy w podanej kategorii...</i></li>";
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div> 
                
                <!-- Komentarze SERWISU KOMPUTEROWEGO -->
                <?php $arr_data = (array)getPollResults("computer_service_additional_comment"); ?>
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a data-toggle="collapse" href="#collapse_computer_service">
                                <i class="fa fa-laptop"></i> Serwis komputerowy <label class="label label-info pull-right"><?= sizeof($arr_data); ?> komentarzy</label>
                            </a>
                        </div>
                        <div id="collapse_computer_service" class="panel-collapse collapse">
                            <ul class="list-group">
                                <?php
                                    if(sizeof($arr_data) > 0){
                                        foreach ($arr_data as $key => $value) {
                                            echo "<li class='list-group-item'>".$value."</li>";
                                        }
                                    }else{
                                        echo "<li class='list-group-item'><i>Brak komentarzy w podanej kategorii...</i></li>";
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div> 

                <!-- Komentarze INNE -->
                <?php $arr_data = (array)getPollResults("other_additional_comment"); ?>
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a data-toggle="collapse" href="#collapse_other">
                                <i class="fa fa-ellipsis-h"></i> Inne <label class="label label-info pull-right"><?= sizeof($arr_data); ?> komentarzy</label>
                            </a>
                        </div>
                        <div id="collapse_other" class="panel-collapse collapse">
                            <ul class="list-group">
                                <?php
                                    if(sizeof($arr_data) > 0){
                                        foreach ($arr_data as $key => $value) {
                                            echo "<li class='list-group-item'>".$value."</li>";
                                        }
                                    }else{
                                        echo "<li class='list-group-item'><i>Brak komentarzy w podanej kategorii...</i></li>";
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div> 

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