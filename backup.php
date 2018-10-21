<?php
/**
 * Plik zawierajacy podstawowy widok kopii zapasowych.
 * 
 * @category Components
 * @package  PastaCRM
 * @author   Patryk Szulc <patryk-szulc@outlook.com>
 * @license  CC BY-NC-ND 4.0 https://creativecommons.org/licenses/by-nc-nd/4.0/
 * @link     https://github.com/psc1997/PastaCRM
 */
@session_start();
require_once "inc/functions.php";
if (checkUserPermissions(3)) {
    $siteTitle = "Kopia zapasowa";
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
                            <small>Ludzie dzielą się [...] robią kopie zapasowe i [...] będą je robili</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-archive"></i> <?php echo $siteTitle ?>
                            </li>
                        </ol>
                    </div>
                </div>

                <!-- STRONA -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-archive"></i> Aktualne kopie zapasowe systemu</div>
                            <div class="panel-body">
                                <?php
                                    switch (@$_GET['action']) {
                                        case 'backup':
                                            createBackup('all');
                                            break;

                                        case 'backup_files':
                                            createBackup('files');
                                            break;

                                        case 'backup_mysql':
                                            createBackup('mysql');
                                            break;
                                        
                                        case 'backups_delete':
                                            deleteBackups();
                                            break;
                                    }

                                    showFiles('backups', false);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-life-ring"></i> Pomoc</div>
                            <div class="panel-body">
                                <p>
                                    <a href="?action=backup" class="btn btn-primary full-width" onclick="return confirm('UWAGA! Tworzenie kopii może zająć kilka minut. Nie odświeżaj strony, dopóki kopia nie zostaie ukończona (ujrzysz ją na liście plików)')">Utwórz pełną kopię</a>
                                </p>
                                <p>
                                    <a href="?action=backup_files" class="btn btn-primary full-width" onclick="return confirm('UWAGA! Tworzenie kopii może zająć kilka minut. Nie odświeżaj strony, dopóki kopia nie zostaie ukończona (ujrzysz ją na liście plików)')">Utwórz kopię plików</a>
                                </p>
                                <p>
                                    <a href="?action=backup_mysql" class="btn btn-primary full-width">Utwórz kopię bazy danych</a>
                                </p>
                                <p>
                                    <a href="?action=backups_delete" class="btn btn-danger full-width"  onclick="return confirm('Na pewno chcesz USUNĄĆ wszystkie kopie? Tej operacji NIE MOŻNA COFNĄĆ!')">Usuń wszystkie kopie zapasowe</a>
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