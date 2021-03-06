<?php
/**
 * Plik zawierajacy podstawowy widok zestawienia transakcji wraz ze statystykami finansowymi.
 * 
 * @category Components
 * @package  PastaCRM
 * @author   Patryk Szulc <patryk-szulc@outlook.com>
 * @license  CC BY-NC-ND 4.0 https://creativecommons.org/licenses/by-nc-nd/4.0/
 * @link     https://github.com/psc1997/PastaCRM
 */
@session_start();
require_once "inc/functions.php";
if (checkUserPermissions(3)) {
    $siteTitle = "Transakcje i Finanse";
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo getSiteTitle($siteTitle) ?></title>
    <?php include_once "inc/head.php"; ?>
</head>
<body>
    <div id="wrapper">
        <?php include_once "inc/menu.php"; ?>
        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- HEADER -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?php echo $siteTitle ?>
                            <small>How I made money?</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-money"></i> <?php echo $siteTitle ?>
                            </li>
                        </ol>
                    </div>
                </div>
                
                <!-- STRONA -->
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Historia wszystkich transakcji</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <?php
                                        showTransactions(500);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-5">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> <i class="fa fa-bar-chart fa-fw"></i> Miesięczne podsumowanie finansowe</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <?php
                                        showMonthlyPaymentsChart();
                                    ?>
                                </div>
                            </div>
                        </div>
                    
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> <i class="fa fa-pie-chart fa-fw"></i> Roczne zestawienie źródeł przychodów</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <?php
                                        showPaymentsPieChart();
                                    ?>
                                </div>
                            </div>
                        </div>
                    
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> <i class="fa fa-line-chart fa-fw"></i> Coroczne zestawienie finansów</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <?php
                                        showYearlyPaymentsChart();
                                    ?>
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