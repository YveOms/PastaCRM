<?php
/**
 * Plik zawierajacy podstawowy widok zgloszen serwisu komputerowego.
 * 
 * @category Components
 * @package  PastaCRM
 * @author   Patryk Szulc <patryk-szulc@outlook.com>
 * @license  CC BY-NC-ND 4.0 https://creativecommons.org/licenses/by-nc-nd/4.0/
 * @link     https://github.com/psc1997/PastaCRM
 */
@session_start();
require_once "inc/functions.php";
if (checkUserPermissions(1) || checkUserPermissions(3)) {
    $siteTitle = "Serwis Komputerowy";
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
                            <small>Software & Hardware</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-laptop"></i> <?php echo $siteTitle ?>
                            </li>
                        </ol>
                    </div>
                </div>

                <!-- STRONA -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-laptop"></i> Lista zgłoszeń
                        </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                        <div class="input-group-addon"><i class="fa fa-fw fa-search"></i></div>
                                        <input type="text" class="form-control" id="client_search_input" placeholder="Szukaj zgłoszenia po nazwisku klienta..." onkeyup="searchInsideTable('client_search_input', 'computer_service__table', 1)">
                                    </div>
                                </div>
                                <div class="table-responsive">
                                        <?php
                                            showComputerServiceList();
                                        ?>
                                    <a href="computerServiceAdd.php" class="btn btn-success">
                                        <i class="fa fa-plus"></i> Dodaj nowe zgłoszenie
                                    </a>
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
                                <img src="img/computer_service.png" class="img img-responsive" alt="Computer Service" width="100%" height="auto" />
                                <hr>
                                <p>
                                    <b>Co znajdziesz w tym panelu?</b>
                                    <br>Znajdują się tu wszystkie zgłoszenia do serwisu komputerowego posortowane po dacie podjęcia zlecenia.
                                </p>
                                <p>
                                    <b>Co oznaczają kolory zgłoszeń?</b>
                                    <br>Zgłoszenia pogrupowane są na dwie kategorie: zakończone oraz niezakończone. Te pierwsze zaznaczone są na biało, niezakończone zaś oznaczone są kolorem żółtym, i widoczne zawsze u góry listy.
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