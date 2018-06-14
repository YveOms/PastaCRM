<?php
/**
 * Plik zawierajacy podstawowy widok serwerow.
 * 
 * @category Components
 * @package  PastaCRM
 * @author   Patryk Szulc <patryk-szulc@outlook.com>
 * @license  CC BY-NC-ND 4.0 https://creativecommons.org/licenses/by-nc-nd/4.0/
 * @link     https://github.com/psc1997/PastaCRM
 */
@session_start();
require_once "inc/functions.php";
if (checkUserPermissions(2) || checkUserPermissions(3)) {
    $siteTitle = "Serwery i Hosting";
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
                            <small>A powerfull places for files and databases!</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-server"></i> <?php echo $siteTitle ?>
                            </li>
                        </ol>
                    </div>
                </div>

                <!-- STRONA -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-server"></i> Lista serwerów i hostingów</div>
                            <div class="panel-body">
                                <?php
                                    showServers();
                                ?>
                                <a href="serversAdd.php" class="btn btn-success"><i class="fa fa-plus"></i> Dodaj nowy serwer</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-life-ring"></i> Pomoc</div>
                            <div class="panel-body">
                                <div class="alert alert-info">
                                    Podgląd stron utrzymywanych na danym serwerze <b>pokazuje tylko aktualnie administrowane strony</b>.
                                    <br>Strony w trakcie produkcji, ukończone (nie administrowane) oraz porzucone nie są wyświetlane.
                                </div>
                                <hr>
                                <p>
                                    <b>Co zawiera lista?</b>
                                    <br>Lista zawiera serwery i hostingi, wraz z osadzonymi na nich stronami.
                                    <br>Pozycje posortowane są po dacie wygaśnięcia, od najbliższej do najpóźniejszej.
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