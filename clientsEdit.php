<?php
@session_start();
require_once("inc/functions.php");
if(checkUserPermissions(1) || checkUserPermissions(2) || checkUserPermissions(3)){
    $siteTitle = "Edycja klienta";
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
                            <li>
                                <i class="fa fa-fw fa-user"></i> <a href="clientsMore.php?id_u=<?= $id_u ?>">Szczegóły klienta</a>
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
                                if(isset($_POST['edit_client'])){
                                    $client_data = [
                                        "id_u" => $id_u,
                                        "first_name" => $_POST['first_name'],
                                        "second_name" => $_POST['second_name'],
                                        "phone" => $_POST['phone'],
                                        "email" => $_POST['email'],
                                        "address" => $_POST['address'],
                                        "comment" => $_POST['comment']
                                    ];

                                    editClient($client_data);
                                }
                    ?>
                    <form method="post">
                    <table class='table table-striped table-bordered'>
                        <tr>
                            <th style="width: 200px"><i class='fa fa-fw fa-user'></i> Imię i nazwisko <font color="red">*</font></th>
                            <td>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input class="form-control" type="text" name="first_name" value="<?= $client_data['first_name'] ?>" placeholder="Imię" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <input class="form-control" type="text" name="second_name" value="<?= $client_data['second_name'] ?>" placeholder="Nazwisko" required>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th><i class='fa fa-fw fa-phone'></i> Telefon kontaktowy</th>
                            <td><input class="form-control" type="tel" name="phone" value="<?= $client_data['phone'] ?>" placeholder="Numer telefonu" maxlength=9></td>
                        </tr>
                        <tr>
                            <th><i class='fa fa-fw fa-at'></i> Adres email</th>
                            <td><input class="form-control" type="email" name="email" value="<?= $client_data['email'] ?>" placeholder="Adres email"></td>
                        </tr>
                        <tr>
                            <th><i class='fa fa-fw fa-home'></i> Adres zamieszkania</th>
                            <td><input class="form-control" type="text" name="address" value="<?= $client_data['address'] ?>" placeholder="Adres zamieszkania"></td>
                        </tr>
                        <tr>
                            <th colspan=2><i class='fa fa-fw fa-info'></i> Dodatkowe informacje</th>
                        </tr>
                        <tr>
                            <td colspan=2>
                                <textarea class="form-control" name="comment" rows=5><?= $client_data['comment'] ?></textarea>
                                <font color="grey">
                                    Dostępne znaczniki BB-Code: [hr], [b], [i], [u], [s], [center], [code], [color=red], [img] <i>link</i> [/img], [a] <i>link</i> [/a]
                                </font>
                            </td>
                        </tr>
                    </table>
                    <a href="clientsMore.php?id_u=<?= $id_u ?>" class="btn btn-primary">
                        <i class="fa fa-arrow-left"></i> Wróć
                    </a>
                    <button class="btn btn-success" type="submit" name="edit_client">
                        <i class="fa fa-save"></i> Edytuj dane klienta
                    </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-area-chart"></i> Statystyki klienta</h3>
                </div>
                <div class="panel-body">
                    <i>Wyświetlane w podglądzie szczegółów użytkownika</i>
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