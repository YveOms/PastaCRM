<?php
@session_start();
require_once("inc/functions.php");
if(checkUserPermissions(1) || checkUserPermissions(2) || checkUserPermissions(3)){
    $siteTitle = "Szczegóły klienta";
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
                            <small></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i> <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-fw fa-users"></i> <a href="clients.php">Klienci</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-fw fa-user"></i> <?= $siteTitle ?>
                            </li>
                        </ol>
                    </div>
                </div>

        <!-- STRONA -->
        <div class="col-lg-6">
            <div class="panel panel-default">
            <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-user"></i> Dane klienta</h3>
                </div>
                <div class="panel-body">
                    <?php
                        if($id_u){
                            $client_data = getClientData($id_u);
                            if($client_data){
                                foreach ($client_data as $key => &$value) {
                                    if($key == "MAX_CZAS_SERWISOWANIA" && $value == null)
                                        $value = 0;
                                }
                    ?>
                    <table class='table table-striped table-bordered'>
                        <tr>
                            <th style="width: 300px"><i class='fa fa-fw fa-user'></i> Imię i nazwisko</th>
                            <td><?= $client_data['first_name'] ?> <?= $client_data['second_name'] ?></td>
                        </tr>
                        <tr>
                            <th><i class='fa fa-fw fa-phone'></i> Telefon kontaktowy</th>
                            <td><a href="tel:<?= $client_data['phone'] ?>"><?= $client_data['phone'] ?></a></td>
                        </tr>
                        <tr>
                            <th><i class='fa fa-fw fa-at'></i> Adres email</th>
                            <td><a href="mailto:<?= $client_data['email'] ?>"><?= $client_data['email'] ?></a></td>
                        </tr>
                        <tr>
                            <th><i class='fa fa-fw fa-home'></i> Adres zamieszkania</th>
                            <td><?= $client_data['address'] ?></td>
                        </tr>
                        <tr>
                            <th colspan=2><i class='fa fa-fw fa-info'></i> Dodatkowe informacje</th>
                        </tr>
                        <tr>
                            <td colspan=2><?= bbCode(nl2br($client_data['comment'])) ?></td>
                        </tr>
                    </table>
                    <a href="clients.php" class="btn btn-primary">
                        <i class="fa fa-arrow-left"></i> Wróć
                    </a>
                    <a href="clientsEdit.php?id_u=<?= $id_u ?>" class="btn btn-primary">
                        <i class="fa fa-edit"></i> Edytuj dane klienta
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-area-chart"></i> Statystyki klienta</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th style='width: 70%'>Ilość zgłoszeń do serwisu komputerowego</th>
                            <td class="text-right"><?= $client_data['ILOSC_ZGLOSZEN'] ?></td>
                        </tr>
                        <tr>
                            <th>Najdłuższy okres serwisowania sprzętu</th>
                            <td class="text-right"><?= $client_data['MAX_CZAS_SERWISOWANIA'] ?> dni</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-laptop"></i> Ostatnie 10 zgłoszeń serwisowych</h3>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        <?php
                            showClientServiceRequests($client_data['id'], 10);
                        ?>
                    </ul>
                </div>
            </div>

        </div>

        <?php
            }else{
                showError("Wygląda na to, że klient o podanym identyfikatorze nie istnieje!");
            }
        }else{
            showError("Wygląda na to, że identyfikator klienta jest nieprawidłowy!");
        }
        ?>
                <!-- KONIEC STRONY -->
            </div>
        </div>
    </div>
</body>
</html>
<?php } ?>