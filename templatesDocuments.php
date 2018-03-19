
<?php
@session_start();
require_once("inc/functions.php");
if(checkUserPermissions(1) || checkUserPermissions(2) || checkUserPermissions(3)){
    $siteTitle = "Szablony dokumentów";
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
                            <small>Ready to use!</small>
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
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-file-pdf-o"></i> Szablony dokumentów</div>
                            <div class="panel-body">
                            <div class="row">

                                <div class="col-md-4 col-lg-3 text-center">
                                    <?php
                                        $doc_name = "PastaMedia - Dokument opisowy";
                                        $show_name = "Dokument<br>opisowy";
                                    ?>
                                    <a href="templates/documents/<?= $doc_name ?>.pdf" target="_blank">
                                        <img src="img/templates/<?= $doc_name ?>.png" alt="<?= $doc_name ?>" class="img img-thumbnail">
                                    </a>
                                    <div class="caption"><?= $show_name ?></div>
                                    <a href="templates/documents/<?= $doc_name ?>.docx" class="btn btn-info btn-xs full-width"><i class="fa fa-download"></i> Microsoft Word</a>
                                </div>

                                <div class="col-md-4 col-lg-3 text-center">
                                    <?php
                                        $doc_name = "PastaMedia - Podsumowanie pracy - serwis komputerowy";
                                        $show_name = "Podsumowanie pracy<br>(serwis komputerowy)";
                                    ?>
                                    <a href="templates/documents/<?= $doc_name ?>.pdf" target="_blank">
                                        <img src="img/templates/<?= $doc_name ?>.png" alt="<?= $doc_name ?>" class="img img-thumbnail">
                                    </a>
                                    <div class="caption"><?= $show_name ?></div>
                                    <a href="templates/documents/<?= $doc_name ?>.docx" class="btn btn-info btn-xs full-width"><i class="fa fa-download"></i> Microsoft Word</a>
                                </div>

                            </div>
                            <hr>
                            <div class="row">

                                <div class="col-md-4 col-lg-3 text-center">
                                    <?php
                                        $doc_name = "PastaMedia - Umowa o wykonanie strony internetowej";
                                        $show_name = "Umowa o wykonanie<br>strony internetowej";
                                    ?>
                                    <a href="templates/documents/<?= $doc_name ?>.pdf" target="_blank">
                                        <img src="img/templates/<?= $doc_name ?>.png" alt="<?= $doc_name ?>" class="img img-thumbnail">
                                    </a>
                                    <div class="caption"><?= $show_name ?></div>
                                    <a href="templates/documents/<?= $doc_name ?>.docx" class="btn btn-info btn-xs full-width"><i class="fa fa-download"></i> Microsoft Word</a>
                                </div>

                                <div class="col-md-4 col-lg-3 text-center">
                                    <?php
                                        $doc_name = "PastaMedia - Formularz oddania strony klientowi";
                                        $show_name = "Formularz oddania<br>strony klientowi";
                                    ?>
                                    <a href="templates/documents/<?= $doc_name ?>.pdf" target="_blank">
                                        <img src="img/templates/<?= $doc_name ?>.png" alt="<?= $doc_name ?>" class="img img-thumbnail">
                                    </a>
                                    <div class="caption"><?= $show_name ?></div>
                                    <a href="templates/documents/<?= $doc_name ?>.docx" class="btn btn-info btn-xs full-width"><i class="fa fa-download"></i> Microsoft Word</a>
                                </div>

                                <div class="col-md-4 col-lg-3 text-center">
                                    <?php
                                        $doc_name = "PastaMedia - Podsumowanie pracy - strona internetowa";
                                        $show_name = "Podsumowanie pracy<br>(strony internetowe)";
                                    ?>
                                    <a href="templates/documents/<?= $doc_name ?>.pdf" target="_blank">
                                        <img src="img/templates/<?= $doc_name ?>.png" alt="<?= $doc_name ?>" class="img img-thumbnail">
                                    </a>
                                    <div class="caption"><?= $show_name ?></div>
                                    <a href="templates/documents/<?= $doc_name ?>.docx" class="btn btn-info btn-xs full-width"><i class="fa fa-download"></i> Microsoft Word</a>
                                </div>

                                <div class="col-md-4 col-lg-3 text-center">
                                    <?php
                                        $doc_name = "PastaMedia - Formularz zakonczenia wspolpracy";
                                        $show_name = "Formularz zakończenia<br>współpracy";
                                    ?>
                                    <a href="templates/documents/<?= $doc_name ?>.pdf" target="_blank">
                                        <img src="img/templates/<?= $doc_name ?>.png" alt="<?= $doc_name ?>" class="img img-thumbnail">
                                    </a>
                                    <div class="caption"><?= $show_name ?></div>
                                    <a href="templates/documents/<?= $doc_name ?>.docx" class="btn btn-info btn-xs full-width"><i class="fa fa-download"></i> Microsoft Word</a>
                                </div>

                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-life-ring"></i> Pomoc</div>
                            <div class="panel-body">
                                <p>
                                    <b>Co znajdę w tym panelu?</b>
                                    <br>Znajdziesz tutaj oficjalne wzory dokumentów PastaMedia (np. wzór podsumowania pracy serwisu, wzór umowy o dzieło dot. budowy strony, itd...).
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