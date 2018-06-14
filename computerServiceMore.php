<?php
/**
 * Plik zawierajacy widok sczegolow zgloszenia serwisu komputerowego.
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
    $siteTitle = "Szczegóły zlecenia";
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
                            <small></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-fw fa-laptop"></i>  <a href="computerService.php">Serwis Komputerowy</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-fw fa-laptop"></i> <?php echo $siteTitle ?>
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
                if ($id_u) {
                    $service_info = getComputerServiceData($id_u);
                    
                    if ($service_info != null) {
                        $client_data = getClientData($service_info['id_client']);

                        foreach ($service_info as $key => &$value) {
                            if ($value == "0000-00-00") {
                                $value = null;
                            }
                        }

                        if ($service_info['status'] == 1) {
                            $status = "Ukończono";
                        } else {
                            $status = "W trakcie pracy";
                        }
                ?>
                <table class='table table-striped table-bordered'>
                    <tr>
                        <th style="width: 300px"><i class='fa fa-fw fa-calendar-plus-o'></i> Data rozpoczęcia</th>
                        <td colspan=2><?php echo $service_info['date_start'] ?></td>
                    </tr>
                    <tr>
                        <th><i class='fa fa-fw fa-calendar-minus-o'></i> Data zakończenia</th>
                        <td colspan=2><?php echo $service_info['date_end'] ?></td>
                    </tr>
                    <tr>
                        <th><i class='fa fa-fw fa-user'></i> Klient</th>
                        <td colspan=2><a href="clientsMore.php?id_u=<?php echo $client_data['id_unique'] ?>"><?php echo $client_data['first_name'] ?> <?php echo $client_data['second_name'] ?></a></td>
                    </tr>
                    <tr>
                        <th><i class='fa fa-fw fa-phone'></i> Kontakt</th>
                        <td><?php echo $client_data['phone'] ?></td>
                        <td><?php echo $client_data['email'] ?></td>
                    </tr>
                    <tr>
                        <th><i class='fa fa-fw fa-thumb-tack'></i> Status</th>
                        <td colspan=2><?php echo $status ?></td>
                    </tr>
                    <tr>
                        <th><i class='fa fa-fw fa-laptop'></i> Urządzenie</th>
                        <td colspan=2><?php echo $service_info['device'] ?></td>
                    </tr>
                    <tr>
                        <th colspan=3><i class='fa fa-fw fa-info-circle'></i> Opis zlecenia</th>
                    </tr>
                    <tr>
                        <td colspan=3><?php echo bbCode(nl2br($service_info['comment'])) ?></td>
                    </tr>
                </table>
                <a href="computerService.php" class="btn btn-primary">
                    <i class="fa fa-arrow-left"></i> Wróć
                </a>
                <a href="computerServiceEdit.php?id_u=<?php echo $id_u ?>" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Edytuj zgłoszenie
                </a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <?php
                if (file_exists("uploads/img/computer_service/".$id_u."/photo.jpg"))
                    echo "<div class='panel panel-default'>
                            <div class='panel-heading'>
                                <h3 class='panel-title'><i class='fa fa-photo'></i> Zdjęcie</h3>
                            </div>
                            <div class='panel-body'>
                                <img src='uploads/img/computer_service/".$id_u."/photo.jpg' class='img-thumbnail' style='max-height: 400px;' />
                            </div>
                        </div>";
            ?>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-file"></i> Dokumenty</h3>
                </div>
                <div class="panel-body">
                    <?php
                        showFiles("uploads/doc/computer_service/".$id_u);
                    ?>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-money"></i> Płatności</h3>
                </div>
                <div class="panel-body">
                <ul class="list-group">
                <?php
                    showConnectedPayments("computer_service", $service_info['id']);
                ?>
                </ul>
                </div>
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
                <!-- KONIEC STRONY -->
            </div>
        </div>
    </div>
</body>
</html>
<?php } ?>