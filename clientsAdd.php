<?php
/**
 * Plik zawierajacy widok dodawania klientow.
 *
 * @category Components
 * @package  PastaCRM
 * @author   Patryk Szulc <patryk-szulc@outlook.com>
 * @license  CC BY-NC-ND 4.0 https://creativecommons.org/licenses/by-nc-nd/4.0/
 * @link     https://github.com/psc1997/PastaCRM
 */
@session_start();
require_once "inc/functions.php";
if (checkUserPermissions(1) || checkUserPermissions(2) || checkUserPermissions(3)) {
    $siteTitle = "Dodaj nowego klienta";
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
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i> <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li>
                                <i class="fa fa-fw fa-users"></i> <a href="clients.php">Klienci</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-fw fa-user"></i> <?php echo $siteTitle ?>
                            </li>
                        </ol>
                    </div>
                </div>
                
                <!-- STRONA -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-plus"></i> Formularz dodawania nowego klienta</div>
                            <div class="panel-body">
                                <?php
                                if (isset($_POST['add_client'])) {
                                    $client_data = [
                                        "first_name" => $_POST['first_name'],
                                        "second_name" => $_POST['second_name'],
                                        "phone" => $_POST['phone'],
                                        "email" => $_POST['email'],
                                        "address" => $_POST['address'],
                                        "comment" => $_POST['comment']
                                    ];
                                    addClient($client_data);
                                } ?>
                                <form method="post">
                                    <div class="form-group">
                                        <label>Imię <font color="red">*</font></label>
                                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                            <div class="input-group-addon"><i class="fa fa-fw fa-user"></i></div>
                                            <input type="text" class="form-control" name="first_name" autocomplete="on" minlength="3" maxlength="100" onkeyup="checkInputLength(this, 3, 100)" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Nazwisko <font color="red">*</font></label>
                                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                            <div class="input-group-addon"><i class="fa fa-fw fa-user"></i></div>
                                            <input type="text" class="form-control" name="second_name" autocomplete="on" minlength="3" maxlength="100" onkeyup="checkInputLength(this, 3, 100)" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-5">
                                            <label>Telefon kontaktowy</label>
                                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                                <div class="input-group-addon"><i class="fa fa-fw fa-phone"></i></div>
                                                <input type="tel" class="form-control" name="phone" autocomplete="off" minlength="9" maxlength="9" onkeyup="checkInputLength(this, 9, 9)">
                                            </div>
                                        </div>

                                        <div class="col-md-1 text-center">
                                            <b>LUB<br><i class="fa fa-fw fa-step-backward"></i><i class="fa fa-fw fa-step-forward"></i></b>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                                <div class="input-group-addon"><i class="fa fa-fw fa-at"></i></div>
                                                <input type="email" class="form-control" name="email" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Adres zamieszkania</label>
                                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                            <div class="input-group-addon"><i class="fa fa-fw fa-home"></i></div>
                                            <input type="text" class="form-control" name="address">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Opis:</label>
                                        <textarea class="form-control" name="comment"></textarea>
                                        <font color="grey">
                                            Dostępne znaczniki BB-Code: [hr], [b], [i], [u], [s], [center], [code], [color=red], [img] <i>link</i> [/img], [a] <i>link</i> [/a]
                                        </font>
                                    </div>
                                    <a href="clients.php" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Wróć</a>
                                    <button type="submit" class="btn btn-success" name="add_client"><i class="fa fa-user-plus"></i> Dodaj nowego klienta</button>
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
                                    <b>Imię</b>
                                    <br>Pełne imię klienta, np. "Anna" (zamiast "Anka").
                                </p>
                                <p>
                                    <b>Nazwisko</b>
                                    <br>W przypadku nazwisk dwuczłonowych wpisać wartości rozdzielone myślnikiem, np. "Rostkowska-Nadolska".
                                </p>
                                <p>
                                    <b>Telefon kontaktowy</b>
                                    <br>Numer składający się z 9 cyfr, bez spacji.
                                </p>
                                <p>
                                    <b>Email</b>
                                    <br>Adres email klienta. Musi zawierać małpę, kropkę oraz odpowiednią domenę.
                                </p>
                                <p>
                                    <b>Adres zamieszkania</b>
                                    <br>Adres zamieszkania klienta, np. "plac Defilad 1, 00-901 Warszawa"
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
<?php
} ?>