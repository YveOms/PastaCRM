<?php
/**
 * Plik zawierajacy podstawowy widok cennika.
 * 
 * @category Components
 * @package  PastaCRM
 * @author   Patryk Szulc <patryk-szulc@outlook.com>
 * @license  CC BY-NC-ND 4.0 https://creativecommons.org/licenses/by-nc-nd/4.0/
 * @link     https://github.com/psc1997/PastaCRM
 */
@session_start();
require_once "inc/functions.php";
if (checkUserPermissions(1) || checkUserPermissions(2) ||checkUserPermissions(3)) {
    $siteTitle = "Cennik";
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
                            <small>"Money, it's a gas. Grab that cash with both hands and make a stash."</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-dollar"></i> <?php echo $siteTitle ?>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                
                <!-- MAIN CONTENT -->
                <div class="row">
                    <div class="col-md-8">
                         <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-money"></i> Cennik</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                        <div class="input-group-addon"><i class="fa fa-fw fa-search"></i></div>
                                        <input type="text" class="form-control" id="pricinglist_search_input" placeholder="Szukaj usługi..." onkeyup="searchInsideTable('pricinglist_search_input', 'pricing_table', 0)">
                                    </div>
                                </div>
                                <?php
                                    showPricingList(false);
                                ?>
                                <a href="pricingListEdit.php" class="btn btn-primary"><i class="fa fa-fw fa-edit"></i> Edytuj Cennik</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-life-ring"></i> Pomoc</div>
                            <div class="panel-body">
                                <a href="downloads/PricesBase_PastaMedia.xlsx" class="btn btn-primary full-width">Pobierz plik Excel ze źródłami cen</a>
                                <hr>
                                <div class="alert alert-info">
                                    Podane ceny <b>nie zawierają kosztów podzespołów</b> (w przypadku kosztów serwisowania sprzętu).
                                    <br/>Podane ceny są cenami <b>netto</b> oraz <b>brutto</b>.
                                </div>
                                <hr>
                                <p>
                                    <b>Co znajdę w tym panelu?</b>
                                    <br>Znajdziesz tutaj cennik oparty na cennikach innych firm świadczących podobne usługi, na podobnym poziomie zaawansowania. Zestawienie cenników innych firm znajduje się w pliku Excel dostępnym do pobrania powyżej.
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