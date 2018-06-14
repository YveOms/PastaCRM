<?php
/**
 * Plik zawierajacy widok dodawania nowych stron internetowych.
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
    $siteTitle = "Dodawanie nowej strony internetowej";
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
                            <small>Just made Internet better place!</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-globe"></i>  <a href="websites.php">Strony internetowe</a>
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
                            <div class="panel-heading"><i class="fa fa-globe"></i> Formularz dodawania nowej strony</div>
                            <div class="panel-body">
                            <?php
                            if (isset($_POST['add_new_website'])) {
                                $site_data = [
                                    "website_name" => $_POST['website_name'],
                                    "website_address" => $_POST['website_address'],
                                    "server" => $_POST['server'],
                                    "cms" => $_POST['cms'],
                                    "status" => $_POST['status'],
                                    "contact_person" => @$_POST['contact_person']
                                ];

                                if (isset($_POST['client_first_name']) && isset($_POST['client_second_name'])) {
                                    $client_data = [
                                        "first_name" => $_POST['client_first_name'],
                                        "second_name" => $_POST['client_second_name'],
                                        "phone" => $_POST['client_phone'],
                                        "email" => $_POST['client_mail']
                                    ];
                                    
                                    if (addClient($client_data)) {
                                        $site_data['contact_person'] = getLastClientId();
                                    }
                                } else {
                                    $site_data['contact_person'] = getClientId($site_data['contact_person']);
                                }
                                
                                addWebsite($site_data);
                            }

                            $cms_list = "";
                            $status_list = "";
                            for ($i=0; $i<getCmsName(); $i++) {
                                $cms_list .= "<option value='$i'>".getCmsName($i)."</option>";
                            }

                            for ($i=0; $i<getStatusName(); $i++) {
                                $status_list .= "<option value='$i'>".getStatusName($i)."</option>";
                            }
                            ?>
                                <form method="post">
                                    <div class="form-group">
                                        <label>Nazwa strony <font color="red">*</font></label>
                                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                            <div class="input-group-addon"><i class="fa fa-fw fa-underline"></i></div>
                                            <input type="text" class="form-control" name="website_name" minlength="2" maxlength="100" onkeyup="checkInputLength(this, 2, 100)" required />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                    <label>Adres internetowy <font color="red">*</font></label>
                                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                            <div class="input-group-addon"><i class="fa fa-fw fa-link"></i> http://</div>
                                            <input type="text" class="form-control" name="website_address" minlength="4" maxlength="100" onkeyup="checkInputLength(this, 4, 100)" required />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Serwer</label>
                                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                            <div class="input-group-addon"><i class="fa fa-fw fa-server"></i></div>
                                            <select class="selectpicker form-control" name="server" data-live-search="true">
                                                <option value="">- - -</option>
                                                <?php
                                                    showServersDopdown();
                                                ?>
                                            </select>
                                        </div>
                                        <p class="help-block">Uwaga: Możesz dodać nowy serwer w menu serwerów.</p>
                                    </div>

                                    <div class="form-group">
                                        <label>CMS <font color="red">*</font></label>
                                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                            <div class="input-group-addon"><i class="fa fa-fw fa-wordpress"></i></div>
                                            <select name="cms" class="selectpicker" data-width="100%">
                                                <option value="">- - -</option>
                                                <?php echo $cms_list; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Status <font color="red">*</font></label>
                                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                            <div class="input-group-addon"><i class="fa fa-fw fa-cogs"></i></div>
                                            <select name="status" class="selectpicker" data-width="100%">
                                                <option value="">- - -</option>
                                                <?php echo $status_list ?>
                                            </select>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="form-group" id="contact_person">
                                        <label>Pierwsza osoba kontaktowa <font color="red">*</font></label>
                                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                            <div class="input-group-addon"><i class="fa fa-fw fa-user"></i></div>
                                            <select class="selectpicker form-control" name="contact_person" data-live-search="true">
                                                <option value="">- - -</option>
                                                <?php
                                                    showClientsDropdown();
                                                ?>
                                            </select>
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button" onclick="showAddNewClientForm('contact_person')"><i class="fa fa-fw fa-user-plus"></i> Dodaj nowego klienta</button>
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <br>
                                    <a href="websites.php" class="btn btn-primary">
                                        <i class="fa fa-arrow-left"></i> Wróć
                                    </a>
                                    <button type="submit" name="add_new_website" class="btn btn-success"><i class="fa fa-plus"></i> Dodaj nową stronę</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-life-ring"></i> Pomoc</div>
                            <div class="panel-body">
                                <p>
                                    <b>Nazwa strony</b>
                                    <br>Oficjalna nazwa strony lub marki, np. "Odkurzacze Elizy".
                                </p>
                                <p>
                                    <b>Adres internetowy</b>
                                    <br>Adres strony bez przedrostka <i>http://</i>, np. "pastamedia.com".
                                </p>
                                <p>
                                    <b>Serwer</b>
                                    <br>Wybierz serwer, na którym znajdują się pliki strony. Jeśli serwera nie ma na liście, możesz go dodać w menu <span class="label label-default"><i class="fa fa-fw fa-server"></i> Serwery</span> dostępnym w panelu zarządzania PastaMedia CMS.
                                </p>
                                <p>
                                    <b><i class="fa fa-fw fa-wordpress"></i> CMS</b>
                                    <br>CMS, czyli Content Management System (System Zarządzania Treścią). Zaznacz, czy, oraz jaki będzie system zarządzania stroną.
                                </p>
                                <p>
                                    <b>Status</b>
                                    <br>Zaznacz, czy strona została już ukończona, czy też prace nad nią właśnie trwają.
                                </p>
                                <p>
                                    <b>Dane kontaktowe</b>
                                    <br>Dane kontaktowe do klienta zaznaczone czerwoną gwiazdką są wymagane, reszta opcjonalna.
                                    <br>Po wciśnięciu przycisku <label class="label label-default"><i class="fa fa-fw fa-user-plus"></i> Dodaj nowego klienta</label> lista wyboru istniejącego klienta zostanie zastąpiona formularzem dodawania nowego.
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