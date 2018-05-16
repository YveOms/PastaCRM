<?php
@session_start();
require_once("inc/functions.php");
if(checkUserPermissions(2) || checkUserPermissions(3)){
    $siteTitle = "Edytuj serwer";
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
                                <i class="fa fa-server"></i> <a href="servers.php">Serwery i Hosting</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> <?= $siteTitle ?>
                            </li>
                        </ol>
                    </div>
                </div>

        <!-- STRONA -->
        <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-server"></i> Dane serwera</div>
            <div class="panel-body">
            <?php
                if(@$_GET['status'] == "delete"){
                    if(deleteServer($id_u)){
                        @header("Location: servers.php");
                        exit(0);
                    }
                }
                
                if(isset($_POST['edit_server'])){
                    $server_data = [
                        "id_u" => $id_u,
                        "id_server_provider" => null,
                        "server_name" => $_POST['server_name'],
                        "server_type" => $_POST['server_type'],
                        "expires_date" => $_POST['expires_date'],
                        "comment" => $_POST['comment']
                    ];

                    if(isset($_POST['new_provider_name'])){
                        if(addProvider($_POST['new_provider_name'])){
                            $server_data['id_server_provider'] = getLastProviderId();
                        }
                    }else{
                        $server_data['id_server_provider'] = $_POST['id_server_provider'];
                    }
                    
                    editServer($server_data);
                }

                if($id_u){
                    $server_data = getServerData($id_u);
                    if($server_data != null){
                        $type_list = "";
                        for($i=0; $i<getServerTypeName(); $i++){
                            if($server_data['type'] == $i)
                                $type_list .= "<option value='$i' selected>".getServerTypeName($i)."</option>";
                            else
                                $type_list .= "<option value='$i'>".getServerTypeName($i)."</option>";
                        }
            ?>
                <form method="post">
                    <div class="form-group" id="provider_input">
                        <label>Dostawca serwera <font color="red">*</font></label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon"><i class="fa fa-fw fa-address-card"></i></div>
                            <select class="selectpicker form-control" name="id_server_provider" data-live-search="true">
                                <option value="">- - -</option>
                                <?php
                                    showProvidersDopdown($server_data['id_server_provider']);
                                ?>
                            </select>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" onclick="showAddNewProviderForm('provider_input')"><i class="fa fa-fw fa-plus"></i> Dodaj nowego dostawcę</button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nazwa serwera: <font color="red">*</font></label>
                        <input type="text" class="form-control" name="server_name" value="<?= $server_data['name']; ?>" minlength="4" maxlength="100" onkeyup="checkInputLength(this, 4, 100, true)" required />
                    </div>
                    <div class="form-group">
                        <label>Typ usługi: <font color="red">*</font></label>
                        <select class="form-control" name="server_type">
                            <?= $type_list ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Data wygaśnięcia: <font color="red">*</font></label>
                        <input type="date" class="form-control" name="expires_date" maxlength="10" value="<?= $server_data['expires_date']; ?>" required />
                    </div>
                    <div class="form-group">
                        <label>Opis:</label>
                        <textarea class="form-control" name="comment" maxlength="255"><?= $server_data['comment']; ?></textarea>
                        <font color="grey">
                            Dostępne znaczniki BB-Code: [hr], [b], [i], [u], [s], [center], [code], [color=red], [img] <i>link</i> [/img], [a] <i>link</i> [/a]
                        </font>
                    </div>
                    <br/>
                    <a href="servers.php" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Wróć</a>
                    <button type="submit" class="btn btn-success" name="edit_server"><i class="fa fa-save"></i> Zapisz</button>
                    
                    <a href="?id_u=<?= $server_data['id_unique'] ?>&status=delete" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> Usuń serwer</a>
                </form>

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
                        <b>Co oznaczają poszczególne pola?</b>
                    </p>
                    <hr>
                    <p>
                        <b>Dostawca serwera</b>
                        <br>Firma zapewniająca VPS lub hosting, np. ProSerwer lub Home.pl
                    </p>
                    <p>
                        <b>Nazwa serwera</b>
                        <br>Nazwa własna dla serwera, np. 'Serwer #1' lub 'Główny Serwer Produkcyjny'
                    </p>
                    <p>
                        <b>Typ usługi</b>
                        <br>Typ usługi: dedykowany serwer lub hosting.
                    </p>
                    <p>
                        <b>Data wygaśnięcia</b>
                        <br>Data, do kiedy opłacone zostało użytkowane usługi.
                    </p>
                    <p>
                        <b>Opis</b>
                        <br>Dodatkowy komentarz do serwera, opis przeznaczenia, np. "Serwer do trzymania kopii zapasowych" lub "Serwer zarządzany przez firmę XYZ".
                    </p>
                </div>
            </div>
        </div>
        <?php
            }else{
                showError("Wygląda na to, że serwer o podanym identyfikatorze nie istnieje!");
            }
        }else{
            showError("Wygląda na to, że identyfikator serwera jest nieprawidłowy!");
        }
        ?>
        <!-- KONIEC STRONY -->

        </div>
        </div>
    </div>
</body>
</html>
<?php } ?>