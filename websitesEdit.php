<?php
/**
 * Plik zawierajacy widok edycji strony internetowej.
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
    $siteTitle = "Edycja strony internetowej";
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
                                <i class="fa fa-globe"></i>  <a href="websites.php">Strony internetowe</a>
                            </li>
                            <li>
                                <i class="fa fa-file"></i> <a href="websitesMore.php?id_u=<?php echo $id_u ?>">Szczegóły strony internetowej</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> <?php echo $siteTitle ?>
                            </li>
                        </ol>
                    </div>
                </div>

    <!-- STRONA -->
    <div class="col-lg-6">

                <?php
                if ($id_u) {
                    if (isset($_POST['edit_website'])) {
                        $site_data = [
                            "id_u" => $id_u,
                            "date_created" => $_POST['date_created'],
                            "website_name" => $_POST['website_name'],
                            "website_address" => $_POST['website_address'],
                            "id_server" => $_POST['server'],
                            "id_domain_provider" => $_POST['domain_provider'],
                            "domain_expire_date" => $_POST['domain_expire_date'],
                            "id_ssl_provider" => $_POST['ssl_provider'],
                            "ssl_expire_date" => $_POST['ssl_expire_date'],
                            "payment_for_me" => $_POST['payment_for_me'],
                            "payment_for_me_date" => $_POST['payment_for_me_date'],
                            "status" => $_POST['status'],
                            "cms" => $_POST['cms'],
                            "comment" => $_POST['comment'],
                            "contact_person" => $_POST['contact_person'],
                            "contact_person2" => $_POST['contact_person2'],
                        ];
                        if ($site_data['contact_person'])
                            $site_data['contact_person'] = getClientId($site_data['contact_person']);
                        if ($site_data['contact_person2'])
                            $site_data['contact_person2'] = getClientId($site_data['contact_person2']);

                        editWebsite($site_data);
                    }

                    // Pobranie i przygotowanie danych do wyswietlenia
                    $website_data = getWebsiteData($id_u);
                    if ($website_data != null) {
                        $client_data = getClientData($website_data['id_contact_person']);
                        $server_provider = getProviderData($website_data['id_server']);
                        $domain_provider = getProviderData($website_data['id_domain_provider']);
                        $ssl_provider = getProviderData($website_data['id_ssl_provider']);
                        
                        $status_list = "";
                        $cms_list = "";
                        for ($i=0; $i<getStatusName(); $i++) {
                            if ($website_data['status'] == $i)
                                $status_list .= "<option value='$i' selected>".getStatusName($i)."</option>";
                            else
                                $status_list .= "<option value='$i'>".getStatusName($i)."</option>";
                        }
                        for ($i=0; $i<getCmsName(); $i++) {
                            if ($website_data['cms'] == $i)
                                $cms_list .= "<option value='$i' selected>".getCmsName($i)."</option>";
                            else
                                $cms_list .= "<option value='$i'>".getCmsName($i)."</option>";
                        }
                ?>
                <form method="post">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th><i class="fa fa-calendar-check-o"></i> Data utworzenia</th>
                            <td>
                                <input type="date" class="form-control" name="date_created" value="<?php echo $website_data['date_created']; ?>" autocomplete="off" />
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-underline"></i> Nazwa strony</th>
                            <td>
                                <input type="text" class="form-control" name="website_name" value="<?php echo $website_data['name']; ?>" minlength="2" maxlength="100" onkeyup="checkInputLength(this, 2, 100, true)"/>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-link"></i> Adres internetowy</th>
                            <td>
                                <input type="text" class="form-control" name="website_address" value="<?php echo $website_data['web_address']; ?>" minlength="4" maxlength="100" onkeyup="checkInputLength(this, 4, 100, true)"/>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-server"></i> Serwer</th>
                            <td>
                                <select name="server" class="selectpicker" data-width="100%">
                                <option value="">- - -</option>
                                    <?php
                                        showServersDopdown($server_provider['id']);
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-calendar-times-o"></i> Data wygaśnięcia serwera</th>
                            <td>
                            <input type="text" class="form-control" value="[ Uzupełniane automatycznie przez system ]" disabled>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-database"></i> Dostawca domeny</th>
                            <td>
                                <select class="selectpicker form-control" name="domain_provider" data-live-search="true">
                                    <option value="">- - -</option>
                                    <?php
                                        showProvidersDopdown($domain_provider['id']);
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-calendar"></i> Data wygaśnięcia domeny</th>
                            <td>
                                <input type="date" class="form-control" name="domain_expire_date" id="domain_expire_date" value="<?php echo $website_data['domain_expire_date']; ?>" autocomplete="off" />
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-lock"></i> Dostawca certyfikatu SSL</th>
                            <td>
                                <select class="selectpicker form-control" name="ssl_provider" data-live-search="true">
                                    <option value="">- - -</option>
                                    <?php
                                        showProvidersDopdown($ssl_provider['id']);
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-calendar"></i> Data wygaśnięcia cert. SSL</th>
                            <td>
                                <input type="date" class="form-control" name="ssl_expire_date" value="<?php echo $website_data['ssl_expire_date']; ?>" autocomplete="off" />
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-money"></i> Roczna płatność</th>
                            <td>
                                <div class="input-group">
                                    <input type="number" step="0.01" class="form-control" name="payment_for_me" value="<?php echo $website_data['payment_for_me']; ?>" id="payment_for_me" autocomplete="off" />
                                    <div class="input-group-addon">zł</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-calendar"></i> Data najbliższej płatności</th>
                            <td>
                                <input type="date" class="form-control" name="payment_for_me_date" value="<?php echo $website_data['payment_for_me_date']; ?>" autocomplete="off" />
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-cogs"></i> Status</th>
                            <td>
                                <select name="status" class="selectpicker" data-width="100%">
                                    <?php echo $status_list; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-wordpress"></i> CMS</th>
                            <td>
                                <select name="cms" class="selectpicker" data-width="100%">
                                    <?php echo $cms_list; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2"><i class="fa fa-info-circle"></i> Dodatkowy komentarz</th>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea class="form-control" name="comment" rows="6" style="resize: none;"><?php echo $website_data['comment']; ?></textarea>
                                <font color="grey">
                                    Dostępne znaczniki BB-Code: [hr], [b], [i], [u], [s], [center], [code], [color=red], [img] <i>link</i> [/img], [a] <i>link</i> [/a]
                                </font>
                            </td>
                        </tr>
                    </table>
                    
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th colspan="2"><i class="fa fa-square"></i> Osoba kontaktowa</th>
                        </tr>
                        <tr>
                            <th style="width: 35%;"><i class="fa fa-fw fa-user"></i> Imię i nazwisko</th>
                            <td>
                                <select class="selectpicker form-control" name="contact_person" data-live-search="true">
                                    <option value="">- - -</option>
                                    <?php
                                        showClientsDropdown($client_data['id_unique']);
                                    ?>
                                </select>
                            </td>
                        </tr>
                    </table>

                    <table class="table table-bordered table-striped">
                        <tr>
                            <th colspan="2"><i class="fa fa-square"></i> Dodatkowa osoba kontaktowa</th>
                        </tr>
                        <tr>
                            <th style="width: 35%;"><i class="fa fa-fw fa-user"></i> Imię i nazwisko</th>
                            <td>
                                <select class="selectpicker form-control" name="contact_person2" data-live-search="true">
                                    <option value="">- - -</option>
                                    <?php
                                    $client_data = getClientData($website_data['id_contact_person2']);
                                    if ($website_data['id_contact_person2']) {
                                        showClientsDropdown($client_data['id_unique']);
                                    } else {
                                        showClientsDropdown();
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                
            <a href="websitesMore.php?id_u=<?php echo $id_u ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Wróć</a>
            <button type="submit" name="edit_website" class="btn btn-success"><i class="fa fa-save"></i> Zapisz</button>
        </form>
    </div>

    <div class="col-lg-6">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-photo"></i> Ikona strony internetowej</h3>
                </div>
                <div class="panel-body">
                    <?php
                    if (@$_GET['status'] == "uploadIcon") {
                        uploadFile("uploads/img/websites/".$id_u."/", "png", "icon.png");
                    }
                    if (@$_GET['status'] == "deleteIcon") {
                        deleteFile("uploads/img/websites/".$id_u."/icon.png");
                    }

                    if (file_exists("uploads/img/websites/".$id_u."/icon.png")) {
                    ?>
                        <form action="?id_u=<?php echo $id_u ?>&status=uploadIcon" method="post" enctype="multipart/form-data">
                            <label class="btn btn-success" for="select_thumbnail">
                            <input id="select_thumbnail" type="file" style="display:none;" onchange="this.form.submit()" name="document">
                                <i class="fa fa-refresh"></i> Zmień aktualną ikonę
                            </label>
                        </form>
                                  
                        <a href='?id_u=<?php echo $id_u ?>&status=deleteIcon' class='btn btn-danger' onclick="return confirm('Jesteś pewien, że chcesz USUNĄĆ aktualną ikonę?')">
                            <i class='fa fa-trash'></i> Usuń aktualną ikonę
                        </a>
                    <?php
                    } else {
                        showInfo("Brak ikony przypisanej do strony.<br>Pamiętaj, że załączana ikona musi być plikiem .png!");
                    ?>
                       <form action="?id_u=<?php echo $id_u ?>&status=uploadIcon" method="post" enctype="multipart/form-data">
                            <label class="btn btn-success" for="select_thumbnail">
                            <input id="select_thumbnail" type="file" style="display:none;" onchange="this.form.submit()" name="document">
                                <i class="fa fa-upload"></i> Wyślij nową ikonę
                            </label>
                        </form>
                    <?php
                    }
                    ?>
                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-photo"></i> Podgląd wyglądu strony</h3>
                </div>
                <div class="panel-body">
                    <?php
                    if (@$_GET['status'] == "uploadPhoto") {
                        uploadFile("uploads/img/websites/".$id_u."/", "png", "website.png");
                    }

                    if (@$_GET['status'] == "deletePhoto") {
                        deleteFile("uploads/img/websites/".$id_u."/website.png");
                    }
                    
                    if (file_exists("uploads/img/websites/".$id_u."/website.png")) {
                    ?>
                        <form action="?id_u=<?php echo $id_u ?>&status=uploadPhoto" method="post" enctype="multipart/form-data">
                            <label class="btn btn-success" for="select_photo">
                            <input id="select_photo" type="file" style="display:none;" onchange="this.form.submit()" name="document">
                                <i class="fa fa-refresh"></i> Zmień aktualne zdjęcie
                            </label>
                        </form>

                        <a href='?id_u=<?php echo $id_u ?>&status=deletePhoto' class='btn btn-danger' onclick="return confirm('Jesteś pewien, że chcesz USUNĄĆ aktualne zdjęcie strony?')">
                            <i class='fa fa-trash'></i> Usuń aktualne zdjęcie
                        </a>
                    <?php
                    } else {
                        showInfo("Brak zdjęcia wyglądu strony.<br>Pamiętaj, że załączane zdjęcie musi być plikiem .png!");
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
                    <h3 class="panel-title"><i class="fa fa-file-pdf-o"></i> Załączone dokumenty</h3>
                </div>
                <div class="panel-body">
                    <?php
                    if (@$_GET['status'] == "uploadFile") {
                        uploadFile("uploads/doc/websites/".$id_u."/", "pdf,iso,zip");
                    }

                    if (@$_GET['status'] == "deleteDocument") {
                        deleteFile("uploads/doc/websites/".$id_u."/".$_GET['name'].".pdf");
                    }

                    showFiles("uploads/doc/websites/".$id_u, true);
                    ?>
                    <br>
                    <form action="websitesEdit.php?id_u=<?php echo $id_u ?>&status=uploadFile" method="post" enctype="multipart/form-data">
                        <label class="btn btn-success" for="select_document">
                        <input id="select_document" type="file" style="display:none;" onchange="this.form.submit()" name="document">
                            <i class="fa fa-upload"></i> Wyślij nowy dokument
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
                            showConnectedPayments("website", $website_data['id'], true);
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
                                <li><a onclick="setPaymentName('Roczne utrzymanie strony w internecie (<?php echo date("Y"); ?>)')">Roczne utrzymanie strony w internecie (<?php echo date("Y"); ?>)</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a onclick="setPaymentName('Wprowadzenie zmian na stronie')">Wprowadzenie zmian na stronie</a></li>
                                <li><a onclick="setPaymentName('Edycja kodu źródłowego strony')">Edycja kodu źródłowego strony</a></li>
                                <li><a onclick="setPaymentName('Stworzenie strony internetowej')">Stworzenie strony internetowej</a></li>
                                </ul>
                            </div>
                        </div>
                        <button class="btn btn-success" type="button" onclick="addNewPayment('website', '<?php echo $website_data['id'] ?>')"><i class="fa fa-plus"></i> Dodaj płatność</button>
                    </div>
                    </form>
                </div>
            </div>
    </div>
                <?php
                    } else {
                        showError("Wygląda na to, że strona o podanym identyfikatorze nie istnieje!");
                    }
                } else {
                    showError("Wygląda na to, że identyfikator strony jest nieprawidłowy!");
                }
                ?>
                <!-- KONIEC STRONY -->

            </div>
        </div>
    </div>
</body>
</html>
<?php } ?>