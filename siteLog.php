<?php
@session_start();
require_once("inc/functions.php");
if(checkUserPermissions(3)){
    $siteTitle = "Log Systemu";
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
                            <small>Check last users activity</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-book"></i> <?= $siteTitle ?>
                            </li>
                        </ol>
                    </div>
                </div>

                <!-- STRONA -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-book"></i> PastaCRM Log</div>
                            <div class="panel-body">
                               <?php
                                    showSiteLog();
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-life-ring"></i> Pomoc</div>
                            <div class="panel-body">
                                <img src="img/site_log.png" alt="Site Log Comics" class="full-width">
                                <hr>
                                <a href="CHANGELOG" class="btn btn-primary full-width" target="_blank">Otwórz changelog PastaCRM</a>
                                <hr>
                                <p>
                                    <b>Co mogę zobaczyć w logu?</b>
                                    <br>W logu pojawią się informacje o dodanych lub usuniętych użytkownikach, informacje o wysłanych na serwer plikach, informacje o plikach usuniętych i inne ważne powiadomienia.
                                </p>
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