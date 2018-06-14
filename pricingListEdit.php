<?php
/**
 * Plik zawierajacy widok edycji cennika.
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
    $siteTitle = "Edycja Cennika";
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
                            <li>
                                <i class="fa fa-dollar"></i>  <a href="pricingList.php">Cennik</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> <?php echo $siteTitle ?>
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
                            <div id="display_alert"></div>
                                <?php
                                if (isset($_GET['delete'])) {
                                    deletePricingList($_GET['delete']);
                                }

                                if (isset($_POST['edit_pricing_list'])) {
                                    $service_name = $_POST['service_name'];
                                    $service_description = $_POST['service_description'];
                                    $service_price = $_POST['service_price'];
                                    editPricingList($service_name, $service_description, $service_price);
                                }

                                if (isset($_GET['add_new_pricing_list'])) {
                                    $pricing_data = [
                                        "name" => $_GET['new_service_name'],
                                        "description" => $_GET['new_service_description'],
                                        "price" => $_GET['new_service_price'],
                                        "category" => $_GET['new_service_category']
                                    ];
                                    addPricingList($pricing_data);
                                }
                                ?>
                                <form method="POST">
                                    <?php
                                        showPricingList(true);
                                    ?>
                                    <a href="pricingList.php" class="btn btn-primary"><i class="fa fa-fw fa-arrow-left"></i> Wróć</a>
                                    <button class="btn btn-success" name="edit_pricing_list" type="submit"><i class="fa fa-fw fa-save"></i> Zapisz</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-life-ring"></i> Pomoc</div>
                            <div class="panel-body">
                                <div id="addNewServiceForm" style="display: none">
                                    <form method="GET">
                                        <div class="form-group">
                                            <label>Nazwa usługi <font color="red">*</font></label>
                                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                                <div class="input-group-addon"><i class="fa fa-fw fa-cube"></i></div>
                                                <input type="text" class="form-control" name="new_service_name" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Opis usługi</label>
                                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                                <div class="input-group-addon"><i class="fa fa-fw fa-info-circle"></i></div>
                                                <input type="text" class="form-control" name="new_service_description" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Cena netto <font color="red">*</font></label>
                                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                                <div class="input-group-addon"><i class="fa fa-fw fa-money"></i></div>
                                                <input type="text" class="form-control" name="new_service_price" placeholder="Kwota, np. '50' lub zakres cenowy z myślnikiem, np. '20 - 80'" autocomplete="off" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Kategoria <font color="red">*</font></label>
                                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                                <div class="input-group-addon"><i class="fa fa-fw fa-hashtag"></i></div>
                                                <select class="form-control" name="new_service_category" required>
                                                    <?php
                                                        $categories = getPricingListTypesList();
                                                        for ($i=0; $i<sizeof($categories); $i++)
                                                            echo "<option value='".($i+1)."'>".$categories[$i]."</option>";
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <button class="btn btn-success full-width" type="submit" name="add_new_pricing_list"><i class="fa fa-plus"></i> Dodaj</button>
                                    </form>
                                </div>
                                <button class="btn btn-success full-width" id="show_new_service_button" onclick="showAddNewService('addNewServiceForm')"><i class="fa fa-fw fa-plus"></i> Dodaj nową usługę do cennika</button>
                                <hr>
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