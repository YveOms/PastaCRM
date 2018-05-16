<?php
@session_start();
require_once("inc/functions.php");
if(checkUserPermissions(2) || checkUserPermissions(3)){
    $siteTitle = "Strony internetowe";
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= showSiteTitle($siteTitle) ?></title>
    <?php include_once("inc/head.php"); ?>

    <style>
        hr{
            margin: 5px;
        }
    </style>
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
                            <small>Just making Internet better place...</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-globe"></i> <?= $siteTitle ?>
                            </li>
                        </ol>
                    </div>
                </div>
                
        <!-- STRONA -->
        <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-globe"></i> Lista zarządzanych stron internetowych</h3>
                </div>
                <div class="panel-body">
                    <?php
                        showWebsites("during_work");
                        showWebsites("administrate");
                    ?>
                    <hr/>
                    <a href="websitesAdd.php"><button class="btn btn-success"><i class="fa fa-plus"></i> Dodaj nową</button></a>
                </div>
            </div>
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#websites_finished"><i class="fa fa-globe"></i> Lista ukończonych stron</a>
                    </h4>
                    </div>
                    <div id="websites_finished" class="panel-collapse collapse">
                    <div class="panel-body">
                        <?php
                            showInfo("Strony pokazane w tej kategorii zostały ukończone, ale administrowanie i zarządzanie tymi stronami oraz ich hostingiem zostało oddane klientowi lub strony zostały zawieszone oraz zniknęły z sieci Internet.<br>Każda strona w tej kategorii powinna posiadać załączony dokument: <b>formularz zakończenia współpracy</b>.");
                            showWebsites("finished");
                        ?>
                    </div>
                    </div>
                </div>
            </div>
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" href="#websites_dropped"><i class="fa fa-globe"></i> Lista porzuconych i anulowanych stron</a>
                    </h4>
                    </div>
                    <div id="websites_dropped" class="panel-collapse collapse">
                    <div class="panel-body">
                        <?php
                            showError("Strony w tej kategorii zostały z jakiegoś powodu porzucone zanim zdążyły ujrzeć światło dzienne.<br>Powody porzucenia są indywidualne, i powinny być opisane w szczegółach strony oraz w specjalnym załączonym dokumencie: <b>formularzu zakończenia współpracy</b>.");
                            showWebsites("dropped");
                        ?>
                    </div>
                    </div>
                </div>
            </div> 
        </div>
        
        <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-calendar"></i> Nadchodzące płatności za roczne utrzymanie strony w sieci</h3>
            </div>
            <div class="panel-body">
                <?php
                    showWebsitesUpcomingPayments();
                ?>
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