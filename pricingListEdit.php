<?php
@session_start();
require_once("inc/functions.php");
if(checkUserPermissions(3)){
    $siteTitle = "Edycja Cennika";
    @$id_u = $_GET['id_u'];
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
                            <small>"Money, it's a gas. Grab that cash with both hands and make a stash."</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-dollar"></i>  <a href="pricingList.php">Cennik</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> <?= $siteTitle ?>
                            </li>
                        </ol>
                    </div>
                </div>

                <!-- STRONA -->
                <div class="row">
                    <div class="col-md-8">
                         <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-money"></i> Edytor Cennika</div>
                            <div class="panel-body">
                                <?php
                                    showPricingList(true);
                                ?>
                                <a href="pricingList.php" class="btn btn-primary"><i class="fa fa-fw fa-arrow-left"></i> Wróć</a>
                                <button class="btn btn-success" disabled><i class="fa fa-fw fa-save"></i> Zapisz</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-life-ring"></i> Pomoc</div>
                            <div class="panel-body">
                                <p>
                                    <b>Co mogę robić w tym panelu?</b>
                                    <br>Możesz tutaj edytować ceny dla wszystkich usług, a także dodawać oraz usuwać wybrane usługi.
                                </p>
                                <p>
                                	<b>Do czego służy opis danej usługi?</b>
                                	<br>W opisie możesz zawrzeć informacje o dodatkowych warunkach:
                                	<br>np. <i>w przypadku odzyskiwania danych klient nie płaci, jeśli po ekspertyzie okazuje się, że danych nie da się odzyskać</i>
                                	<br>lub też konkretne warunki danej usługi:
                                	<br>np. <i>opieka techniczna "gold" nad stroną oznacza czas reakcji do 48h, natomiast opieka techniczna "bronze" to czas reakcji do 3 dni roboczych</i>.
                                </p>
                                <p>
                                	<b>Zasada tworzenia dobrego tytułu usługi</b>
                                	<br>Dobry tytuł musi jasno opisywać daną usługę. Każdy tytuł można wyjaśnić i doprecyzować w opisie umieszczonym zaraz pod nim.
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