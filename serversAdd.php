<?php
/**
 * Plik zawierajacy widok dodawania serwera.
 * 
 * @category Components
 * @package  PastaCRM
 * @author   Patryk Szulc <patryk-szulc@outlook.com>
 * @license  CC BY-NC-ND 4.0 https://creativecommons.org/licenses/by-nc-nd/4.0/
 * @link     https://github.com/psc1997/PastaCRM
 */
@session_start();
require_once "inc/functions.php";
if (checkUserPermissions(2) || checkUserPermissions(3)) {
    $siteTitle = "Dodaj nowy serwer";
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
                            <small>For more files and databases!</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-server"></i>  <a href="servers.php">Serwery i Hosting</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-plus-square"></i> <?php echo $siteTitle ?>
                            </li>
                        </ol>
                    </div>
                </div>
                
                <!-- STRONA -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-plus"></i> Formularz dodawania nowego serwera</div>
                            <div class="panel-body">
                                <?php
                                if (isset($_POST['add_server'])) {
                                    $server_data = [
                                        "id_server_provider" => null,
                                        "server_name" => $_POST['server_name'],
                                        "expires_date" => $_POST['expires_date'],
                                        "type" => $_POST['type'],
                                        "comment" => $_POST['comment']
                                    ];

                                    if (isset($_POST['new_provider_name'])) {
                                        if (addProvider($_POST['new_provider_name'])) {
                                            $server_data['id_server_provider'] = getLastProviderId();
                                        }
                                    } else {
                                        $server_data['id_server_provider'] = $_POST['id_server_provider'];
                                    }
                                    
                                    addServer($server_data);
                                }

                                $type_list = "";
                                for ($i=0; $i<getServerTypeName(); $i++) {
                                    $type_list .= "<option value='$i'>".getServerTypeName($i)."</option>";
                                }
                                ?>
                                <form method="POST">
                                <div class="form-group" id="provider_input">
                                        <label>Dostawca serwera <font color="red">*</font></label>
                                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                            <div class="input-group-addon"><i class="fa fa-fw fa-address-card"></i></div>
                                            <select class="selectpicker form-control" name="id_server_provider" data-live-search="true">
                                                <option value="">- - -</option>
                                                <?php
                                                    showProvidersDopdown();
                                                ?>
                                            </select>
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick="showAddNewProviderForm('provider_input')"><i class="fa fa-fw fa-plus"></i> Dodaj nowego dostawcę</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Nazwa serwera: <font color="red">*</font></label>
                                        <input type="text" class="form-control" name="server_name" minlength="4" maxlength="100" onkeyup="checkInputLength(this, 4, 100, true)" required />
                                    </div>
                                    <div class="form-group">
                                        <label>Typ usługi: <font color="red">*</font></label>
                                        <select class="form-control" name="type">
                                            <option value="x">- - - - -</option>
                                            <?php echo $type_list ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Data wygaśnięcia: <font color="red">*</font></label>
                                        <input type="date" class="form-control" name="expires_date" maxlength="10" required autocomplete="off" placeholder="YYYY-MM-DD" />
                                    </div>
                                    <div class="form-group">
                                        <label>Opis:</label>
                                        <textarea class="form-control" name="comment" maxlength="255"></textarea>
                                        <font color="grey">
                                            Dostępne znaczniki BB-Code: [hr], [b], [i], [u], [s], [center], [code], [color=red], [img] <i>link</i> [/img], [a] <i>link</i> [/a]
                                        </font>
                                    </div>
                                    <a href="servers.php" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Wróć</a>
                                    <button type="submit" class="btn btn-success" name="add_server"><i class="fa fa-plus"></i> Dodaj nowy serwer</button>
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
                </div>
                <!-- KONIEC STRONY -->

        </div>
        </div>
    </div>
</body>
</html>
<?php } ?>