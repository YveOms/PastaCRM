
<?php
@session_start();
require_once("inc/functions.php");
if(checkUserPermissions(1) || checkUserPermissions(2) || checkUserPermissions(3)){
    $siteTitle = "Inne szablony";
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
                                <i class="fa fa-code"></i> <?= $siteTitle ?>
                            </li>
                        </ol>
                    </div>
                </div>
                
                <!-- STRONA -->
                <div class="row">
                    <div class="col-md-8">
                         <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-code"></i> Szablony HTML</div>
                            <div class="panel-body">
                                
                                <div class="col-md-6 text-center">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                                <img src="img/templates/ComingSoon_Page.png" alt="Coming Soon Page" class="img img-thumbnail">
                                                <div class="caption">Coming Soon (Candy Home Style)</div>
                                            </a>
                                        </div>
                                        <div id="collapse1" class="panel-collapse collapse">
                                            <div class="panel-body">
<textarea class="form-control" rows="5" style="resize: none;">
&lt;!DOCTYPE html&gt;
&lt;html lang="pl"&gt;
&lt;head&gt;
    &lt;meta charset="UTF-8"&gt;
    &lt;meta name="author" content="Patryk Szulc"&gt;
    &lt;meta name="copyright" content="PastaMedia (c) <?php echo date("Y"); ?>"&gt;
    &lt;title&gt;Coming Soon!&lt;/title&gt;
    
    &lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;

    &lt;style&gt;
        body{
            background:
            linear-gradient(45deg, #92baac 45px, transparent 45px)64px 64px,
            linear-gradient(45deg, #92baac 45px, transparent 45px,transparent 91px, #e1ebbd 91px, #e1ebbd 135px, transparent 135px),
            linear-gradient(-45deg, #92baac 23px, transparent 23px, transparent 68px,#92baac 68px,#92baac 113px,transparent 113px,transparent 158px,#92baac 158px);
            background-color:#e1ebbd;
            background-size: 128px 128px;
        }
        
        #frame{
            border: 1px dashed #ddd;
            box-shadow: 0 0 0 3px #fff, 0 0 0 5px #ddd, 0 0 0 10px #fff, 0 0 2px 10px #eee;
            padding: 20px;
            width: 30%;
            margin-top: 10%;
            background-color: rgba(255, 255, 255, 0.7);
            font-size: 20px;
            text-shadow: 2px 2px #92BAAC;
        }
    &lt;/style&gt;
&lt;/head&gt;
&lt;body&gt;
&lt;div align="center"&gt;
    &lt;div id="frame"&gt;
        "Już niedługo powstanie tu wspaniała strona!"
&lt;br/&gt;    ~ PastaMedia
    &lt;/div&gt;
&lt;/div&gt;
&lt;/body&gt;
&lt;/html&gt;
</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 text-center">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                                <img src="img/templates/Block_Page.png" alt="Block Page" class="img img-thumbnail">
                                                <div class="caption">Block for non-payment</div>
                                            </a>
                                        </div>
                                        <div id="collapse4" class="panel-collapse collapse">
                                            <div class="panel-body">
<textarea class="form-control" rows="5" style="resize: none;">
&lt;!DOCTYPE html&gt;
&lt;html lang="pl"&gt;
&lt;head&gt;
    &lt;meta charset="UTF-8"&gt;
    &lt;title&gt;404 - Nie znaleziono strony!&lt;/title&gt;
    
    &lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;

    &lt;style&gt;
        body{
            background-color:black;
            background-image:
            radial-gradient(white, rgba(255,255,255,.2) 2px, transparent 40px),
            radial-gradient(white, rgba(255,255,255,.15) 1px, transparent 30px),
            radial-gradient(white, rgba(255,255,255,.1) 2px, transparent 40px),
            radial-gradient(rgba(255,255,255,.4), rgba(255,255,255,.1) 2px, transparent 30px);
            background-size: 550px 550px, 350px 350px, 250px 250px, 150px 150px; 
            background-position: 0 0, 40px 60px, 130px 270px, 70px 100px;
        }
        
        #frame{
            border: 1px dashed #ddd;
            box-shadow: 0 0 0 3px #fff, 0 0 0 5px #ddd, 0 0 0 10px #fff, 0 0 2px 10px #eee;
            padding: 20px;
            width: 30%;
            margin-top: 10%;
            background-color: rgba(255, 255, 255, 0.7);
            font-size: 20px;
            text-shadow: 2px 2px #FFFF;
        }
    &lt;/style&gt;
&lt;/head&gt;
&lt;body&gt;
&lt;div align="center"&gt;
    &lt;div id="frame"&gt;
        &lt;h1&gt;404&lt;/h1&gt;
        &lt;h3&gt;Ważna informacja dla właściciela strony!&lt;/h3&gt;
        W związku z długotrwałym brakiem płatności zostaliśmy zmuszeni do zawieszenia strony.
        &lt;hr/&gt;
        Prosimy o uregulowanie opłaty za stronę internetową.
    &lt;/div&gt;
&lt;/div&gt;
&lt;/body&gt;
&lt;/html&gt;
</textarea>
                                            </div>
                                        </div>
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
                                    <br>Znajdziesz tutaj np. wzory stron z informacjami (tj. informacja o nadchodzącej stronie).
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