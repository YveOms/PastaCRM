<?php
@session_start();
require_once("inc/functions.php");
if(checkUserPermissions(3)){
    $siteTitle = "Dashboard";
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= showSiteTitle($siteTitle) ?></title>
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
                            <small><?= showRandomQuote(); ?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> <?= $siteTitle ?>
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <?php
                            checkFolderPermissions();
                            checkComputerService();

                            checkDomainExpire();
                            checkServersExpire();
                            checkSSLExpire();
                            
                            checkLogAnomaly();
                        ?>
                    </div>
                </div>

<!-- STRONA -->
<div class="col-lg-4">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-fw fa-external-link"></i> Na skróty</h3>
        </div>
        <div class="panel-body">
            <a href="https://360suite.google.com/overview/home" target="_blank" class="btn btn-default btn-square" rel="nofollow">
                <img src="img/svg/google_analitics.svg" alt="icon">
                <br>Google Analitics
            </a>

            <a href="https://wakatime.com/dashboard" target="_blank" class="btn btn-default btn-square" rel="nofollow">
                <img src="img/svg/waka_time.svg" alt="icon">
                <br>WakaTime
            </a>

            <a href="https://www.wunderlist.com/#/lists/inbox" target="_blank" class="btn btn-default btn-square" rel="nofollow">
                <img src="img/svg/wunderlist.svg" alt="icon">
                <br>Lista Zadań
                <br>"ToDo"
            </a>
            <hr>
            <a href="https://proserwer.pl/panel/?d=logowanie" target="_blank" class="btn btn-default btn-square" rel="nofollow">
                <img src="img/svg/server.svg" alt="icon">
                <br>ProSerwer
            </a>
            <a onclick="redirectToCPanel()" class="btn btn-default btn-square">
                <img src="img/svg/cPanel.svg" alt="icon">
                <br>Zarządzanie
                <br>Hostingiem
            </a>

            <a href="https://www.ovh.com/auth/?action=gotomanager&from=https://www.ovh.pl/" target="_blank" class="btn btn-default btn-square" rel="nofollow">
                <img src="img/svg/OVH.svg" alt="icon">
                <br>Zarządzanie
                <br>Domenami
            </a>

            <button class="btn btn-default btn-square" disabled>
                <img src="img/svg/mail.svg" alt="icon">
                <br>Poczta PastaMedia
                <br>WebMail
            </button>

            <a href="https://uptimerobot.com/login" target="_blank" class="btn btn-default btn-square btn-sm" rel="nofollow">
                <img src="img/svg/uptime_robot.svg" alt="icon">
                <br>UptimeRobot
                <br>Monitorowanie Usług
            </a>

        </div>
    </div>

</div>
<div class="col-lg-4">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-fw fa-laptop"></i> <i class="fa fa-fw fa-bar-chart"></i> Podsumowanie zakończonych zgłoszeń serwisowych</h3>
        </div>
        <div class="panel-body">
            <?php
                showMonthlyComputerServiceChart();
            ?>
        </div>
    </div>

</div>
<div class="col-lg-4">

    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-fw fa-money"></i> <i class="fa fa-fw fa-bar-chart"></i> Miesięczne podsumowanie finansowe</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <?php
                    showMonthlyPaymentsChart();
                ?>
            </div>
            <div class="text-right">
                <a href="transactionsMore.php">Pokaż więcej <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-fw fa-code"></i> <i class="fa fa-fw fa-bar-chart"></i>Tygodniowe statystyki programowania <i>by WakaTime</i></h3>
        </div>
        <div class="panel-body">
            
            <figure><embed src="https://wakatime.com/share/@90bfedcf-8358-45f3-b838-0e7eaa7fcec1/9f5f6a2a-ebac-4a2a-99c5-79a5d2902e07.svg"></embed></figure>
            
            <div class="text-right">
                <a href="https://wakatime.com/dashboard" target="_blank" rel="nofollow">Pokaż więcej <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

</div>
<!-- KONIEC STRONY -->

            </div>
        </div>
    </div>
</body>
</html>
<?php } ?>