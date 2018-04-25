<?php
@session_start();
require_once("inc/functions.php");
if(checkUserPermissions(1) || checkUserPermissions(2) || checkUserPermissions(3)){
    $siteTitle = "Klienci";
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
                            <small></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-users"></i> <?= $siteTitle ?>
                            </li>
                        </ol>
                    </div>
                </div>

                <!-- STRONA -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-users"></i> Lista klientów
                        </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                        <div class="input-group-addon"><i class="fa fa-fw fa-search"></i></div>
                                        <input type="text" class="form-control" id="client_search_input" placeholder="Szukaj klienta po nazwisku..." onkeyup="searchInsideTable('client_search_input', 'clients_table', 1)">
                                    </div>
                                </div>
                                <hr>
                                <div class="table-responsive">
                                        <?php
                                            showClientsList();
                                        ?>
                                    <a href="clientsAdd.php" class="btn btn-success">
                                        <i class="fa fa-user-plus"></i> Dodaj nowego klienta
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
                                <p>
                                    <b>Co znajdziesz w tym panelu?</b>
                                    <br>Znajduje się tu lista wszystkich klientów, zarówno klientów serwisu jak i osób kontaktowych w stronach internetowych.
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