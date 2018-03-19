<?php
@session_start();
require_once("inc/functions.php");
if(checkUserPermissions(2) || checkUserPermissions(3)){
    $siteTitle = "Kalendarz płatności";
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= showSiteTitle($siteTitle) ?></title>
    <?php include_once("inc/head.php"); ?>

    <style>
        .calendarImage{
            height: 142px;
            width: 142px;
        }
    </style>
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
                            <small>Just check pricing dates ...</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-calendar"></i> <?= $siteTitle ?>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                
                <!-- MAIN CONTENT -->
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-calendar"></i> Kalendarz</div>
                    <div class="panel-body">
                        <?php
                            @$wyswietlany_rok = $_GET['year'];
                            if($wyswietlany_rok == null)
                                $wyswietlany_rok = date("Y");
                        ?>
                    <div class="btn-group btn-group-justified">
                            <a href='websitesCalendar.php?year=<?= $wyswietlany_rok-1 ?>' class='btn btn-primary'>
                                <i class='fa fa-arrow-left'></i> <?= $wyswietlany_rok-1 ?>
                            </a>
                        <a id='aktualny_rok' class='btn btn-primary'>
                            <i class='fa fa-calendar-check-o'></i> <b><?= $wyswietlany_rok ?></b>
                        </a>
                            <a href='websitesCalendar.php?year=<?= $wyswietlany_rok+1 ?>' class='btn btn-primary'>
                                <?= $wyswietlany_rok+1 ?> <i class='fa fa-arrow-right'></i>
                            </a>
                    </div>

                        <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <td class="calendarImage"> <img src="img/calendar_Winter.png" alt="Winter"> </td>
                                <td id="month1"> <p>Styczeń</p> <?php showWebsitesCalendar($wyswietlany_rok, 1); ?> </td>
                                <td id="month2"> <p>Luty</p>    <?php showWebsitesCalendar($wyswietlany_rok, 2); ?> </td>
                                <td id="month3"> <p>Marzec</p>  <?php showWebsitesCalendar($wyswietlany_rok, 3); ?> </td>
                            </tr>
                            <tr>
                                <td class="calendarImage"> <img src="img/calendar_Spring.png" alt="Spring"> </td>
                                <td id="month4"> <p>Kwiecień</p><?php showWebsitesCalendar($wyswietlany_rok, 4); ?> </td>
                                <td id="month5"> <p>Maj</p>     <?php showWebsitesCalendar($wyswietlany_rok, 5); ?> </td>
                                <td id="month6"> <p>Czerwiec</p><?php showWebsitesCalendar($wyswietlany_rok, 6); ?> </td>
                            </tr>
                            <tr>
                                <td class="calendarImage"> <img src="img/calendar_Summer.png" alt="Summer"> </td>
                                <td id="month7"> <p>Lipiec</p>  <?php showWebsitesCalendar($wyswietlany_rok, 7); ?> </td>
                                <td id="month8"> <p>Sierpień</p><?php showWebsitesCalendar($wyswietlany_rok, 8); ?> </td>
                                <td id="month9"> <p>Wrzesień</p><?php showWebsitesCalendar($wyswietlany_rok, 9); ?> </td>
                            </tr>
                            <tr>
                                <td class="calendarImage"> <img src="img/calendar_Autumn.png" alt="Autumn"> </td>
                                <td id="month10"> <p>Październik</p> <?php showWebsitesCalendar($wyswietlany_rok, 10); ?> </td>
                                <td id="month11"> <p>Listopad</p>    <?php showWebsitesCalendar($wyswietlany_rok, 11); ?> </td>
                                <td id="month12"> <p>Grudzień</p>    <?php showWebsitesCalendar($wyswietlany_rok, 12); ?> </td>
                            </tr>
                        </table>
                        </div>

                        <script>
                            currentMonth();
                        </script>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading"><i class="fa fa-life-ring"></i> Pomoc</div>
                    <div class="panel-body">
                        <p>
                            <b>Do czego służy ten kalendarz?</b>
                            <br>W kalendarzu pokazane są kolejne terminy przypływów za roczne utrzymanie danej strony w sieci.
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