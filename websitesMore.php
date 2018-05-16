<?php
@session_start();
require_once("inc/functions.php");
if(checkUserPermissions(2) || checkUserPermissions(3)){
    $siteTitle = "Szczegóły strony internetowej";
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
                                <i class="fa fa-dashboard"></i>  <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-globe"></i>  <a href="websites.php">Strony internetowe</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> <?= $siteTitle ?>
                            </li>
                        </ol>
                    </div>
                </div>
                
    <!-- STRONA -->
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-globe"></i> Szczegóły strony internetowej</div>
            <div class="panel-body">
                <?php
                    if($id_u){
                        $website_data = getWebsiteData($id_u);
                        if($website_data != null){

                            $client_data = getClientData($website_data['id_contact_person']);
                            $server_data = getServerData($website_data['id_server']);

                            $server_provider = getProviderData($server_data['id_server_provider']);
                            $domain_provider = getProviderData($website_data['id_domain_provider']);
                            $ssl_provider = getProviderData($website_data['id_ssl_provider']);
                ?>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th style="width: 40%"><i class="fa fa-calendar-check-o"></i> Data utworzenia</th>
                            <td colspan="2"><?= $website_data['date_created'] ?></td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-underline"></i> Nazwa strony</th>
                            <td colspan="2"><?= $website_data['name']; ?></td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-link"></i> Adres internetowy</th>
                            <td colspan="2"><a href="http://<?= $website_data['web_address']; ?>" target="_blank"><?= $website_data['web_address']; ?></a></td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-server"></i> Serwer</th>
                            <td>
                                <?php
                                    if($server_data['name']){
                                        echo $server_data['name']." (".$server_provider['provider_name'].")";
                                    }
                                ?>
                                </td>
                            <td><?= $server_data['expires_date']; ?></td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-database"></i> Dostawca domeny</th>
                            <td><?= $domain_provider['provider_name']; ?></td>
                            <td><?= $website_data['domain_expire_date']; ?></td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-lock"></i> Dostawca SSL</th>
                            <td><?= $ssl_provider['provider_name']; ?></td>
                            <td><?= $website_data['ssl_expire_date']; ?></td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-money"></i> Roczna płatność</th>
                            <td colspan="2">
                                <?php
                                    if($website_data['payment_for_me'])
                                        echo getMoneyValue($website_data['payment_for_me'])." zł";
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-calendar"></i> Data najbliższej płatności</th>
                            <td colspan="2"><?= $website_data['payment_for_me_date']; ?></td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-cogs"></i> Status</th>
                            <td colspan="2"><?= getStatusName($website_data['status']) ?></td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-wordpress"></i> CMS</th>
                            <td colspan="2"><?= getCmsName($website_data['cms']); ?></td>
                        </tr>
                        <tr>
                            <th colspan="3"><i class="fa fa-info-circle"></i> Dodatkowe informacje</th>
                        </tr>
                        <tr>
                            <td colspan="3"><?= nl2br(bbCode($website_data['comment'])); ?></td>
                        </tr>
                    </table>
                    
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th colspan="2"><i class="fa fa-square"></i> Osoba kontaktowa</th>
                        </tr>
                        <tr>
                            <th style="width: 40%"><i class="fa fa-user"></i> Imię i nazwisko</th>
                            <td><a href="clientsMore.php?id_u=<?= $client_data['id_unique']; ?>"><?= $client_data['first_name']; ?> <?= $client_data['second_name']; ?></a></td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-at"></i> Adres email</th>
                            <td>
                                <?php
                                    if($client_data['email'] != null) {
                                        echo $client_data['email']."<a href='mailto:".$client_data['email']."' class='btn btn-success btn-xs pull-right'><i class='fa fa-envelope'></i> Napisz</a>";
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-phone"></i> Telefon</th>
                            <td>
                                <?php
                                    if($client_data['phone'] != null) {
                                        echo $client_data['phone']."<a href='tel:".$client_data['phone']."' class='btn btn-success btn-xs pull-right'><i class='fa fa-phone'></i> Zadzwoń</a>";
                                    }
                                ?>
                            </td>
                        </tr>
                    </table>

                    <?php
                        if($website_data['id_contact_person2']){
                            $client_data = getClientData($website_data['id_contact_person2']);
                    ?>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th colspan="2"><i class="fa fa-square"></i> Osoba kontaktowa</th>
                        </tr>
                        <tr>
                            <th style="width: 40%"><i class="fa fa-user"></i> Imię i nazwisko</th>
                            <td><a href="clientsMore.php?id_u=<?= $client_data['id_unique']; ?>"><?= $client_data['first_name']; ?> <?= $client_data['second_name']; ?></a></td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-at"></i> Adres email</th>
                            <td>
                                <?php
                                    if($client_data['email'] != null) {
                                        echo $client_data['email']."<a href='mailto:".$client_data['email']."' class='btn btn-success btn-xs pull-right'><i class='fa fa-envelope'></i> Napisz</a>";
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-phone"></i> Telefon</th>
                            <td>
                                <?php
                                    if($client_data['phone'] != null) {
                                        echo $client_data['phone']."<a href='tel:".$client_data['phone']."' class='btn btn-success btn-xs pull-right'><i class='fa fa-phone'></i> Zadzwoń</a>";
                                    }
                                ?>
                            </td>
                        </tr>
                    </table>
                    <?php
                        }
                    ?>
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a data-toggle="collapse" href="#billing_info">
                                <b>Płatności</b>
                            </a>
                        </div>
                        <div id="billing_info" class="panel-collapse collapse">
                            <div class="panel-body">
                               <ul class="list-group">
                                    <?php
                                        showConnectedPayments("website", $website_data['id']);
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <a href="websites.php" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Wróć</a>
                <a href="websitesEdit.php?id_u=<?php echo $id_u ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edytuj</a>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-photo"></i> Podgląd wyglądu strony</h3>
            </div>
            <div class="panel-body">
                <div class="list-group">
                    <?php
                        if(file_exists("uploads/img/websites/".$id_u."/website.png"))
                            echo "<a href='uploads/img/websites/".$id_u."/website.png' target='_blank'><img src='uploads/img/websites/".$id_u."/website.png' class='img-thumbnail' /></a>";
                        else
                            showInfo("Brak zdjęcia.");
                    ?>
                </div>
            </div>
        </div>
           
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-file-pdf-o"></i> Załączone dokumenty</h3>
            </div>
            <div class="panel-body">
                <div class="list-group">
                    <?php
                        showFiles("uploads/doc/websites/".$id_u);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
            }else{
                showError("Wygląda na to, że strona o podanym identyfikatorze nie istnieje!");
            }
        }else{
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