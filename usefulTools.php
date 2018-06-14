<?php
/**
 * Plik zawierajacy widok listy przydatnych narzedzi.
 * Narzedzia podzielone sa na kategorie tj. Fonts, SEO, etc...
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
    $siteTitle = "Przydatne narzędzia";
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
                            <small>"For Science"</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-cogs"></i> <?php echo $siteTitle ?>
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                
                <!-- MAIN CONTENT -->
                    
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Google</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-3">
                            <a href="https://analytics.google.com/analytics/web/" target="_blank">
                                <img src="img/useful_tools/logo_GoogleAnalitics.png" alt="Google Analitics" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="https://trends.google.pl/trends/" target="_blank">
                                <img src="img/useful_tools/logo_GoogleTrends.png" alt="Google Trends" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="https://search.google.com/search-console/mobile-friendly" target="_blank">
                                <img src="img/useful_tools/logo_GoogleMobileFrendly.png" alt="Google Mobile Optimalization Test" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="https://developers.google.com/speed/pagespeed/insights/" target="_blank">
                                <img src="img/useful_tools/logo_PageSpeedInsights.png" alt="Page Speed Insights" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="https://search.google.com/structured-data/testing-tool" target="_blank">
                                <img src="img/useful_tools/logo_GoogleStructudedData.png" alt="Google Structured Data" class="img-thumbnail">
                            </a>
                        </div>
                    </div>
                </div>
                   
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Fonts & Design</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-3">
                            <a href="https://fonts.google.com/" target="_blank">
                                <img src="img/useful_tools/logo_GoogleFonts.png" alt="Google Fonts" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="http://fontawesome.io/icons/" target="_blank">
                                <img src="img/useful_tools/logo_FontAwesome.png" alt="Awesome Fonts" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="http://materializecss.com/getting-started.html" target="_blank">
                                <img src="img/useful_tools/logo_Materialize.png" alt="Materialize" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="http://getbootstrap.com/getting-started/" target="_blank">
                                <img src="img/useful_tools/logo_Bootstrap.png" alt="Bootstrap" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="https://materialdesignicons.com/" target="_blank">
                                <img src="img/useful_tools/logo_MaterialDesignIcons.png" alt="Material Design Icons" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="http://fontello.com/" target="_blank">
                                <img src="img/useful_tools/logo_Fontello.png" alt="Fontello" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="http://patternizer.com/" target="_blank">
                                <img src="img/useful_tools/logo_Patternizer.png" alt="Patternizer" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="https://mdbootstrap.com/" target="_blank">
                                <img src="img/useful_tools/logo_BootstrapMaterialDesign.png" alt="Bootstrap Material Design" class="img-thumbnail">
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Zdjęcia & Kolorystyka</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-3">
                            <a href="https://pixabay.com/" target="_blank">
                                <img src="img/useful_tools/logo_Pixabay.png" alt="Pixabay" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="http://paletton.com" target="_blank">
                                <img src="img/useful_tools/logo_Paletton.png" alt="Paletton" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="https://color.adobe.com/create/color-wheel" target="_blank">
                                <img src="img/useful_tools/logo_AdobeColorCC.png" alt="AdobeColorCC" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="http://www.colorhunter.com/" target="_blank">
                                <img src="img/useful_tools/logo_ColorHunter.png" alt="ColorHunter" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="https://videos.pexels.com/" target="_blank">
                                <img src="img/useful_tools/logo_VideosPexels.png" alt="Pixbay Videos" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="http://www.gratisography.com/" target="_blank">
                                <img src="img/useful_tools/logo_CaboomPics.png" alt="Caboom Pics" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="https://pixnio.com/" target="_blank">
                                <img src="img/useful_tools/logo_Pixino.png" alt="Pixino" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="https://www.pexels.com/" target="_blank">
                                <img src="img/useful_tools/logo_Pixels.png" alt="Pixels" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="http://finda.photo/" target="_blank">
                                <img src="img/useful_tools/logo_FindAPhoto.png" alt="FindAPhoto" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <!--
                            <a href="#" target="_blank">
                                <img src="XXX" alt="XXX" class="img-thumbnail">
                            </a>
                            -->
                        </div>
                        <div class="col-lg-3">
                            <a href="http://www.fotor.com/" target="_blank">
                                <img src="img/useful_tools/logo_Fotor.png" alt="Fotor Collage Editor" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="http://thestocks.im/?ref=flatuicolors.com" target="_blank">
                                <img src="img/useful_tools/logo_TheStocks.png" alt="The Stocks" class="img-thumbnail">
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">SEO</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-3">
                            <a href="https://varvy.com/" target="_blank">
                                <img src="img/useful_tools/logo_Varvy.png" alt="Varvy SEO Tool" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="https://www.found.co.uk/seo-tool/" target="_blank">
                                <img src="img/useful_tools/logo_FoundSEOTool.png" alt="Found SEO Tool" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="http://www.seoptimer.com/" target="_blank">
                                <img src="img/useful_tools/logo_SEOPtimer.png" alt="SEOPtimer" class="img-thumbnail">
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Testowanie Strony i Serwera</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-3">
                            <a href="https://hackertarget.com/wordpress-security-scan/" target="_blank">
                                <img src="img/useful_tools/logo_WordpressSecurityScanner.png" alt="Wordpress Security Scanner" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="https://validator.w3.org/" target="_blank">
                                <img src="img/useful_tools/logo_W3HTMLValidator.png" alt="W3 HTML Validator" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="http://tools.pingdom.com/fpt/" target="_blank">
                                <img src="img/useful_tools/logo_PingdomSpeedTest.png" alt="Pingdom Speed Test" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="https://checkgzipcompression.com/" target="_blank">
                                <img src="img/useful_tools/logo_CheckGZIPCompression.png" alt="Check GZIP Compression" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="https://www.ssllabs.com/ssltest/index.html" target="_blank">
                                <img src="img/useful_tools/logo_SSLLabs.png" alt="SSL Labs" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="https://jigsaw.w3.org/css-validator/" target="_blank">
                                <img src="img/useful_tools/logo_W3CSSValidator.png" alt="W3 CSS Validator" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="https://webspeed.intensys.pl/" target="_blank">
                                <img src="img/useful_tools/logo_IntensysSpeedTest.png" alt="Intensys Speed Test" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="https://gtmetrix.com/" target="_blank">
                                <img src="img/useful_tools/logo_GTMetrix.png" alt="GTMetrics Speed Test" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            
                        </div>
                        <div class="col-lg-3">
                            <a href="https://validator.w3.org/checklink" target="_blank">
                                <img src="img/useful_tools/logo_BrokenLinkChecker.png" alt="W3School Broken Link Checker" class="img-thumbnail">
                            </a>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Dodatkowe Narzędzia</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-3">
                            <a href="https://www.diffchecker.com/" target="_blank">
                                <img src="img/useful_tools/logo_CodeCompareTool.png" alt="Code Compare Tool" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="http://www.quetext.com/" target="_blank">
                                <img src="img/useful_tools/logo_PlagiarismDetector.png" alt="Plagiarism Detector" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="http://browsershots.org/" target="_blank">
                                <img src="img/useful_tools/logo_BrowserShots.png" alt="BrowserShots Screenshot Test" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="http://whatsmybrowsersize.com/" target="_blank">
                                <img src="img/useful_tools/logo_WhatsmyBrowserSize.png" alt="Check Browser Size" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="https://htmlcompressor.com/compressor/" target="_blank">
                                <img src="img/useful_tools/logo_HTMLCompressor.png" alt="HTML Compressor" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="https://tinypng.com/" target="_blank">
                                <img src="img/useful_tools/logo_TinyPNGCompressor.png" alt="Tiny Image Compressor" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="https://www.synonimy.pl/" target="_blank">
                                <img src="img/useful_tools/logo_Synonimy.png" alt="Synonimy.pl" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="https://uncss-online.com/" target="_blank">
                                <img src="img/useful_tools/logo_unCSS.png" alt="uncss.pl CSS Cleaner" class="img-thumbnail">
                            </a>
                        </div>
                    </div>
                </div>
                   
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Inspiracje</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-3">
                            <a href="https://www.awwwards.com/" target="_blank">
                                <img src="img/useful_tools/logo_Awwwards.png" alt="Awwwards" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="https://thefwa.com/" target="_blank">
                                <img src="img/useful_tools/logo_FWA.png" alt="The FWA" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="https://onepagelove.com/" target="_blank">
                                <img src="img/useful_tools/logo_OnePageLove.png" alt="One Page Love" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="http://www.htmlinspiration.com/" target="_blank">
                                <img src="img/useful_tools/logo_HTMLInspiration.png" alt="HTML Inspiration" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="http://zurb.com/patterntap" target="_blank">
                                <img src="img/useful_tools/logo_PatternTap.png" alt="PatternTap" class="img-thumbnail">
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="http://collectui.com/?ref=flatuicolors.com" target="_blank">
                                <img src="img/useful_tools/logo_CollectUI.png" alt="CollectUI" class="img-thumbnail">
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-laptop"></i> Narzędzia dla Serwisu Komputerowego</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-3">
                            <a href="http://basewin.pl/" target="_blank">
                                <img src="img/useful_tools/logo_BaseWin.png" alt="BaseWin" class="img-thumbnail">
                            </a>
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