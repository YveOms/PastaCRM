<?php
@session_start();
require_once("inc/functions.php");
if(checkUserPermissions(1) || checkUserPermissions(3)){
    $siteTitle = "Generator Podsumowania";
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
                            <small>"Papers Please!"</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file-pdf-o"></i> <?= $siteTitle ?>
                            </li>
                        </ol>
                    </div>
                </div>

                <!-- STRONA -->
                    <div class="col-md-8">
                        <div class="panel panel-info">
                            <div class="panel-heading"><i class="fa fa-file-pdf-o"></i> Data for new PDF Files</div>
                            <div class="panel-body">
                                <form method="post">
                                    <div class="form-group">
                                        <label>Ustalenia wstępne<font color="red">*</font></label>
                                        <textarea class="form-control" rows="4" required></textarea>
                                        <br>
                                        <label>Diagnoza<font color="red">*</font></label>
                                        <textarea class="form-control" rows="4" required></textarea>
                                        <br>
                                        <label>Przebieg Pracy<font color="red">*</font></label>
                                        <textarea class="form-control" rows="6" required></textarea>
                                        <br>
                                        <label>Podsumowanie</label>
                                        <textarea class="form-control" rows="4"></textarea>
                                        <hr>
                                        <button type="submit" class="btn btn-success"><i class="fa fa-file-pdf-o"></i> Generuj Podsumowanie</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-life-ring"></i> Pomoc</div>
                            <div class="panel-body">
                                <b>Ustalenia Wstępne</b>
                                <br>Opis usterki zgłoszony przez klienta, planowany zakres prac, podejrzana usterka.
                                <hr>
                                <b>Diagnoza</b>
                                <br>Faktyczna usterka.
                                <hr>
                                <b>Przebieg Pracy</b>
                                <br>Opisowy zakres wykonanej pracy.
                                <hr>
                                <b>Podsumowanie</b>
                                <br>Ceny zakupionych przedmiotów, wykonanychu usług, itd...
                                <hr>
                                Pola wymagane zostały oznaczone czerwoną gwiazdką.
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-laptop"></i> Data from Computer Service</div>
                            <div class="panel-body">
                            	<a href="" class="btn btn-primary full-width">Show Pricing List</a>
                            	<hr>
                                <?php
                                    @showComputerServiceMore($_GET['id_u']);
                                ?>
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