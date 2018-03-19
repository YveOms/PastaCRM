<?php
@session_start();
require_once("inc/functions.php");
if(checkUserPermissions(3)){
    $siteTitle = "Użytkownicy";
    @$id_u = $_GET['id_u'];
    @$status = $_GET['status'];
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
                            <li class="active">
                                <i class="fa fa-users"></i> <?= $siteTitle ?>
                            </li>
                        </ol>
                    </div>
                </div>
                
                <!-- STRONA -->
                <div class="row">
                    <div class="col-md-8">

                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-users"></i> Lista użytkowników systemu</div>
                            <div class="panel-body">
                                <?php
                                    if($status == "deleteUser" && $_GET['id'] != null)
                                        deleteUser($_GET['id']);

                                    if(isset($_POST['add_user'])){
                                        $user_data = [
                                            "login" => $_POST['login'],
                                            "passwd" => $_POST['passwd'],
                                            "permissions_level" => $_POST['permissions_level']
                                        ];
                                        addUser($user_data);
                                    }

                                    $permissions_list = "";
                                    for($i=0; $i<getUserPermissionName(); $i++)
                                        $permissions_list .= "<option value='$i'>".getUserPermissionName($i)."</option>";

                                    showUsers();
                                ?>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-user-plus"></i> Dodaj nowego użytkownika</div>
                            <div class="panel-body">
                               <form method="post">
                                    <div class="form-group">
                                        <label>Login<font color="red">*</font></label>
                                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                            <div class="input-group-addon"><i class="fa fa-fw fa-at"></i></div>
                                            <input type="text" class="form-control" name="login" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Hasło<font color="red">*</font></label>
                                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                            <div class="input-group-addon"><i class="fa fa-fw fa-key"></i></div>
                                            <input type="password" class="form-control" name="passwd" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Poziom uprawnień<font color="red">*</font></label>
                                        <select class="selectpicker" name="permissions_level" data-width="100%">
                                            <option value="x">- - -</option>
                                            <?= $permissions_list ?>
                                        </select>
                                    </div>
                                    <button type="submit" name="add_user" class="btn btn-success"> <i class="fa fa-plus"></i> Dodaj nowego użytkownika</button>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">

                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-life-ring"></i> Pomoc</div>
                            <div class="panel-body">
                                <p>
                                    <b>Co zawiera lista?</b>
                                    <br>Lista zawiera wszystkich użytkowników systemu, wraz z datą ostatniego logowania oraz poziomem uprawnień.
                                </p>
                                <hr>
                                <p>
                                    <b>Dodawanie nowego użytkownika</b>
                                    <br>Aby dodać nowego użytkownika, wpisz wymagane dane do formularza dodawania, a na stępnie go zatwierdź. 
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