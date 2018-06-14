<?php
/**
 * Plik zawierajacy widok edycji zgloszenia serwisu komputerowego.
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
    $siteTitle = "Edycja zgłoszenia";
    @$id_u = $_GET['id_u'];
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
                            <small>Just change some things</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i> <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-fw fa-laptop"></i> <a href="computerService.php">Serwis Komputerowy</a>
                            </li>
                            <li>
                                <i class="fa fa-fw fa-laptop"></i> <a href="<?php echo "computerServiceMore.php?id_u=".$id_u ?>">Szczegóły zlecenia</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-pencil-square-o"></i> <?php echo $siteTitle ?>
                            </li>
                        </ol>
                    </div>
                </div>

        <!-- STRONA -->
        <div class="col-lg-6">
            <div class="panel panel-default">
            <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-laptop"></i> Dane zgłoszenia</h3>
                </div>
                <div class="panel-body">
                    <?php
                    if (@$_GET['status'] == "deleteService")
                        deleteComputerService($id_u);

                    if (isset($_POST['edit_service'])) {
                        $service_data = [
                            "id_u" => $id_u,
                            "date_start" => $_POST['date_start'],
                            "date_end" => $_POST['date_end'],
                            "id_client" => getClientId($_POST['id_client']),
                            "status" => $_POST['status'],
                            "device" => $_POST['device'],
                            "comment" => $_POST['comment']
                        ];
                        editComputerService($service_data);
                    }

                    if ($id_u) {
                        $service_info = getComputerServiceData($id_u);
                        if ($service_info != null) {

                            $client_data = getClientData($service_info['id_client']);
                            
                            if ($service_info['status'] == 1) {
                                $status_list = "<option value='1' selected>Ukończono</option>
                                                <option value='0'>W trakcie pracy</option>";
                            } else {
                                $status_list = "<option value='1'>Ukończono</option>
                                                <option value='0' selected>W trakcie pracy</option>";
                            }
                        ?>
                    <form method="post">
                    <table class="table table-striped table-bordered">
                    <tr>
                        <th style="width: 190px"><i class="fa fa-fw fa-calendar"></i> Data rozpoczęcia</th>
                        <td>
                            <input type="date" class="form-control" name="date_start" id="date_start" value="<?php echo $service_info['date_start'] ?>" autocomplete="off" required>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-fw fa-calendar"></i> Data zakończenia</th>
                        <td>
                            <input type="date" class="form-control" name="date_end" id="date_end" value="<?php echo $service_info['date_end'] ?>" autocomplete="off">
                        </td>
                    </tr>
                    <tr>
                        <th> <i class="fa fa-fw fa-user"></i>Klient</th>
                        <td>
                            <select class="selectpicker form-control" name="id_client" data-live-search="true">
                                <option value="">- - -</option>
                                <?php
                                    showClientsDropdown($client_data['id_unique']);
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-fw fa-phone"></i> Kontakt</th>
                        <td>
                            <input type="text" class="form-control" name="contact" value="[ Uzupełniane automatycznie przez system ]" disabled>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-fw fa-thumb-tack"></i> Status</th>
                        <td>
                            <select name="status" class="selectpicker">
                                <?php echo $status_list ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="fa fa-fw fa-laptop"></i> Urządzenie</th>
                        <td>
                            <input type="text" class="form-control" name="device" value="<?php echo $service_info['device'] ?>" minlength="4" maxlength="100" onkeyup="checkInputLength(this, 4, 100, true)" required>
                        </td>
                    </tr>
                    <tr>
                        <th colspan=2><i class="fa fa-fw fa-info-circle"></i> Opis zlecenia</th>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <textarea class="form-control" name="comment" placeholder="Opis wykonanych czynności" rows="10"><?php echo $service_info['comment'] ?></textarea>
                            <font color="grey">
                                Dostępne znaczniki BB-Code: [hr], [b], [i], [u], [s], [center], [code], [color=red], [img] <i>link</i> [/img], [a] <i>link</i> [/a]
                            </font>
                        </td>
                    </tr>
                </table>
                <a href="computerServiceMore.php?id_u=<?php echo $id_u ?>" class="btn btn-primary">
                    <i class="fa fa-arrow-left"></i> Wróć
                </a>
                <button type="submit" class="btn btn-success" name="edit_service"><i class="fa fa-save"></i> Zapisz</button>
                <a href="computerServiceEdit.php?id_u=<?php echo $id_u ?>&status=deleteService">
                    <button type="button" class="btn btn-danger pull-right" onclick="return confirm('Jesteś pewien, że chcesz USUNĄĆ to zlecenie?')"><i class="fa fa-trash"></i></button>
                </a>

            </form>
        </div>
    </div>
    </div>
        <div class="col-lg-6">
           
            <div class="panel panel-default">
            <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-photo"></i> Zdjęcie</h3>
                </div>
                <div class="panel-body">
                    <?php
                    if (@$_GET['status'] == "uploadPhoto") {
                        uploadFile("uploads/img/computer_service/".$id_u."/", "jpg", "photo.jpg", 1000);
                    }
                    if (@$_GET['status'] == "deletePhoto") {
                        deleteFile("uploads/img/computer_service/".$id_u."/photo.jpg");
                    }
                    if (file_exists("uploads/img/computer_service/".$id_u."/photo.jpg")) {
                    ?>
                    <form action="?id_u=<?php echo $id_u ?>&status=uploadPhoto" method="post" enctype="multipart/form-data">
                        <label class="btn btn-success" for="select_photo">
                        <input id="select_photo" type="file" style="display:none;" onchange="this.form.submit()" name="document">
                            <i class="fa fa-refresh"></i> Zmień aktualne zdjęcie
                        </label>
                    </form>
                    <a href="?id_u=<?php echo $id_u ?>&status=deletePhoto">
                        <button class='btn btn-danger' onclick="return confirm('Jesteś pewien, że chcesz usunąć aktualne zdjęcie?')"><i class='fa fa-trash'></i> Usuń aktualne zdjęcie</button>
                    </a>
                    <?php
                    } else {
                    ?>
                    <form action="?id_u=<?php echo $id_u ?>&status=uploadPhoto" method="post" enctype="multipart/form-data">
                        <label class="btn btn-success" for="select_photo">
                        <input id="select_photo" type="file" style="display:none;" onchange="this.form.submit()" name="document">
                            <i class="fa fa-upload"></i> Wyślij nowe zdjęcie
                        </label>
                    </form>
                    <?php
                    }
                    ?>
                </div>
            </div>
            
            <div class="panel panel-default">
            <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-file-pdf-o"></i> Dokumenty</h3>
                </div>
                <div class="panel-body">
                    <?php
                    if (@$_GET['status'] == "uploadFile") {
                        uploadFile("uploads/doc/computer_service/".$id_u."/", "pdf");
                    }

                    if (@$_GET['status'] == "deleteDocument") {
                        deleteFile("uploads/doc/computer_service/".$id_u."/".$_GET['name'].".pdf");
                    }

                    showFiles("uploads/doc/computer_service/".$id_u, true);
                    ?>
                    <br/>
                    <form action="?id_u=<?php echo $id_u ?>&status=uploadFile" method="post" enctype="multipart/form-data">
                        <label class="btn btn-success" for="select_document">
                        <input id="select_document" type="file" style="display:none;" onchange="this.form.submit()" name="document">
                            <i class="fa fa-upload"></i> Załącz nowy dokument
                        </label>
                    </form>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-money"></i> Płatności</h3>
                </div>
                <div class="panel-body">
                    <div id="add_payment_alert"></div>
                    <ul class="list-group" id="payments_list">
                        <?php
                        showConnectedPayments("computer_service", $service_info['id'], true);
                        ?>
                    </ul>
                    <hr>
                    <form class="form-inline">
                    <div class="form-group">
                        <input type="date" class="form-control" id="new_payment_date" autocomplete="off">
                        <div class="input-group">
                            <input type="number" step="0.01" class="form-control" id="new_payment_amount" autocomplete="off">
                            <div class="input-group-addon">zł</div>
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" id="new_payment_name">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                <li><a onclick="setPaymentName('Zapłata za serwisowanie sprzętu')">Zapłata za serwisowanie sprzętu</a></li>
                                </ul>
                            </div>
                        </div>
                        <button class="btn btn-success" type="button" onclick="addNewPayment('computer_service', '<?php echo $service_info['id'] ?>')"><i class="fa fa-plus"></i> Dodaj płatność</button>
                    </div>
                    </form>
                </div>
            </div>
        
            <?php
                        } else {
                            showError("Wygląda na to, że zlecenie o podanym identyfikatorze nie istnieje!");
                        }
                    } else {
                        showError("Wygląda na to, że identyfikator zlecenia jest nieprawidłowy!");
                    }
            ?>
            </div>
            <!-- KONIEC STRONY -->
            </div>
        </div>
    </div>
</body>
</html>
<?php } ?>