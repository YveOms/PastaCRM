
<?php
@session_start();
require_once("inc/functions.php");
if(checkUserPermissions(1) || checkUserPermissions(3)){
    $siteTitle = "Dodaj nowe zgłoszenie";
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
                            <small>Kolejny sukces!</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-laptop"></i>  <a href="computerService.php">Serwis Komputerowy</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-plus-square"></i> <?= $siteTitle ?>
                            </li>
                        </ol>
                    </div>
                </div>
                
                <!-- STRONA -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-laptop"></i> Formularz otrzymania zgłoszenia</div>
                            <div class="panel-body">
                                <?php
                                    if(isset($_POST['add_service'])){
                                        $service_data = [
                                            "date_start" => $_POST['date_start'],
                                            "id_client" => @$_POST['id_client'],
                                            "device" => $_POST['device'],
                                            "comment" => $_POST['comment']
                                        ];

                                        if(isset($_POST['client_first_name']) && isset($_POST['client_second_name'])){
                                            $client_data = [
                                                "first_name" => $_POST['client_first_name'],
                                                "second_name" => $_POST['client_second_name'],
                                                "phone" => $_POST['client_phone'],
                                                "email" => $_POST['client_mail']
                                            ];
                                            if(addClient($client_data)){
                                                $service_data['id_client'] = getLastClientId();
                                            }
                                        }else{
                                            $service_data['id_client'] = getClientId($service_data['id_client']);
                                        }
                                        
                                        addComputerService($service_data);
                                    }
                                ?>
                                <form method="post">
                                    <div class="form-group">
                                        <label>Data rozpoczęcia <font color="red">*</font></label>
                                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                            <div class="input-group-addon"><i class="fa fa-fw fa-calendar-plus-o"></i></div>
                                            <input type="date" class="form-control" name="date_start" autocomplete="off" required>
                                        </div>
                                    </div>

                                    <div class="form-group" id="client_input">
                                        <label>Klient <font color="red">*</font></label>
                                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                            <div class="input-group-addon"><i class="fa fa-fw fa-user"></i></div>
                                            <select class="selectpicker form-control" name="id_client" data-live-search="true">
                                                <option value="">- - -</option>
                                                <?php
                                                    showClientsDropdown();
                                                ?>
                                            </select>
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick="showAddNewClientForm('client_input')"><i class="fa fa-fw fa-user-plus"></i> Dodaj nowego klienta</button>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Urządzenie <font color="red">*</font></label>
                                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                            <div class="input-group-addon"><i class="fa fa-fw fa-laptop"></i></div>
                                            <input type="text" class="form-control" name="device" autocomplete="on" minlength="4" maxlength="100" onkeyup="checkInputLength(this, 4, 100)" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Opis zlecenia</label>
                                        <button class="btn btn-xs btn-primary" type="button" onclick="setComputerServiceTemplate('comment')">Wstaw szablon</button>
                                        <textarea name="comment" id="comment" class="form-control" rows="8"></textarea>
                                    </div>

                                    <a href="computerService.php" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Wróć</a>
                                    <button type="submit" class="btn btn-success" name="add_service"><i class="fa fa-plus"></i> Dodaj nowe zgłoszenie</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-life-ring"></i> Pomoc</div>
                            <div class="panel-body">
                                <p>
                                    <b>Co oznaczają poszczególne pola?</b>
                                </p>
                                <p>
                                    <b>Data rozpoczęcia</b>
                                    <br>Data podjęcia zgłoszenia.
                                </p>
                                <p>
                                    <b>Klient</b>
                                    <br>Imię i nazwisko osoby zgłaszającej.<br>W przypadku klienta, który został już zarejestrowany w bazie, system pobierze jego dane automatycznie.<br>W przypadku nowego klienta, należy dodać go przez wciśnięcie przycisku <label class="label label-default"><i class="fa fa-fw fa-user-plus"></i> Dodaj nowego klienta</label>
                                </p>
                                <p>
                                    <b>Urządzenie</b>
                                    <br>Marka oraz model urządzenia, opcjonalnie typ, np. "telefon Xiaomi Mi4" lub "HP Pavilion dv6".
                                </p>
                                <p>
                                    <b>Dodatkowy komentarz</b>
                                    <br>Opis zgłoszonej usterki. Aby wstawić gotowy schemat opisu, wciśnij przycisk "Wstaw szablon".
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