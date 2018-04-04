<?php
@session_start();
require_once("inc/functions.php");
if(checkUserPermissions(1) || checkUserPermissions(2) ||checkUserPermissions(3)){
    $siteTitle = "Pomoc";
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= showSiteTitle($siteTitle) ?></title>
    <?php include_once("inc/head.php"); ?>

    <style>
        div.panel li.bold{
            font-weight: bold;
        }
        div.panel ol[type="a"] li{
            margin-top: 10px;
        }
        div.panel ol[type="a"] li:first-child{
            margin-top: 0px;
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
                            <small>Just small tips and hints</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-question"></i> <?= $siteTitle ?>
                            </li>
                        </ol>
                    </div>
                </div>

<!-- STRONA -->
<div class="col-lg-8">
    <ul class="nav nav-tabs nav-justified">
        <li class="active"><a data-toggle="tab" href="#procedure">Procedury</a></li>
        <li><a data-toggle="tab" href="#help">Pomoc & FAQ</a></li>
    </ul>

    <!-- PROCEDURY -->
    <div class="tab-content">
        <div id="procedure" class="tab-pane fade in active">
            <hr>
            <div class="alert alert-info">
                W tej zakładce znajdują się wszelkie procedury, które ułatwiają bezproblemowe oraz bezpieczne wykonywanie rutynowych czynności.
                <br>Każda procedura może zostać zmodyfikowana, jeśli proponowana zmiana znacząco ulepszy daną procedurę.
            </div>

            <!-- Weryfikacja poprawności strony przed wysłaniem na serwer -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse_6796882225">
                        <b>Weryfikacja poprawności strony przed wysłaniem na serwer</b>
                        <span class="label label-primary pull-right">Procedura</span>
                    </a>
                </div>
                <div id="collapse_6796882225" class="panel-collapse collapse">
                    <div class="panel-body">
                        XXXXX
                    </div>
                    <div class="panel-footer"><i>Ostatnia aktualizacja: xx-xx-xxxx</i></div>
                </div>
            </div>

            <!-- Przenoszenie Wordpress'a z localhost na serwer produkcyjny -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse_6796882221">
                        <b>Przenoszenie Wordpress'a z localhost na serwer produkcyjny</b>
                        <span class="label label-primary pull-right">Procedura</span>
                        <span class="label label-primary pull-right">Wordpress</span>
                    </a>
                </div>
                <div id="collapse_6796882221" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ol>
                            <li>Instalacja oraz aktywacja wtyczki <i>WP Maintenance Mode</i></li>
                            <br>
                            <li>Export lokalnej bazy danych do pliku *sql.</li>
                            <li>Otworzenie pliku *sql edytorem tekstu, i podmiana "http://localhost/dashboard/" na "http://nowa-domena.com"</li>
                            <li>Utworzenie nowej bazy danych na serwerze.</li>
                            <li>Import pliku *sql na serwerze</li>
                            <br>
                            <li>Wysłanie przez SFTP lokalnych plików strony na serwer.</li>
                            <li>Edycja danych łączenia z bazą w pliku <i>wp-config.php</i> na serwerze.</li>
                            <br>
                            <li>Strona powinna działać prawidłowo. Sprawdź wyświetlanie oraz działanie strony!</li>
                            <li>W panelu administracyjnym przejść do <i>Settings » General</i>, a następnie kliknąć <i>Zapisz</i>.
                                <br>Dzięki temu sprawdzona i poprawiona zostanie integralność linków na stronie.
                            </li>
                            <li>W panelu administracyjnym przejść do <i>Settings » Permalink</i> , a następnie kliknąć <i>Zapisz</i>.
                                <br>Zapewni to poprawne działanie wszelkich odnośników do postów.
                            </li>
                            <li>Sprawdź, czy kod CSS oraz JS jest zminimalizowany, oraz czy wszystkie grafiki są zoptymalizowane. Przydatnym narzędziem może okazać się <i><a href="https://developers.google.com/speed/pagespeed/insights/" rel="nofollow">Google PageSpeed Insights</a></i> oraz <i><a href="https://varvy.com/" rel="nofollow">Varvy SEO Audit Tool</a></i> wraz z <i><a href="https://gtmetrix.com/" rel="nofollow">GTXmetrix Website Speed Test</a></i>.</li>
                            <li>Sprawdź, czy strona działa poprawnie!</li>
                            <br>
                            <li>Wyłącz oraz usuń wtyczkę <i>WP Maintenance Mode</i>. Wszystko gotowe!</li>
                            <br>
                        </ol>
                    </div>
                    <div class="panel-footer"><i>Ostatnia aktualizacja: 24-02-2018</i></div>
                </div>
            </div>

            <!-- Przenoszenie strony z jednego dostawcy do drugiego (domena + serwer) -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse_6996882225">
                        <b>Przenoszenie strony z jednego dostawcy do drugiego (domena + serwer)</b>
                        <span class="label label-primary pull-right">Procedura</span>
                    </a>
                </div>
                <div id="collapse_6996882225" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ol>
                            <li>Całkowity backup zawartości witryny na serwerze starym, całkowity backup zawiera także bazy MySQL, konta email, etc...</li>
                            <li>Set-up domeny na nowym serwerze, odtworzenie danych z backupu, zawartości kont email, stworzenie skrzynek i użytkowników odpowiadających tym na starym koncie.</li>
                            <li>Skierowanie MX na starym serwerze na nowy serwer w celu przekierowania poczty</li>
                            <li>Zmiana informacji DNS w serwisie rejestrujacym domene</li>
                            <li>Kilkanascie godzin oczekiwania na zmiane dns po sieci - tzw propagacja</li>
                            <li>Po przeniesieniu DNS, sprawdzenie jeszcze konta email na starym serwerza "na wszelki" by wylapac zablakane wiadomosci email</li>
                            <li>Usunięcie konta ze starego serwera.</li>
                        </ol>
                        <br>
                        <i>~ based on <a href="http://forum.webhelp.pl/hosting-www-i-domeny/bezbolesne-przeniesienie-domen-na-inny-t43252.html" target="_blank" rel="nofollow">forum.webhelp.pl</a></i>
                        <hr>
                        Opis przeniesienia domeny od operatora do OVH: <a href="https://www.ovh.pl/g1349.transfert-nom-de-domaine-generique" target="_blank" rel="nofollow">ovh.pl/[...]</a>
                    </div>
                    <div class="panel-footer"><i>Ostatnia aktualizacja: 17-03-2018</i></div>
                </div>
            </div>
            
        </div>
        <!-- KONIEC PROCEDUR -->

        <!-- POMOC & FAQ -->
        <div id="help" class="tab-pane fade">
            <hr>
            <div class="alert alert-info">
                W tej zakładce znajdują się pomoce oraz FAQ.
            </div>

        <h3>WebDev - Uruchamianie stron, migracja, konfiguracja Wordpress, itd...</h3>

        <!-- Przyspieszenie Wordpress'a -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse_6639328341">
                    <b>Przyspieszenie Wordpress'a</b>
                    <span class="label label-warning pull-right">Optymalizacja</span>
                </a>
            </div>
            <div id="collapse_6639328341" class="panel-collapse collapse">
                <div class="panel-body">
                    <ol>
                        <li><b>"EWWW Image Optimizer"</b> (for lossless image compression) / Compress JPEG and PNG images by TinyPNG</li>
                        <li><b>"Fast Velocity Minify"</b> (for JS, CSS & HTML minification and reordering)</li>
                        <li><b>"WP-SuperCache"</b> (for static HTML generation)</li>
                        Be sure to check the Compress Pages and Cache Rebuild options.
                        <li><b>"Remove Query Strings from Static Resources"</b> (self-explained)</li>
                        <hr>
                        That’s it, 4 plugins will give you a much faster site, provided your hosting solution is adept enough.
                        <br>Test Site => Before: 1.32s ( 1.2 MB )
                        <br>Test Site => After: 0.91s ( 1.2 MB )
                        <br><i>~ based on <a href="http://www.wpthemedetector.com/speed-up-your-wordpress-site-with-minimal-plugins/" rel="nofollow">wpthemedetector.com</a></i>. Tested by Pingdom Tools.
                    </ol>
                </div>
                <div class="panel-footer"><i>Ostatnia aktualizacja: 17-03-2018</i></div>
            </div>
        </div>
        
        <!-- Kompresja stron w locie - GZip -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse_9487497935">
                    <b>Kompresja stron w locie - GZip</b>
                    <span class="label label-warning pull-right">Optymalizacja</span>
                </a>
            </div>
            <div id="collapse_9487497935" class="panel-collapse collapse">
                <div class="panel-body">
                    <ol>
                        <li class="bold">Server Settings</li>
                            Create file with <i>phpinfo();</i>  and check if <b>mod_gzip</b> or <b>mod_deflate</b> modules are listed and are enabled.
                            <br/><i>TIP: Search 'gzip' and 'deflate' words. Also check '_SERVER["HTTP_ACCEPT_ENCODING"]' param.</i>
                            <hr/>
                            If enabled, just add this to .htaccess (proserwer hosting):
<blockquote>
<pre>
<code>
&lt;IfModule mod_deflate.c&gt;
SetOutputFilter DEFLATE
&lt;/IfModule&gt;
</code>
</pre>
</blockquote>

                        <li class="bold">Wordpress</li>
                            Just install <b>W3 Total Cache</b> or <b>WP-SuperCache</b> plug-in.
                    </ol>
                </div>
                <div class="panel-footer"><i>Ostatnia aktualizacja: 17-03-2018</i></div>
            </div>
        </div>

        <!-- Statusy DNS domeny we who.is -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse_6203875754">
                    <b>Statusy DNS domeny we who.is</b>
                    <span class="label label-success pull-right">Domeny</span>
                </a>
            </div>
            <div id="collapse_6203875754" class="panel-collapse collapse">
                <div class="panel-body">
                    <li><b>OK / X</b> - jest to normalny status domeny, o ile nie są na niej wykonywane żadne operacje, bądź nie zostały na nią nałożone żadne ograniczania.</li>
                    <li><b>Hold</b> - status, który otrzymują domeny, o ile nie podano przy nich przynajmniej dwóch nazw serwerów DNS.</li>
                    <li><b>Pending Delete-Restorable</b> - status oznacza, iż domena wygasła i rozpoczął się dla niej grace period (dodatkowy okres). Nazwa domeny uzyskuje także status hold, który blokuje wszystkie powiązane z nią usługi Internetowe. Nie mogą być wykonane żadne operacje na domenie, nie może ona być odnowiona, skasowana, przetransferowana, ani w żaden sposób zaktualizowana. Kontaktując się z rejestratorem, można wprowadzić specjalną procedurę odzyskania domeny, która wiąże się jednak z dodatkowymi kosztami.</li>
                    <li><b>Pending Delete-Scheduled for Release</b> - status oznaczający, iż zbliża się koniec okresu grace period i domena trafi do puli domen wolnych w ciągu 5 dni. Nazwa domeny nie może być odnowiona, odzyskana, skasowana, przetransferowana ani w jakikolwiek sposób zaktualizowana.</li>
                    <li><b>Pending Transfer</b> - status oznaczający, iż rozpoczęto procedurę transferu domeny. Nie mogą być przeprowadzane żaden operacje na domenie. </li>
                    <li><b>Delete Prohibited</b> - nazwa domeny nie może być skasowana.</li>
                    <li><b>Renew Prohibited</b> - domena nie może zostać odnowiona.</li>
                    <li><b>Update Prohibited</b> - domena nie może być zaktualizowana.</li>
                    <li><b>Transfer Prohibited</b> - domena nie może być przetransferowana. Taki status domena posiada w ciągu 60 dni od daty rejestracji.</li>
                    <li><b>Inactive</b> - zazwyczaj status ten oznacza brak odpowiednio skonfigurowanych z domeną serwerów.</li>
                </div>
                <div class="panel-footer"><i>Ostatnia aktualizacja: 17-03-2018</i></div>
            </div>
        </div>

        <!-- Jak uzyskać 100/100 punktów w Google PageSpeed Insights -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse_9656154892">
                    <b>Jak uzyskać 100/100 punktów w Google PageSpeed Insights</b> <span class="label label-warning pull-right">Optymalizacja</span>
                </a>
            </div>
            <div id="collapse_9656154892" class="panel-collapse collapse">
                <div class="panel-body">
                    <p><b>Google PageSpeed Insights</b> to narzędzie, które dla wielu osób jest (często jedynym słusznym) wyznacznikiem jakości i szybkości działania strony internetowej. Nie jest to do końca prawda, ale faktem jest, że przedstawiany na stupunktowej skali wynik daje obraz tego, jak szybka jest nasza strona i co można zrobić, aby była szybsza.</p>
                    <p>Maksymalny wynik <b>100 punktów w teście PageSpeed Insights</b> to marzenie niejednego właściciela serwisu internetowego. I mimo że jest to tylko „sztuka dla sztuki”, to w tym wpisie na konkretnym przykładzie pokażę, jak można taki wynik osiągnąć.</p>
                    
                    <div class="alert alert-info">
                        Wynik testu PageSpeed Insights zależy od bardzo wielu czynników, z których większość omawiam w tym wpisie. Nie gwarantuję jednak, że wykonanie wszystkich opisanych tu czynności odniesie dokładnie taki sam skutek w każdym przypadku i będzie wystarczające do uzyskania podobnego wyniku.
                    </div>
                    
                    <h2>Czym jest narzędzie Google PageSpeed?</h2>
                    <p>PageSpeed Insights to stworzone przez firmę Google narzędzie do mierzenia wydajności stron internetowych. Bada ono każdą stronę dwukrotnie: pod kątem urządzeń mobilnych (mobile) i pod kątem „zwykłych” komputerów (desktop). Wynik obu tych testów jest przedstawiany na 100-punktowej skali – im wyższy wynik, tym lepiej.</p>
                    <p>Badanie wydajności jest wykonywane za pomocą <a href="https://developers.google.com/speed/docs/insights/rules?hl=pl" target="_blank" rel="nofollow">zestawu specjalnych reguł</a>. Niektóre z nich są ważniejsze od innych, przez co ich spełnienie daje naszej stronie więcej punktów. Mimo że wspomniane reguły są dość dobrze opisane w dokumentacji narzędzia, to nie wszyscy wiedzą co należy zrobić, aby daną regułę spełnić.</p>
                    <p>Raport, jaki otrzymujemy wraz z liczbowym wynikiem testu, pokazuje reguły, które są przestrzegane na naszej stronie oraz listę problemów, które na niej występują (nieprzestrzegane reguły). Czerwonym wykrzyknikiem oznaczono najistotniejsze problemy, których usunięcie może mieć duży wpływ na szybkość naszej strony (a więc i na wynik testu). Żółty wykrzyknik oznacza problemy, które warto usunąć – nie spodziewajmy się po nich wielkiego skoku wyniku testu, ale jeśli chcemy wycisnąć komplet punktów, to i nimi powinniśmy się zająć.</p>
                    <p>Warto dodać, że PageSpeed Insights nie bierze pod uwagę aspektów działania strony, które są zależne od wydajności sieci, głównie dlatego, że praktycznie nigdy nie jest ona stała. Brane są natomiast pod uwagę takie czynniki, jak konfiguracja i wydajność serwera, na którym działa nasza strona, struktura kodu HTML oraz sposób, w jaki strona korzysta z zasobów zewnętrznych, takich jak pliki graficzne, skrypty JavaScript czy arkusze stylów CSS.</p>
                    
                    <h2>Jaki wynik PageSpeed Insights jest dobry?</h2>
                    <p>Stronę można uznać za działającą dobrze, gdy w obu testach <b>osiągnie co najmniej 85 punktów</b>. Wbrew pozorom nie jest to wynik trudny do osiągnięcia. Test dla urządzeń mobilnych jest nieco bardziej wymagający, tak więc zwykle to właśnie w nim ciężej jest osiągnąć dobry wynik.</p>

                    <h2>Przygotowanie strony testowej</h2>
                    <p>Testy wykonywałem tylko dla strony głównej serwisu. Większość z wykonanych przeze mnie działań będzie miała oczywiście pozytywny wpływ również na podstrony, ale może się zdarzyć, że optymalizacja poszczególnych typów podstron będzie wymagać dodatkowych zabiegów. Kilka zdań na ten temat napisałem w podsumowaniu, które znajduje się na końcu wpisu.</p>
                    <p>Prace zacząłem od instalacji najnowszej wersji WordPressa (w chwili pisania tego wpisu była nią wersja 4.4.2) i na aktywowaniu najnowszej wersji aktualnego domyślnego motywu Twenty Sixteen. Aby strona nie była pusta, zaimportowałem oficjalne dane testowe wraz z obrazkami – nie są one idealne, ale lepszych w tej chwili chyba nie ma.</p>
                    <p>Pora na pierwszy test narzędziem PageSpeed Insights. Wynik zaskoczył mnie nieco – pozytywnie, bo wcale nie był taki zły. 71 punktów w teście dla urządzeń mobilnych i 83 punkty w teście dla komputerów.</p>
                    <p><img src="img/Help/GooglePageSpeed1.png" alt="Google PageSpeed" class="img img-thumbnail"></p>
                    <p>Oczywiście nikt nie kończy w tym miejscu budowy swojej strony – zawsze instalowane są dodatkowe wtyczki, które często dokładają własne skrypty JavaScript i arkusze stylów CSS, a czasem także kod HTML. Zainstalowałem więc następujące rozszerzenia:</p>
                    <ul>
                        <li><a href="https://wpzen.pl/wordpress-seo-przewodnik-po-konfiguracji/">Yoast SEO</a> – popularna wtyczka wspomagająca optymalizację stron pod kątem SEO</li>
                        <li><a rel="nofollow" target="_blank" href="https://wordpress.org/plugins/google-analytics-for-wordpress/">Google Analytics by Yoast</a> – wtyczka ułatwiająca instalację i konfigurację kodów śledzących dla Google Analytics</li>
                        <li><a href="https://wpzen.pl/contact-form-7-zaawansowane-formularze-kontaktowe-w-wordpressie/">Contact Form 7</a> – rozszerzenie pozwalające na tworzenie formularzy; stworzyłem jeden formularz, który umieściłem w panelu bocznym</li>
                        <li><a rel="nofollow" target="_blank" href="https://wordpress.org/plugins/wp-retina-2x/">WP Retina</a> – wtyczka dodająca obsługę ekranów Retina do zdjęć wstawianych do wpisów</li>
                        <li><a href="https://wpzen.pl/tag/jetpack/">Jetpack</a> – znany kombajn z wieloma modułami (aktywowane najpopularniejsze moduły: Carousel, Custom CSS, Enhanced Distribution, Extra Sidebar Widgets, Omnisearch, Protect, Publicize, Related Posts, Sharing, Tiled Galleries i Widget Visibility)</li>
                    </ul>
                    <p>Do pierwszego wpisu wstawiłem dodatkowo film z serwisu YouTube w taki sposób, aby był widoczny na stronie głównej mojego testowego serwisu. Za chwilę wyjaśnię dlaczego to zrobiłem.</p><p><img src="img/Help/GooglePageSpeed2.png" alt="Google PageSpeed" class="img img-thumbnail"></p>
                    <p>Jak widać, wynik znacznie się pogorszył – 58 punktów w wersji mobilnej i 74 punkty w wersji desktopowej. To już jest coś, nad czym można pracować. Stwierdziłem, że taki stan strony jest wystarczający i uznałem go za punkt wyjściowy do optymalizacji pod kątem uzyskania jak najlepszego wyniku w teście PageSpeed Insights.</p>

                    <h2>Optymalizacja strony</h2>
                    <p>
                        Po wykonaniu testu PageSpeed Insights należy odczekać 30 sekund przed wykonaniem kolejnego.
                    </p>
                    <h3>Skróć czas odpowiedzi serwera</h3>
                    <p>
                        Na pierwszy ogień wybrałem regułę, która jest stosunkowo łatwa do spełnienia – najczęściej wystarczy skorzystać z wtyczki cache. Ja (jak praktycznie zawsze) wybrałem <a href="https://wpzen.pl/przyspieszanie-strony-za-pomoca-wtyczki-wp-super-cache/">WP Super Cache</a> i skonfigurowałem ją zgodnie z <a href="https://wpzen.pl/przyspieszanie-strony-za-pomoca-wtyczki-wp-super-cache/">własnym poradnikiem</a>. Zgodnie z moimi oczekiwaniami, reguła została spełniona i zniknęła z listy „Warto poprawić”, ale wynik poprawił się o zaledwie <strong>jeden punkt</strong>.
                    </p>
                    <h3>Wykorzystaj pamięć podręczną przeglądarki</h3>
                    <p>
                        Ta reguła oznaczona jest jako bardzo ważna dla urządzeń mobilnych. Rzecz polega na ustawieniu odpowiednich nagłówków HTTP dla plików (<code>Expires</code>), które powinny być trzymane przez dłuższy czas w cache przeglądarki użytkownika. Niektóre wtyczki cache (np. W3 Total Cache czy Zencache) posiadają wbudowaną odpowiednią funkcję, którą wystarczy po prostu włączyć. Poza tym większość firm hostingowych domyślnie ustawia odpowiednie nagłówki, tak więc nie musimy się w ogóle o to martwić.
                    </p>
                    <p>
                        Najprostszą metodą na dodanie nagłówków <code>Expires</code> jest dodanie do pliku <code>.htaccess</code> następującego kodu:
                    </p>
                    <textarea class="form-control" rows="16" readonly="readonly">
&lt;IfModule mod_expires.c&gt;
ExpiresActive On
ExpiresDefault "access plus 1 month"
ExpiresByType text/html "access plus 1 seconds"
ExpiresByType image/gif "access plus 30 days"
ExpiresByType image/jpeg "access plus 30 days"
ExpiresByType image/png "access plus 30 days"
ExpiresByType image/jpg "access plus 30 days"
ExpiresByType image/svg+xml "access plus 30 days"
ExpiresByType text/css "access plus 30 days"
ExpiresByType text/javascript "access plus 30 days"
ExpiresByType application/javascript "access plus 30 days"
ExpiresByType application/x-javascript "access plus 30 days"
ExpiresByType text/xml "access plus 60 minutes"
&lt;/IfModule&gt;
                    </textarea>
                    <p>
                        Dodanie nagłówków <code>Expires</code> poprawiło wynik PageSpeed Insights o jeden punkt w teście dla urządzeń mobilnych i o dwa punkty w teście dla komputerów.
                    </p>
                    <p>
                        Jednak żeby nie było zbyt pięknie, na liście zasobów, które nie mają odpowiednich nagłówków lub mają ustawiony zbyt krótki „czas życia”, pozostało kilka pozycji:
                    </p>
                    <p>
                        <img src="img/Help/GooglePageSpeed3.png" alt="Google PageSpeed" class="img img-thumbnail">									
                    </p>
                    <p>
                        Trzy pierwsze to pliki z serwisu <a rel="nofollow" target="_blank" href="https://pl.gravatar.com/">Gravatar</a>, czwarty to skrypt zarządzający reklamami w filmach z YouTube, a ostatni to znany wszystkim skrypt Google Analytics. Co możemy z tym zrobić, skoro wszystkie te pliki znajdują się na zewnętrznych serwerach i nie mamy żadnego wpływu na ich nagłówki?
                    </p>
                    <p>
                        <strong>Zacznijmy od Gravatara</strong>. Możemy oczywiście wyłączyć obsługę awatarów z tego serwisu, ale nie tędy droga. Najlepszym rozwiązaniem jest pobieranie awatarów na nasz serwer, dzięki czemu zostaną do nich dodane takie nagłówki, jak do wszystkich innych plików graficznych. Oczywiście nie będziemy robić tego ręcznie – z pomocą przyjdzie nam wtyczka <a rel="nofollow" target="_blank" href="https://wordpress.org/plugins/harrys-gravatar-cache/">Harrys Gravatar Cache</a>, która automatycznie zapisze na naszym serwerze wszystkie awatary i podmieni odpowiednie adresy URL plików. Rozszerzenie ma kilka opcji (<em>Ustawienia → Harrys Gravatar Cache Settings</em>), ale domyślna konfiguracja powinna działać bez problemów. Jedyną opcją, którą warto się zainteresować, jest <em>Current Copy Option</em>, którą w razie problemów z pobieraniem awatarów warto ustawić na <em>WordPress Filesystem</em>.
                    </p>
                    <p>
                        Trick z Gravatarem poprawił wynik w teście dla urządzeń mobilnych o kolejne dwa punkty, a w teście dla komputerów o jeden punkt.
                    </p>
                    <p>
                        <strong>Na drugi ogień wziąłem skrypt Google Analytics</strong>. Podobnie jak w przypadku plików z serwisu Gravatar, jedyną możliwością usunięcia tego problemu, jest trzymanie skryptu <code>analytics.js</code> na naszym serwerze. Teoretycznie nie powinniśmy tego robić, bo Google modyfikuje go bez ostrzeżenia, ale <a rel="nofollow" target="_blank" href="https://developers.google.com/analytics/devguides/collection/analyticsjs/changelog">w praktyce</a> nie dzieje się to aż tak często. Z pomocą przyszła wtyczka <a rel="nofollow" target="_blank" href="https://wordpress.org/plugins/cache-external-scripts/">Cache External Scripts</a>, która automatycznie pobiera plik <code>analytics.js</code>, zapisuje go na naszym serwerze i podmienia odpowiedni adres URL w kodzie śledzenia Google Analytics. Problem rozwiązany.
                    </p>
                    <p>
                        <strong>Gorzej wygląda jednak kwestia skryptu <code>ad_status.js</code></strong>, który jest powiązany z osadzonym na naszej stronie filmem z YouTube. Nie możemy zastosować takiego samego sposobu, co w przypadku skryptu <code>analytics.js</code>, ponieważ ten skrypt jest ładowany z wewnątrz ramki <code>iframe</code>, w której znajduje się film. Wpadłem więc na pomysł, aby skorzystać z techniki <strong>lazy loading</strong>, czyli w tym przypadku z ładowania filmu dopiero po kliknięciu w niego. Na coś takiego pozwala na przykład wtyczka <a rel="nofollow" target="_blank" href="https://pl.wordpress.org/plugins/lazy-load-for-videos/faq/">Lazy Load for Videos</a>, która obsługuje filmy z serwisów YouTube i Vimeo. I rzeczywiście – problem ze skryptem <code>ad_status.js</code> zniknął, ale za to… pojawił się analogiczny problem z miniaturą filmu, pobieraną z domeny <code>ytimg.com</code>. Teoretycznie dałoby się pobierać obrazki z tej domeny na nasz serwer i ładować nasze kopie, ale wymagałoby to dość dużych modyfikacji wtyczki. Dałem sobie więc z tym spokój i zastosowałem metodę, która od początku mi się nie podobała, ale którą jednocześnie uważałem za jedyną, która się sprawdzi – czyli przeniosłem film za znacznik <code>&lt;!--more--&gt;</code>, dzięki czemu nie jest on widoczny na stronie głównej, a dopiero na stronie wpisu. Natomiast w normalnej sytuacji po prostu <strong>zignorowałbym ten problem</strong>.
                    </p>
                    <p>
                        Innym sposobem na pozbycie się problemu ładowania obrazków z zewnętrznych serwerów jest skorzystanie z lazy loadingu dla obrazków, dzięki czemu ładowane będą tylko te obrazki, które są widoczne. To jednak nie załatwi problemu tych obrazków, które są umieszczone u góry strony, przez co są cały czas widoczne, ponieważ zostaną one załadowane od razu.
                    </p>
                    <p>
                        Tak na marginesie: używanie wspomnianej wtyczki <strong>Lazy Load for Videos</strong> jest dobrym pomysłem, bo znacząco skraca ona czas ładowania stron z osadzonymi filmami.
                    </p>
                    <p>
                        Zabiegi związane ze skryptami <code>analytics.js</code> i <code>ad_status.js</code> poprawiły wynik PageSpeed Insights o osiem punktów w teście dla urządzeń mobilnych i o pięć punktów w teście dla komputerów. Warto dodać, że pozbycie się filmu YouTube z widocznego po załadowaniu strony obszaru (above the fold) rozwiązało również problem z regułą <strong>Nadaj priorytet widocznej treści</strong>.
                    </p>
                    <p>
                        Wszystkie wykonane do tej pory prace zaowocowały podniesieniem wyniku do 70 punktów w teście dla urządzeń mobilnych i 84 punktów w teście dla komputerów.
                    </p>
                    <p>
                        <img src="img/Help/GooglePageSpeed4.png" alt="Google PageSpeed" class="img img-thumbnail">
                    </p>
                    <h3>Włącz kompresję</h3>
                    <p>
                        Kolejny łatwy do usunięcia problem i kolejne zaskoczenie, jakie mnie spotkało. Podobnie jak w przypadku nagłówków <code>Expires</code>, większość firm hostingowych domyślnie kompresuje pliki po stronie serwera. Jeśli jednak nasza firma tego nie robi, wystarczy do pliku <code>.htaccess</code> dodać kilka linii:
                    </p>
<textarea class="form-control" rows="13" readonly="readonly">
AddOutputFilterByType DEFLATE text/plain
AddOutputFilterByType DEFLATE text/html
AddOutputFilterByType DEFLATE text/xml
AddOutputFilterByType DEFLATE application/x-httpd-php
AddOutputFilterByType DEFLATE text/css
AddOutputFilterByType DEFLATE application/xml
AddOutputFilterByType DEFLATE application/xhtml+xml
AddOutputFilterByType DEFLATE application/rss+xml
AddOutputFilterByType DEFLATE application/javascript
AddOutputFilterByType DEFLATE application/x-javascript
AddOutputFilterByType DEFLATE font/otf
AddOutputFilterByType DEFLATE font/ttf
</textarea>
                    <p>
                        Włączamy w ten sposób kompresję plików tekstowych za pomocą modułu <code>mod_deflate</code>. <strong>Nie ma sensu włączać kompresji dla innych typów plików</strong>, na przykład obrazków czy filmów, bo nic nam to nie da, a tylko obciąży niepotrzebnie serwer. Jeśli nasz serwer nie ma zainstalowanego modułu <code>mod_deflate</code>, możemy skorzystać z kompresji gzip:
                    </p>
<textarea class="form-control" rows="11" readonly="readonly">
&lt;ifModule mod_gzip.c&gt;
mod_gzip_on Yes
mod_gzip_dechunk Yes
mod_gzip_item_include file .(html?|txt|css|js|php|pl)$
mod_gzip_item_include handler ^cgi-script$
mod_gzip_item_include mime ^text/.*
mod_gzip_item_include mime ^application/x-javascript.*
mod_gzip_item_exclude mime ^image/.*
mod_gzip_item_exclude rspheader ^Content-Encoding:.*gzip.*
&lt;/ifModule&gt;
</textarea>
                    <p>
                        I teraz wspomniane na początku zaskoczenie. Firma hostingowa, z której usług korzystam (nie napiszę jaka – zainteresowani sami sobie znajdą) ma włączoną na swoich serwera kompresję gzip dla plików tekstowych, ale nie dla plików SVG, które tak naprawdę również są plikami tekstowymi (zawierają kod XML). Problem w tym, że zarówno wybrany przeze mnie motyw (Twenty Sixteen), jak i wtyczka Jetpack, korzystają z icon fonta <a rel="nofollow" target="_blank" href="http://genericons.com/">Genericons</a>, który ładuje spory, bo ważący 77 kB, plik <code>Genericons.svg</code>. I był to jedyny powód, dla którego reguła <strong>Włącz kompresję</strong> nie była spełniona. Niestety, samodzielne włączenie kompresji przy użyciu jednego z pokazanych wyżej sposobów, okazło się niemożliwe – konfiguracja serwera na to nie pozwalała.
                    </p>
                    <p>
                        Po krótkiej korespondencji ze wsparciem firmy otrzymałem zapewnienie, że temat został przekazany administratorom i pliki SVG będą kompresowane. Ja jednak nie miałem czasu na czekanie, więc postanowiłem obejść jakoś ten problem.
                    </p>
                    <p>
                        Napisałem krótki skrypt, który otwiera plik, pobiera jego zawartość, kompresuje ją za pomocą gzip i zwraca do przeglądarki. Kod skryptu zapisałem w pliku <code>/wp-content/compress.php</code>:
                    </p>
<textarea class="form-control" rows="12" readonly="readonly">
&lt;?php
ob_start('ob_gzhandler');
$file = isset($_REQUEST['file']) ? $_REQUEST['file'] : null;
if(!empty($file)) {
$file = $_SERVER['DOCUMENT_ROOT'].'/'.$file;
if(pathinfo($file, PATHINFO_EXTENSION) == 'svg' &amp;&amp; file_exists($file) &amp;&amp; mime_content_type($file) == 'image/svg+xml') {
$content = file_get_contents($file);
echo $content;
}
}
ob_flush();
</textarea>
<p>
Następnie do <code>.htaccess</code> dodałem regułę przekierowującą do skryptu wszystkie żądania odwołujące się do plików SVG:</p>
<textarea class="form-control" rows="3" readonly="readonly">
RewriteCond %{REQUEST_URI} \.(svg)$
RewriteRule ^(.*) "/wp-content/compress.php?file=$1" [L]
</textarea>
<p>Tym sposobem reguła <strong>Włącz kompresję</strong> została spełniona, a wynik PageSpeed Insights podskoczył do 75 punktów w teście dla urządzeń mobilnych i do 88 punktów w teście dla komputerów.</p>
<p>Na koniec proszę: <strong>nie róbcie tego na własnych stronach</strong>. Poczekajcie na pomoc firmy hostingowej. Ten sposób działa, ale to tylko tymczasowe obejście, a nie rozwiązanie problemu. A na pewno nie próbujcie kompresować w ten sposób plików innych niż tekstowe – to łatwy sposób na obciążenie serwera, które w skrajnych przypadkach może skończyć się blokadą strony.</p>
<h3>Zoptymalizuj obrazy</h3>
<p>Następny łatwy do usunięcia problem. Wystarczy skorzystać z wtyczki <a rel="nofollow" target="_blank" href="https://pl.wordpress.org/plugins/wp-smushit/">WP Smush</a>, która automatycznie wykona bezstratną optymalizację obrazków znajdujących się w bibliotece mediów. Warto ją zainstalować jeszcze zanim zaczniemy ładować obrazki, ponieważ wtyczka działa „w tle” i optymalizuje obrazki podczas ich przesyłania do WordPressa. Jeśli zainstalujemy ją później, będziemy musieli wykonać masową optymalizację, która jest możliwa, ale w darmowej wersji wtyczki ograniczona do 50 obrazków na raz.</p>
<p>Kiedyś <a href="https://wpzen.pl/prizm-image-automatyczna-optymalizacja-wielkosci-obrazkow/">polecałem</a> działającą na podobnej zasadzie wtyczkę <a href="https://wpzen.pl/prizm-image-automatyczna-optymalizacja-wielkosci-obrazkow/">Prizm Image</a>, ale przez pewien czas serwery, z których korzysta, działały tak niestabilnie, że byłem zmuszony przesiąść się na alternatywne rozwiązanie.</p>
<p>Jeśli okaże się, że po optymalizacji PageSpeed Insights wciąż wskazuje jakieś obrazki jako niezoptymalizowane, można pobrać zoptymalizowane przez Google wersje plików i przesłać je przez SFTP na nasz serwer. Aby to zrobić wystarczy kliknąć znajdujący się pod raportem z testu link <strong>Pobierz zoptymalizowane obrazy oraz zasoby JavaScript i CSS dla tej strony</strong>.</p>
<p>Co ciekawe, optymalizacja obrazków nie przyniosła w moim przypadku żadnej zmiany w wyniku PageSpeed Insights. Stało się tak prawdopodobnie dlatego, że zysk z optymalizacji był niewielki (7%), a na stronie znajduje się niewiele obrazków.</p>
<h3>Zmniejsz CSS, Zmniejsz JavaScript i Zmniejsz HTML</h3>
<p>Kolejną czynnością, którą wypada zrobić nie tylko podczas walki o każdy punkt w PageSpeed Insights, jest kompresja (minifikacja) i złączenie w jeden plik skryptów JavaScript oraz arkuszy stylów CSS, a także kompresja samego dokumentu HTML (czyli właściwego kodu naszej strony). Wtyczek, które to umożliwiają, jest sporo, ale ja wybrałem <a rel="nofollow" target="_blank" href="https://pl.wordpress.org/plugins/autoptimize/">Autoptimize</a>, ponieważ ma ona wszystkie opcje, jakich potrzebowałem. Wtyczka spełnia swoje zadanie już przy domyślnych ustawieniach, ale warto pogrzebać chwilę w jej konfiguracji (<em>Ustawienia → Autoptimize</em>).</p>
<p>Włączyłem tylko następujące opcje:</p>
<ul>
<li>Optymalizuj kod HTML</li>
<li>Optymalizuj kod JavaScript</li>
<li>Wymuś JavaScript w &lt;head&gt;</li>
<li>Optymalizuj kod CSS</li>
<li>Zapisz połączony skrypt/CSS jako plik statyczny</li>
</ul>
<p>W moim przypadku wszystko poszło bezboleśnie, ale może się zdarzyć, że coś na stronie przestanie działać. Wtedy najczęściej wystarczy wykluczyć skrypt JavaScript, który po złączeniu z innymi przestał działać, w konfiguracji Autoptimize (opcja <em>Skrypty wyłączone z Autoptimize</em>).</p>
<p>Niektórzy polecają wykluczyć ze złączania bibliotekę jQuery, ale w tym konkretnym przypadku nie był to dobry pomysł (jQuery ładowała się później, niż plik ze złączonymi skryptami, tak więc wszystko przestawało działać). Może to być jednak konieczne, jeśli jakieś używamy wtyczek, które wstawiają własny kod JavaScript do kodu HTML strony.</p>
<p>Warto zwrócić uwagę, że ta kompresja (minifikacja) nie ma nic wspólnego z kompresją, którą włączaliśmy przy okazji reguły <strong>Włącz kompresję</strong>. Minifikacja polega na usunięciu z kodu strony zbędnych rzeczy, takich jak komentarze czy znaki końca linii.</p>
<p>Co ciekawe, ten krok nie przyniósł żadnej zmiany w wyniku PageSpeed Insights dla urządzeń mobilnych, ale za to w teście dla komputerów strona dostała kolejne trzy punkty.</p>
<h3>Wyeliminuj blokujący renderowanie kod JavaScript i CSS z części strony widocznej na ekranie</h3>
<p>To jedna z dwóch reguł, która sprawia najwięcej kłopotów. Przede wszystkim dlatego, że jej opis jest nieco enigmatyczny i na początku nie bardzo wiadomo co należy zrobić, aby pozbyć się tego problemu.</p>
<p>Na liście problematycznych (blokujących renderowanie strony) skryptów JavaScript i arkuszy stylów CSS znajdziemy pliki złączone przez Autoptimize oraz (co gorsze) fonty z <strong>Google Fonts</strong>, których używa motyw Twenty Sixteen. Niestety, aby to wszystko naprawić będziemy musieli pogrzebać trochę w kodzie. Zakładam, że korzystamy z <a href="https://wpzen.pl/motywy-potomne-czym-sa-dlaczego-nie-trzeba-ich-uzywac/">motywu potomnego</a> i nie dotykamy w ogóle plików motywu głównego. Wszystkie modyfikacje wrzucamy do pliku <code>functions.php</code> znajdującego się w katalogu motywu potomnego.</p>
<p><strong>Zaczniemy od pliku ze złączonymi skryptami JavaScript</strong>. Aby przestał on blokować renderowanie strony wystarczy załadować go asynchronicznie, czyli w taki sposób, aby przeglądarka nie czekała z wyświetleniem strony na jego załadowanie. Możemy to zrobić dodając do znacznika <code>&lt;script&gt;</code> atrybut <code>async</code>. Oczywiście nie będziemy robili tego ręcznie w kodzie HTML, bo tak się w WordPressie po prostu nie da. Na szczęście Autoptimize oferuje filtr, za pomocą którego możemy dodać ten atrybut do znacznika ładującego plik ze złączonymi skryptami JavaScript. Robimy to w ten sposób (trzeba pamiętać o spacji po ciągu „async”):
</p>
<textarea class="form-control" rows="5" readonly="readonly">
function wpzen_defer() {
return 'async ';
}
add_filter('autoptimize_filter_js_defer', 'wpzen_defer');
</textarea>
<p>Niestety, takie asynchroniczne ładowanie skryptów JavaScript ma też swoje wady. Najczęściej problemy występują na stronach, gdzie skrypty JavaScript są niezbędne do ich działania. Często możemy też zaobserwować niezbyt dobrze wyglądające opóźnienie w inicjalizacji skryptów, które wynika z tego, że strona (kod HTML) jest już wyświetlona, a skrypty JS jeszcze się nie załadowały, więc nie zrobiły swojej roboty. Wszystko tu zależy od konkretnego przypadku, ale dobrze stworzona strona nie powinna się całkowicie od tego rozsypać.</p>
<p><strong>Teraz trzeba zrobić coś z fontami Google Fonts</strong>. Ponieważ są one ładowane jako arkusze stylów CSS, nie możemy ich załadować asynchronicznie (tak jak to zrobiliśmy ze skryptami JavaScript). W ustawieniach Autoptimize możemy globalnie (dla całej strony) wyłączyć ładowanie Google Fonts – wystarczy zaznaczyć opcję <em>Usunąć Google Fonts</em>. Tyle że w tym momencie nasza piękna typografia przestaje być taka piękna i wszystkie teksty są wyświetlane przy użyciu domyślnych fontów. Na szczęście istnieje biblioteka <a rel="nofollow" target="_blank" href="https://github.com/typekit/webfontloader">Web Font Loader</a>, która potrafi między innymi ładować fonty w sposób nie blokujący renderowania strony.</p>
<p>Najpierw musimy sprawdzić jakich fontów używa nasz motyw. Najprościej jest zajrzeć do narzędzi deweloperskich w przeglądarce i skopiować adres URL ładowanego z domeny <code>fonts.googleapis.com</code> arkusza stylów. W przypadku motywu Twenty Sixteen URL ten wygląda tak:</p>
<textarea class="form-control" rows="4" readonly="readonly">
https://fonts.googleapis.com/css?family=Merriweather%3A400%2C700%2C900%2C400italic%2C700italic%2C900italic%7CMontserrat%3A400%2C700%7CInconsolata%3A400&amp;subset=latin%2Clatin-ext
</textarea>
<p>a po „zdekodowaniu” tak:</p>
<textarea class="form-control" rows="2" readonly="readonly">
https://fonts.googleapis.com/css?family=Merriweather:400,700,900,400italic,700italic,900italic|Montserrat:400,700|Inconsolata:400&amp;subset=latin,latin-ext
</textarea>
<p>Teraz łatwo możemy wyciągnąć z niego nazwy i warianty fontów, które musimy samodzielnie załadować przy użyciu Web Font Loadera.</p>
<p>Aby skorzystać z biblioteki wystarczy do pliku <code>functions.php</code> wstawić taki kod:</p>
<textarea class="form-control" rows="21" readonly="readonly">
function wpzen_load_google_fonts_script() {
wp_enqueue_script('webfont-loader', '//ajax.googleapis.com/ajax/libs/webfont/1.5.18/webfont.js');
}
add_action('wp_enqueue_scripts', 'wpzen_load_google_fonts_script');

function wpzen_load_google_fonts_footer() {
?&gt;
&lt;script type="text/javascript"&gt;
WebFont.load({
google: {
families: ['Merriweather:400,700,900,400italic,700italic,900italic:latin,latin-ext',
            'Montserrat:400,700:latin,latin-ext',
            'Inconsolata:400:latin,latin-ext']
}
});
&lt;/script&gt;
&lt;?php
}
add_action('wp_footer', 'wpzen_load_google_fonts_footer');
</textarea>
<p>Funkcja <code>wpzen_load_google_fonts_script()</code> ładuje bibliotekę, a funkcja <code>wpzen_load_google_fonts_footer()</code> ładuje trzy wybrane przez nas fonty. Koniecznie trzeba zwrócić uwagę na format parametrów dla każdego z fontów – brak dwukropka czy przecinka spowoduje, że nic nie będzie działać. Oczywiście możemy tam sobie dodać dowolne inne fonty – biblioteka obsługuje również fonty z serwisów <strong>Typekit</strong>, <strong>Fontdeck</strong> i <strong>Fonts.com</strong>, a także własne fonty.</p>
<p>Na koniec powinniśmy wymusić asynchroniczne ładowanie biblioteki Web Font Loader – można to zrobić za pomocą takiej prostej funkcji:</p>
<textarea class="form-control" rows="12" readonly="readonly">
function wpzen_async_scripts($tag, $handle, $src) {
$async_scripts = array('webfont-loader');

if(in_array($handle, $async_scripts)) {
return '&lt;script type="text/javascript" src="'.$src.'" async="async"&gt;&lt;/script&gt;'."\n";
}

return $tag;
}
add_filter('script_loader_tag', 'wpzen_async_scripts', 10, 3);
</textarea>
<p>Funkcja ta może nam się jeszcze kiedyś przydać, na przykład gdy dodamy do strony kolejne zewnętrzne skrypty – wtedy wystarczy do tablicy <code>$acyns_scripts</code> dodać kolejną nazwę.</p>
<p>Wadą korzystania z tego sposobu ładowania zewnętrznych fontów jest możliwość występowania zjawiska zwanego <strong>Flash of Unstyled Text (FOUT)</strong>, czyli pojawienia się na krótką chwilę tekstu wyświetlanego domyślnym fontem. Efekt ten jest spowodowany tym, że strona może być wyrenderowana przez przeglądarkę jeszcze zanim fonty zostaną załadowane. Nie jest to jednak wielki problem, szczególnie że występuje tylko przy pierwszym otwarciu naszej strony przez użytkownika – przy kolejnych odsłonach pliki są pobierane z cache jego przeglądarki. Warto jednak dodać, że to zjawisko może występować również przy ładowaniu zewnętrznych fontów w „tradycyjny” sposób.</p>
<p>Został nam więc już tylko <strong>arkusz stylów CSS blokujący renderowanie strony</strong>. Podobnie jak w przypadku fontów, nie mamy możliwości załadowania go w sposób asynchroniczny. Teoretycznie da się to zrobić za pomocą JavaScript (np. korzystając z <a rel="nofollow" target="_blank" href="https://github.com/filamentgroup/loadCSS">loadCSS</a>), ale nie jest to zalecane dla krytycznych arkuszy stylów (a nasz taki właśnie jest – to w końcu złączone wszystkie pliki CSS). Moim pierwszym pomysłem było wykorzystanie wtyczki Autoptimize i jej opcji <em>Także łączyć razem CSS z treści strony?</em>, która wstawia całą zawartość plików CSS bezpośrednio do kodu HTML. Efekt na pierwszy rzut oka był pozytywny: problem zniknął z raportu PageSpeed Insights. Niestety, w jego miejsce pojawił się inny – <strong>Nadaj priorytet widocznej treści</strong>. No i oczywiście rozmiar dokumentu HTML powiększył się o mniej więcej 40 kB.</p>
<p>Warto jednak zauważyć, że <strong>wyniki testów poszybowały w górę</strong> (100 punktów w teście dla urządzeń mobilnych i 97 w teście dla komputerów).</p>
<p><img class="aligncenter size-large wp-image-12215" src="https://wpzen.pl/wp-content/uploads/2016/02/pagespeed-10-full-690x193.png" alt="PageSpeed Insights" srcset="https://wpzen.pl/wp-content/uploads/2016/02/pagespeed-10-full-690x193.png 690w, https://wpzen.pl/wp-content/uploads/2016/02/pagespeed-10-full-300x84.png 300w, https://wpzen.pl/wp-content/uploads/2016/02/pagespeed-10-full-420x117.png 420w, https://wpzen.pl/wp-content/uploads/2016/02/pagespeed-10-full-690x193@2x.png 1380w, https://wpzen.pl/wp-content/uploads/2016/02/pagespeed-10-full-300x84@2x.png 600w, https://wpzen.pl/wp-content/uploads/2016/02/pagespeed-10-full-420x117@2x.png 840w" sizes="(max-width: 479px) 250px, (max-width: 767px) 450px, (max-width: 1023px) 510px, 690px" width="690" height="193"></p>
<p>W normalnych warunkach uznałbym te wyniki za świetne i nie drążył dalej tematu. Jak już wspomniałem na wstępie, wynik powyżej 85 punktów jest uznawany za dobry. Ale moim celem nie było osiągnięcie dobrego wyniku, ale 100 punktów w obu testach.</p>
<p>Poza tym bardzo nie podobało mi się włączenie całego arkusza stylów CSS do kodu HTML.</p>
<h3>Nadaj priorytet widocznej treści</h3>
<p>Ta reguła mówi nam, że powinniśmy umożliwić przeglądarce jak najszybsze wyświetenie tej części strony, która jest zaraz po załadowaniu widoczna w oknie przeglądarki (tzw. above the fold). U mnie ten problem pojawił się gdy wrzuciłem cały arkusz stylów do kodu HTML strony, a to dlatego, że kodu CSS było tam po prostu o wiele za dużo.</p>
<p>Priorytetyzacja widocznej treści to dość szerokie zagadnienie, związane zarówno ze strukturą kodu HTML, jak i stylów CSS. Ale na szczęście istnieje coś, co pozwala w stosunkowo łatwy sposób osiągnąć cel – a jest to <strong>Critical Path CSS</strong>. W skrócie chodzi o umieszczenie na początku nagłówka strony (w sekcji <code>&lt;head&gt;</code>) tych stylów CSS, które są potrzebne do wyświetlenia widocznego fragmentu strony (są krytyczne dla naszego serwisu). Oczywiście ręczne wyodrębnianie takich stylów byłoby dość czasochłonne, dlatego powstały do tego specjalne narzędzia. Najprostsze w obsłudze są narzędzia online: <a rel="nofollow" target="_blank" href="https://jonassebastianohlsson.com/criticalpathcssgenerator/">Critical Path CSS Generator</a> i jego płatna, prostsza w obsłudze wersja – <a rel="nofollow" target="_blank" href="https://criticalcss.com/">Critical CSS</a>.</p>
<p><strong>Critical Path CSS Generator</strong> wymaga od nas podania adresu naszej strony i wklejenia całej zawartości arkusza stylów CSS. Po kliknięciu przycisku <em>Create Critical Path CSS</em> wygenerowany zostanie kod CSS, który trzeba umieścić na naszej stronie. Można to zrobić korzystając (znowu) z wtyczki Autoptimize – w jej ustawieniach znajdziemy opcję <em>Włączyć CSS w treść strony i opóźnić jego ładowanie?</em>, której zaznaczenie spowoduje pojawienie się pola do wprowadzenia wygenerowanych stylów CSS. Jednocześnie główny arkusz stylów (połączenie wszystkich plików CSS) zostanie załadowany asynchronicznie za pomocą skryptu JavaScript.</p>
<p>Efekt? <strong>100/100 w obu testach!</strong></p>
<p><img class="aligncenter size-large wp-image-12216" src="https://wpzen.pl/wp-content/uploads/2016/02/pagespeed-12-full-690x149.png" alt="PageSpeed Insights - 100/100" srcset="https://wpzen.pl/wp-content/uploads/2016/02/pagespeed-12-full-690x149.png 690w, https://wpzen.pl/wp-content/uploads/2016/02/pagespeed-12-full-300x65.png 300w, https://wpzen.pl/wp-content/uploads/2016/02/pagespeed-12-full-420x90.png 420w, https://wpzen.pl/wp-content/uploads/2016/02/pagespeed-12-full-690x149@2x.png 1380w, https://wpzen.pl/wp-content/uploads/2016/02/pagespeed-12-full-300x65@2x.png 600w, https://wpzen.pl/wp-content/uploads/2016/02/pagespeed-12-full-420x90@2x.png 840w" sizes="(max-width: 479px) 250px, (max-width: 767px) 450px, (max-width: 1023px) 510px, 690px" width="690" height="149"></p>
<p>Narzędzie <strong>Critical CSS</strong> jest o tyle prostsze, że wystarczy podać mu adres naszej strony – samo pobiera sobie arkusze stylów CSS.</p>
<p>Trzeba pamiętać, że taki krytyczny arkusz stylów CSS może wyglądać różnie w zależności od struktury danej podstrony – prawie na pewno ten ze strony głównej nie będzie „pasował” do podstrony z treścią wpisu. Dlatego uważam, że ta zabawa to w większości przypadków tylko „sztuka dla sztuki” – korzyści są zdecydowanie zbyt małe w stosunku do nakładu pracy (szczególnie w przypadku bardziej rozbudowanych stron).</p>
<h3>Bonus: Wygoda użytkowników</h3>
<p>W raporcie z testu dla urządzeń mobilnych znajduje się sekcja zatytułowana <strong>Wygoda użytkowników</strong>, w której znajdziemy zalecenia dotyczące usprawnień strony pod kątem komfortu korzystania z niej na małych ekranach urządzeń mobilnych.</p>
<p><img class="aligncenter size-large wp-image-12218" src="https://wpzen.pl/wp-content/uploads/2016/02/pagespeed-13-mobile-wygoda-690x357.png" alt="PageSpeed Insights - wygoda użytkownika" srcset="https://wpzen.pl/wp-content/uploads/2016/02/pagespeed-13-mobile-wygoda-690x357.png 690w, https://wpzen.pl/wp-content/uploads/2016/02/pagespeed-13-mobile-wygoda-300x155.png 300w, https://wpzen.pl/wp-content/uploads/2016/02/pagespeed-13-mobile-wygoda-420x217.png 420w, https://wpzen.pl/wp-content/uploads/2016/02/pagespeed-13-mobile-wygoda-690x357@2x.png 1380w, https://wpzen.pl/wp-content/uploads/2016/02/pagespeed-13-mobile-wygoda-300x155@2x.png 600w, https://wpzen.pl/wp-content/uploads/2016/02/pagespeed-13-mobile-wygoda-420x217@2x.png 840w" sizes="(max-width: 479px) 250px, (max-width: 767px) 450px, (max-width: 1023px) 510px, 690px" width="690" height="357"></p>
<p>Najczęściej pojawiającymi się problemami są <strong>Dobierz odpowiedni rozmiar elementów dotykowych</strong> i <strong>Używaj czytelnych rozmiarów czcionek</strong>. Pierwsza reguła wymaga od nas powiększenia rozmiaru elementów dotykowych (np. linków) i zwiększenia odstępu pomiędzy nimi (wysokość linii i marginesy). Druga reguła mówi z kolei, że gdzieś zastosowaliśmy zbyt mały rozmiar tekstu. Nie ma w tym nic skomplikowanego i bardzo łatwo jest wprowadzić odpowiednie poprawki.</p>
<p>Oczywiście reguły z tej sekcji nie mają nic wspólnego z prędkością naszej strony.</p>
<h2>Podsumowanie</h2>
<p>Wynik PageSpeed Insights zależy od bardzo wielu czynników. Każda strona może wymagać innych zabiegów optymalizacyjnych, jednak część z opisanych przeze mnie działań sprawdzi się w każdym przypadku. Moim celem było pokazanie, jak można spełnić poszczególne reguły PageSpeed Insights, bo ich opisy często są niewystarczające, szczególnie dla mniej zaawansowanych użytkowników.</p>
<p>Jak już wcześniej napisałem, dążenie za wszelką cenę do osiągnięcia maksymalnego wyniku w teście <strong>Google PageSpeed Insights</strong> nie ma większego sensu. Niektóre z wykonanych przeze mnie zabiegów mogą spowodować problemy ze skryptami JavaScript, a inne (jak na przykład generowanie Critical Path CSS) są dość skomplikowane. Nie należy traktować wyniku PageSpeed Insights jako jedynego słusznego wyznacznika szybkości strony. To oczywiście bardzo ważny wskaźnik, ale nie zapominajmy, że poświęcony na optymalizacje czas musi się nam w jakiś sposób zwrócić i dać jakieś wymierne korzyści. <strong>Jeśli osiągnęliśmy wynik na poziomie co najmniej 85 punktów, to możemy sobie pogratulować i zająć się czymś pożyteczniejszym</strong>.</p>
<p>Pamiętajmy też, że PageSpeed Insights nie jest jedynym testem sprawdzającym wydajność stron internetowych – warto wspomnieć jeszcze o <a rel="nofollow" target="_blank" href="http://yslow.org/">YSlow</a>, <a rel="nofollow" target="_blank" href="http://tools.pingdom.com/fpt/">Pingdom Website Speed Test</a>, <a rel="nofollow" target="_blank" href="http://www.webpagetest.org/">WebPageTest </a>i <a rel="nofollow" target="_blank" href="https://gtmetrix.com/">GTmetrix</a> (który korzysta m. in. z YSlow). Każde z tych narzędzi ma własny zestaw reguł weryfikujących szybkość strony, dlatego też osiągnięcie maksymalnego wyniku w jednym z nich wcale nie gwarantuje tego samego w innym.</p>
<p>Reguły, za pomocą których wszystkie te narzędzia weryfikują wydajność naszej strony, mają nam przede wszystkim pomóc w jak najlepszym zoptymalizowaniu naszej witryny. Sami możemy zdecydować, że dana reguła nas nie interesuje – tak jak na przykład sugerowałem przy okazji problemów z osadzonymi filmami z YouTube. Zachęcam do samodzielnych eksperymentów i do korzystania z moich porad w innej kolejności – może się okazać, że pominięcie któregoś z etapów nie odbije się w znaczący sposób na wyniku testu. Warto też sprawdzać (na przykład za pomocą jednego z alternatywnych narzędzi) czas ładowania strony i jej rozmiar – są to parametry, których PageSpeed Insights nie pokazuje wprost, a które są istotne z punktu widzenia wygody użytkowników.</p>
                </div>
            </div>
        </div>

        <h3>Psychologia WebDev - Kolory, Logo, Marketing, itd...</h3>

        <!-- Branding, czyli co i jak z marką? + Wielkość liter (Infografiki) -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse_2510157427">
                    <b>Branding, czyli co i jak z marką? + Wielkość liter (Infografiki)</b>
                    <span class="label label-warning pull-right">Marketing</span>
                </a>
            </div>
            <div id="collapse_2510157427" class="panel-collapse collapse">
                <div class="panel-body">
                    <a href="img/help/infografika_branding.jpg" target="_blank">
                        <img src="img/help/infografika_branding.jpg" alt="Branding" width="200px">
                    </a>
                    <a href="img/help/infografika_wielkoscLitery.jpg" target="_blank">
                        <img src="img/help/infografika_wielkoscLitery.jpg" alt="Branding" width="200px">
                    </a>
                </div>
                <div class="panel-footer"><i>Ostatnia aktualizacja: 17-03-2018</i></div>
            </div>
        </div>

        <!-- Kolory w marketingu -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse_7326806664">
                    <b>Kolory w marketingu</b>
                    <span class="label label-warning pull-right">SEO</span>
                    <span class="label label-warning pull-right">Marketing</span>
                </a>
            </div>
            <div id="collapse_7326806664" class="panel-collapse collapse">
                <div class="panel-body">
                
                    <h3>Kolory ze względu na płeć</h3>
                    <div class="col-lg-6">
                        <table class="table table-striped">
                            <tr>
                                <th colspan="4">Mężczyźni</th>
                            </tr>
                            <tr>
                                <td colspan="2"><i class="fa fa-thumbs-up"></i> Lubią</td>
                                <td colspan="2"><i class="fa fa-thumbs-down"></i> Nie lubią</td>
                            </tr>
                            <tr>
                                <td style="background: blue"></td>
                                <td>Niebieski (57%)</td>
                                <td style="background: brown"></td>
                                <td>Brązowy (27%)</td>
                            </tr>
                            <tr>
                                <td style="background: green"></td>
                                <td>Zielony (14%)</td>
                                <td style="background: purple"></td>
                                <td>Fioletowy (22%)</td>
                            </tr>
                            <tr>
                                <td style="background: black"></td>
                                <td>Czarny (9%)</td>
                                <td style="background: orange"></td>
                                <td>Pomarańczowy (22%)</td>
                            </tr>
                            <tr>
                                <td style="background: red"></td>
                                <td>Czerwony (7%)</td>
                                <td style="background: yellow"></td>
                                <td>Żółty (13%)</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-lg-6">
                        <table class="table table-striped">
                            <tr>
                                <th colspan="4">Kobiety</th>
                            </tr>
                            <tr>
                                <td colspan="2"><i class="fa fa-thumbs-up"></i> Lubią</td>
                                <td colspan="2"><i class="fa fa-thumbs-down"></i> Nie lubią</td>
                            </tr>
                            <tr>
                                <td style="background: blue"></td>
                                <td>Niebieski (35%)</td>
                                <td style="background: orange"></td>
                                <td>Pomarańczowy (33%)</td>
                            </tr>
                            <tr>
                                <td style="background: purple"></td>
                                <td>Fioletowy (23%)</td>
                                <td style="background: brown"></td>
                                <td>Brązowy (20%)</td>
                            </tr>
                            <tr>
                                <td style="background: green"></td>
                                <td>Zielony (14%)</td>
                                <td style="background: grey"></td>
                                <td>Szary (17%)</td>
                            </tr>
                            <tr>
                                <td style="background: red"></td>
                                <td>Czerwony (9%)</td>
                                <td style="background: yellow"></td>
                                <td>Żółty (13%)</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-12">
                        <i>*Na podstawie badań dr. Joego Hallocka</i>
                    </div>

                    <div class="col-lg-12">
                    <h3>Kolory ze względu na kolor</h3>
                    <table class="table table-striped">
                        <tr>
                            <td style="background: blue"></td>
                            <td style="background: red"></td>
                            <td style="background: green"></td>
                            <td style="background: orange"></td>
                            <td style="background: purple"></td>
                            <td style="background: white"></td>
                            <td style="background: black"></td>
                        </tr>
                        <tr>
                            <th>Niebieski</th>
                            <th>Czerwony</th>
                            <th>Zielony</th>
                            <th>Zółty i Pomarańczowy</th>
                            <th>Fioletowy</th>
                            <th>Biały</th>
                            <th>Czarny</th>
                        </tr>
                        <tr>
                            <td>
                                <ul>
                                    <li>zaufanie</li>
                                    <li>rzetelność</li>
                                    <li>stateczność</li>
                                    <li>bezpieczeństwo</li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>emocje</li>
                                    <li>fascynację</li>
                                    <li>chęć do działania</li>
                                    <li>pragnienie wrażeń</li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>spokój i opanowanie</li>
                                    <li>rozwój</li>
                                    <li>zdrowie</li>
                                    <li>usługi przyjazne, o wysokiej jakości</li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>radość i optymizm</li>
                                    <li>ciepło i świeżość</li>
                                    <li>pobudza pracę naszego umysłu</li>
                                    <li>wpływa na pamięć</li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>luksus</li>
                                    <li>wiedza</li>
                                    <li>respekt</li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>czystość</li>
                                    <li>prostota</li>
                                    <li>neutralność</li>
                                    <li>kreatywność</li>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                    <li>klasa</li>
                                    <li>elegancja</li>
                                    <li>tradycja</li>
                                </ul>
                            </td>
                        </tr>
                        </table>
                        *Na podstawie <a href="http://mobiletry.com/blog/znaczenie-kolorow-na-stronach-internetowych">tego</a> artykułu
                        </div>

                        <div class="col-lg-12">
                            <h3>Infografiki związane z psychologią kolorów</h3>
                        </div>
                        <div class="col-lg-2">
                            <a href="img/help/infografika_kolory_zakupowe.jpg" target="_blank">
                                <img src="img/help/infografika_kolory_zakupowe.jpg" alt="Psychologia Yellow" width="100%" >
                            </a>
                        </div>
                        <div class="col-lg-2">
                            <a href="img/help/infografika_yellow.jpg" target="_blank">
                                <img src="img/help/infografika_yellow.jpg" alt="Psychologia Yellow" width="100%" >
                            </a>
                        </div>
                        <div class="col-lg-2">
                            <a href="img/help/infografika_kolory.jpg" target="_blank">
                                <img src="img/help/infografika_kolory.jpg" alt="Psychologia Kolorow" width="100%" >
                            </a>
                        </div>

                    </div>
                </div>
        </div>
        
        <h3>Prawne aspekty w WebDev</h3>

        <!-- Typy licencji -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse_2028412669">
                    <b>Typy licencji</b> <span class="label label-warning pull-right">Licencje</span>
                </a>
            </div>
            <div id="collapse_2028412669" class="panel-collapse collapse">
                <div class="panel-body">
                    <h3>MIT</h3>
                    <div class="row">
                        <div class="col-lg-6">
                            <b>Opis:</b>
                            <p>Często nazywana X11, jej nazwa jest skrótem od Massachusetts Institute of Technology, która jest uczelnią techniczną w USA. Licencja MIT jest jedną z najprostszych licencji załączonych do FSF (Free Software Fundation) grupy.</p>
                            <p>Krótka, permisywna licencja na oprogramowanie. Zasadniczo możesz robić, co chcesz, o ile zamieścisz oryginalne informacje o prawach autorskich i licencjach w dowolnej kopii oprogramowania / źródła. Istnieje wiele odmian tej licencji.</p>
                            <i>~ Żródło: <a href="https://tldrlegal.com/license/mit-license" target="_blank" rel="nofollow">tldrlegal.com/[...]</a></i>
                        </div>
                        <div class="col-lg-6">
                            <div class="alert alert-success">
                                <b>Co MOŻNA robić?</b>
                                <ul>
                                    <li>Używać i kopiować w niekomercyjnych oraz komercyjnych projektach,</li>
                                    <li>Możesz dokonać zmian w pracy,</li>
                                    <li>Łączyć z innym kodem,</li>
                                    <li>Dystrybutować pod swoją nazwą,</li>
                                    <li>Możesz włączyć pracę do czegoś, co ma bardziej restrykcyjną licencję (zmieniać licencję),</li>
                                    <li>Sprzedawać skrypt,</li>
                                    <li>Implementować do własnego komercyjnego projektu.</li>
                                </ul>
                            </div>
                            <div class="alert alert-danger">
                                <b>Czego NIE MOŻNA robić?</b>
                                <ul>
                                    <li>Usuwać praw autorskich,</li>
                                    <li>Modyfikować oryginalnych praw autorskich,</li>
                                    <li>Praca jest dostarczana "tak jak jest". Nie możesz pociągnąć autora do odpowiedzialności.</li>
                                </ul>
                            </div>
                            <div class="alert alert-info">
                                <b>Co TRZEBA zrobić?</b>
                                <ul>
                                    <li>Musisz umieścić informację o prawach autorskich we wszystkich kopiach lub istotnych zastosowaniach utworu,</li>
                                    <li>Musisz załączyć notę licencyjną do wszystkich kopii lub znaczących zastosowań dzieła.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <h3>Creative Commons (CC)</h3>

                    <h4>CC0</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <b>Ikona:</b>
                            <p><img src="img/help/CC0.png" alt="CC0"></p>
                            <b>Opis:</b>
                            <p>Uwalnia oprogramowanie do domeny publicznej lub w inny sposób udziela pozwolenia na jego wykorzystanie w dowolnym celu. Zrzeka się licencji patentowych.</p>
                            <i>~ Żródło: <a href="https://tldrlegal.com/license/creative-commons-cc0-1.0-universal" target="_blank" rel="nofollow">tldrlegal.com/[...]</a></i>
                        </div>
                        <div class="col-lg-6">
                            <div class="alert alert-success">
                                <b>Co MOŻNA robić?</b>
                                <ul>
                                    <li>"Zapraszam do robienia wszystkiego, co tylko chcesz!",</li>
                                    <li>Możliwość korzystania z oprogramowania w celach komercyjnych,</li>
                                    <li>Możliwość swobodnego używania / modyfikowania oprogramowania bez jego dystrybucji (zastosowanie niekomercyjne),</li>
                                    <li>Możliwość modyfikacji oprogramowania i tworzenia pochodnych,</li>
                                    <li>Możliwość dystrybucji prac oryginalnych lub zmodyfikowanych (pochodnych).</li>
                                </ul>
                            </div>
                            <div class="alert alert-danger">
                                <b>Czego NIE MOŻNA robić?</b>
                                <ul>
                                    <li>W CC0 nie udziela się licencji na używanie znaków towarowych,</li>
                                    <li>CC0 zapewnia, że twórca treści zachowuje wszystkie prawa patentowe i odmawia jakiejkolwiek licencji na te patenty.</li>
                                </ul>
                            </div>
                            <div class="alert alert-info">
                                <b>Co TRZEBA zrobić?</b>
                                <ul>
                                    <li>Brak</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <h4>CC BY (Attribution)</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <b>Ikona:</b>
                            <p><img src="img/help/CCBY.png" alt="CC BY"></p>
                            <b>Opis:</b>
                            <p>Jest to "standardowa" licencja Creative Commons, która daje innym maksimum swobody w robieniu tego, co chcą w swojej pracy. Musisz podać autora oryginału utworu, podać nazwę i tytuł oryginalnego dzieła, zaznaczyć, że zmodyfikowałeś pracę, i zamieścić logo CC-BY.
                            <br>Nie pozwala na tioryzację i zapewnia ochronę przed zniesławieniem dla twórcy.</p>
                            <p>
                                <i>~ Żródło: <a href="https://tldrlegal.com/license/creative-commons-attribution-(cc)" target="_blank" rel="nofollow">tldrlegal.com/[...]</a></i>
                                <a href="https://creativecommons.org/licenses/by/4.0" target="_blank" rel="nofollow">Zobacz Akt Licencyjny</a>
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <div class="alert alert-success">
                                <b>Co MOŻNA robić?</b>
                                <ul>
                                    <li>
                                        <b>Użytek komercyjny</b>
                                        <p>Możesz wykorzystać kod w projektach komercyjnych,</p>
                                    </li>
                                    <li>
                                        <b>Modyfikacja</b>
                                        <p>Możesz modyfikować oprogramowanie i tworzyć pochodne,</p>
                                    </li>
                                    <li>
                                        <b>Dystrybucja</b>
                                        <p>Możesz dystrybuować pracę oryginalną lub zmodyfikowaną (pochodną).</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="alert alert-danger">
                                <b>Czego NIE MOŻNA robić?</b>
                                <ul>
                                    <li>
                                        <b>Sublicencja</b>
                                        <p>Nie daje możliwości udzielenia / rozszerzenia licencji na oprogramowanie,</p>
                                    </li>
                                    <li>
                                        <b>Gwarancja</b>
                                        <p>Licencja nie daje żadnej gwarancji na działanie aplikacji / kodu,</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="alert alert-info">
                                <b>Co TRZEBA zrobić?</b>
                                <ul>
                                    <li>
                                        <b>Dołącz prawa autorskie</b>
                                        <p>Oryginalne prawa autorskie muszą zostać zachowane.</p>    
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <h4>CC BY-NC (Attribution-NonCommercial)</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <b>Ikona:</b>
                            <p><img src="img/help/CCBY-NC.png" alt="CC BY-NC"></p>
                            <b>Opis:</b>
                            <p>
                                Ten wariant licencji Creative Commons nie pozwala na komercyjne wykorzystanie oryginalnej pracy.
                                <br>Nie pozwala na <s>tioryzację</s> tiwoizację i zapewnia ochronę przed zniesławieniem dla twórcy.
                            </p>
                            <p>
                                <i>~ Żródło: <a href="https://tldrlegal.com/license/creative-commons-attribution-noncommercial-(cc-nc)" target="_blank" rel="nofollow">tldrlegal.com/[...]</a></i>
                                <a href="https://creativecommons.org/licenses/by-nc/4.0" target="_blank" rel="nofollow">Zobacz Akt Licencyjny</a>
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <div class="alert alert-success">
                                <b>Co MOŻNA robić?</b>
                                <ul>
                                    <li>
                                        <b>Modyfikacja</b>
                                        <p>Możesz modyfikować oprogramowanie i tworzyć jego pochodne,</p>
                                    </li>
                                    <li>
                                        <b>Dystrybucja</b>
                                        <p>Możesz dystrybuować pracę oryginalną lub zmodyfikowaną (pochodną).</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="alert alert-danger">
                                <b>Czego NIE MOŻNA robić?</b>
                                <ul>
                                    <li>
                                        <b>Użytek komercyjny</b>
                                        <p>Nie możesz wykorzystać kodu w projektach komercyjnych,</p>
                                    </li>
                                    <li>
                                        <b>Sublicencja</b>
                                        <p>Nie daje możliwości udzielenia / rozszerzenia licencji na oprogramowanie,</p>
                                    </li>
                                    <li>
                                        <b>Gwarancja</b>
                                        <p>Licencja nie daje żadnej gwarancji na działanie aplikacji / kodu,</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="alert alert-info">
                                <b>Co TRZEBA zrobić?</b>
                                <ul>
                                    <li>
                                        <b>Dołącz prawa autorskie</b>
                                        <p>Oryginalne prawa autorskie muszą zostać zachowane,</p>
                                    </li>
                                    <li>
                                        <b>Zmiany stanu</b>
                                        <p>Musisz powiedzieć, czy zmodyfikowałeś pracę,</p>
                                    </li>
                                    <li>
                                        <b>Przyznanie autorstwa</b>
                                        <p>Musisz umieścić informację o prawach autorskich we wszystkich kopiach lub istotnych zastosowaniach utworu.</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <h4>CC BY-ND 4.0 (Attribution-NoDerivs)</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <b>Ikona:</b>
                            <p><img src="img/help/CCBY-ND.png" alt="CC BY-ND"></p>
                            <b>Opis:</b>
                            <p>
                                <i>~ Żródło: <a href="https://tldrlegal.com/license/creative-commons-attribution-noderivatives-4.0-international-(cc-by-nd-4.0)" target="_blank" rel="nofollow">tldrlegal.com/[...]</a></i>
                                <a href="https://creativecommons.org/licenses/by-nd/4.0" target="_blank" rel="nofollow">Zobacz Akt Licencyjny</a>
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <div class="alert alert-success">
                                <b>Co MOŻNA robić?</b>
                                <ul>
                                    <li>
                                        <b>Użytek komercyjny</b>
                                        <p>Możesz wykorzystać kod w projektach komercyjnych,</p>
                                    </li>
                                    <li>
                                        <b>Dystrybucja</b>
                                        <p>Możesz dystrybuować pracę oryginalną lub zmodyfikowaną (pochodną).</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="alert alert-danger">
                                <b>Czego NIE MOŻNA robić?</b>
                                <ul>
                                    <li>
                                        <b>Modyfikacja</b>
                                        <p>Nie możesz modyfikować oprogramowania i tworzyć jego pochodnych,</p>
                                    </li>
                                    <li>
                                        <b>Sublicencja</b>
                                        <p>Nie daje możliwości udzielenia / rozszerzenia licencji na oprogramowanie,</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="alert alert-info">
                                <b>Co TRZEBA zrobić?</b>
                                <ul>
                                    <li>
                                        <b>Przyznanie autorstwa</b>
                                        <p>Musisz umieścić informację o prawach autorskich we wszystkich kopiach lub istotnych zastosowaniach utworu,</p>
                                    </li>
                                    <li>
                                        <b>Dołącz prawa autorskie</b>
                                        <p>Oryginalne prawa autorskie muszą zostać zachowane,</p>
                                    </li>
                                    <li>
                                        <b>Zmiany stanu</b>
                                        <p>Musisz powiedzieć, czy zmodyfikowałeś pracę,</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <h4>CC BY-SA 4.0 (Attribution-ShareAlike)</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <b>Ikona:</b>
                            <p><img src="img/help/CCBY-SA.png" alt="CC BY-SA"></p>
                            <b>Opis:</b>
                            <p>
                                <i>~ Żródło: <a href="https://tldrlegal.com/license/creative-commons-attribution-sharealike-4.0-international-(cc-by-sa-4.0)" target="_blank" rel="nofollow">tldrlegal.com/[...]</a></i>
                                <a href="https://creativecommons.org/licenses/by-sa/4.0" target="_blank" rel="nofollow">Zobacz Akt Licencyjny</a>
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <div class="alert alert-success">
                                <b>Co MOŻNA robić?</b>
                                <ul>
                                    <li>
                                        <b>Użytek komercyjny</b>
                                        <p>Możesz wykorzystać kod w projektach komercyjnych,</p>
                                    </li>
                                    <li>
                                        <b>Dystrybucja</b>
                                        <p>Możesz dystrybuować pracę oryginalną lub zmodyfikowaną (pochodną),</p>
                                    </li>
                                    <li>
                                        <b>Modyfikacja</b>
                                        <p>Możesz modyfikować oprogramowanie i tworzyć jego pochodne,</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="alert alert-danger">
                                <b>Czego NIE MOŻNA robić?</b>
                                <ul>
                                    <li>
                                        <b>Sublicencja</b>
                                        <p>Nie daje możliwości udzielenia / rozszerzenia licencji na oprogramowanie.</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="alert alert-info">
                                <b>Co TRZEBA zrobić?</b>
                                <ul>
                                    <li>
                                        <b>Przyznanie autorstwa</b>
                                        <p>Musisz umieścić informację o prawach autorskich we wszystkich kopiach lub istotnych zastosowaniach utworu,</p>
                                    </li>
                                    <li>
                                        <b>Dołącz prawa autorskie</b>
                                        <p>Oryginalne prawa autorskie muszą zostać zachowane,</p>
                                    </li>
                                    <li>
                                        <b>Zmiany stanu</b>
                                        <p>Musisz powiedzieć, czy zmodyfikowałeś pracę.</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <h4>CC BY-NC-ND (Attribution-NonCommercial-NoDerivs)</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <b>Ikona:</b>
                            <p><img src="img/help/CCBY-NC-ND.png" alt="CC BY-NC-ND"></p>
                            <b>Opis:</b>
                            <p>
                                <a href="https://creativecommons.org/licenses/by-nc-nd/4.0" target="_blank" rel="nofollow">Zobacz Akt Licencyjny</a>
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <div class="alert alert-success">
                                <b>Co MOŻNA robić?</b>
                                <ul>
                                    <li>
                                        <b>?</b>
                                        <p>?</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="alert alert-danger">
                                <b>Czego NIE MOŻNA robić?</b>
                                <ul>
                                    <li>
                                        <b>?</b>
                                        <p>?</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="alert alert-info">
                                <b>Co TRZEBA zrobić?</b>
                                <ul>
                                    <li>
                                        <b>?</b>
                                        <p>?</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <h4>CC BY-NC-SA 4.0 (Attribution-NonCommercial-ShareAlike)</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <b>Ikona:</b>
                            <p><img src="img/help/CCBY-NC-SA.png" alt="CC BY-NC-SA"></p>
                            <b>Opis:</b>
                            <p>
                                <i>~ Żródło: <a href="https://tldrlegal.com/license/creative-commons-attribution-noncommercial-sharealike-4.0-international-(cc-by-nc-sa-4.0)" target="_blank" rel="nofollow">tldrlegal.com/[...]</a></i>                                
                                <a href="https://creativecommons.org/licenses/by-nc-sa/4.0" target="_blank" rel="nofollow">Zobacz Akt Licencyjny</a>
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <div class="alert alert-success">
                                <b>Co MOŻNA robić?</b>
                                <ul>
                                    <li>
                                        <b>Dystrybucja</b>
                                        <p>Możesz dystrybuować pracę oryginalną lub zmodyfikowaną (pochodną),</p>
                                    </li>
                                    <li>
                                        <b>Modyfikacja</b>
                                        <p>Możesz modyfikować oprogramowanie i tworzyć jego pochodne,</p>
                                    </li>
                                    <li>
                                        <b>Zmiana nazwy</b>
                                        <p>Możesz zmianić nazwę oprogramowania w przypadku modyfikacji / dystrybucji.</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="alert alert-danger">
                                <b>Czego NIE MOŻNA robić?</b>
                                <ul>
                                    <li>
                                        <b>Użytek komercyjny</b>
                                        <p>Nie możesz wykorzystać kodu w projektach komercyjnych,</p>
                                    </li>
                                    <li>
                                        <b>Sublicencja</b>
                                        <p>Nie daje możliwości udzielenia / rozszerzenia licencji na oprogramowanie,</p>
                                    </li>
                                    <li>
                                        <b>Gwarancja</b>
                                        <p>Licencja nie daje żadnej gwarancji na działanie aplikacji / kodu,</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="alert alert-info">
                                <b>Co TRZEBA zrobić?</b>
                                <ul>
                                    <li>
                                        <b>Przyznanie autorstwa</b>
                                        <p>Musisz umieścić informację o prawach autorskich we wszystkich kopiach lub istotnych zastosowaniach utworu,</p>
                                    </li>
                                    <li>
                                        <b>Dołącz prawa autorskie</b>
                                        <p>Oryginalne prawa autorskie muszą zostać zachowane,</p>
                                    </li>
                                    <li>
                                        <b>Zmiany stanu</b>
                                        <p>Musisz powiedzieć, czy zmodyfikowałeś pracę.</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <h3>GNU General Public License</h3>
                    
                    <h4>GNU GPL v2 & GNU GPL v3</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <b>Ikona:</b>
                            <br><img src="img/help/GNUGPLv2.png" alt="GNU GPL v2">
                            <img src="img/help/GNUGPLv3.png" alt="GNU GPL v3">
                            <br><br>
                            <b>Opis:</b>
                            <p>
                                "Wolne oprogramowanie" (a więc i GPL) w koncepcji FSF posiada następujące cechy wymienione w "Co można robić".
                            </p>
                            <p>
                                Wolność nie oznacza pełnej swobody dysponowania programem. Jeżeli dotykasz GPL, musisz dalej <b>stosować zasady GPL do całości produktu</b>, w którym umieściłeś kod GPL (efekt wirusa). Tak więc powyższe wolności przechodzą na kolejne osoby. Jeśli nawet weźmiesz pieniądze za dystrybucję, nie możesz innym osobom zabronić rozdania tego samego (lub zmodyfikowanego) programu za darmo. [...] Jednym słowem - zarabiaj na dystrybucji GPL ile chcesz, byle tylko była to opłata za usługę, a nie za prawo do korzystania z programu. O zakazie pobierania opłat licencyjnych świadczy (wprost lub a contrario) kilka punktów licencji GPL. [...]
                            </p>
                            <p>
                                Wykazano pięć cech, którymi musi się (łącznie) opłata charakteryzować, aby mówić o dystrybucji, a nie licencji (podaję cztery, bo jedna ze względu na specyfikę prawa amerykańskiego nie ma dla nas znaczenia):
                            </p>
                            <p>
                            Na GPL-u można zarobić, i jak udowadnia wiele firm, całkiem zacnie. Trzeba mieć tylko świadomość, że zarabiamy na usługach a nie na "programie". To rozróżnienie jest istotne i doniosłe w praktyce, a nieposzanowanie tej reguły może skończyć się wysokimi roszczeniami odszkodowawczymi. Co powoli zaczyna mieć miejsce w europejskich sądach.
                            </p>
                            <p>
                             <i>~ Źródło: <a href="https://www.dobreprogramy.pl/GPL-platne-czy-bezplatne,News,11361.html" target="_blank">dobreprogramy.pl/[...]</a></i>
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <div class="alert alert-success">
                                <b>Co MOŻNA robić?</b>
                                <ul>
                                    <li>użytkownik ma mieć wolność uruchamiania programu w jakimkolwiek celu</li>
                                    <li>użytkownik ma mieć wolność w modyfikowaniu programu (stąd prawo dostępu do kodu źródłowego)</li>
                                    <li>użytkownik ma mieć prawo do dystrybucji kopii programu za darmo lub za opłatą</li>
                                    <li>użytkownik ma mieć prawo do dystrybucji zmodyfikowanych wersji</li>
                                </ul>
                                <hr>
                                <ul>
                                    <li>stopka strony nie musi posiadać tzw. 'credits' (chyba, że layout został kupiony, zaprogramowany na specjalne potrzeby lub layout ma dwie wersje - premium i bezpłatną. Wtedy należy skontaktować się z autorem bądź prawnikiem)</li>
                                </ul>
                            </div>
                            <div class="alert alert-danger">
                                <b>Czego NIE MOŻNA robić?</b>
                                <ul>
                                    <li>opłata musi być opisana jako opłata za transfer (dystrybucję). Opłata nie musi być faktycznie uzależniona od kosztów nośnika i przesyłki, może zawierać zysk za tę czynność (w GPL - dowolny)</li>
                                    <li>opłata musi być jednorazowa, choć może być płatna częściami. Nie dopuszcza się opłat okresowych czy ciągłych (np. 5 USD za każdy miesiąc)</li>
                                    <li>opłata musi wyrażać się w konkretnej kwocie i nie zależeć od zakresu używania czy dalszej dystrybucji</li>
                                    <li>opłata nie może być "zabezpieczona" licencją (innymi słowy brak opłaty nie może być w licencji opisany jako przesłanka wygaśnięcia praw licencyjnych)</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <h3>Apache 2.0</h3>
                    <div class="row">
                        <div class="col-lg-6">
                            <b>Ikona:</b>
                            <br><img src="img/help/apache2.0.png" alt="Apache 2.0">
                            <br><br>
                            <b>Opis:</b>
                            <br><a href="http://www.apache.org/licenses/LICENSE-2.0.html" target="_blank" rel="nofollow">Zobacz Akt Licencyjny</a>
                            <br><a href="downloads/apache_2_0_pl.pdf" target="_blank" rel="nofollow">Tłumaczenie licencji w "wersji prawniczej"</a>
                            <br><a href="downloads/apache_2_0_pl_programista.pdf" target="_blank" rel="nofollow">Tłumaczenie licencji w "wersji dla programisty"</a>
                            <br><i> ~ Źródło: <a href="http://computerlaw.pl/2014/02/licencja-apache-2-0-po-polsku-wersja-dla-programisty/" target="_blank" rel="nofollow"></a></i>
                        </div>
                        <div class="col-lg-6">
                            <div class="alert alert-success">
                                <b>Co MOŻNA robić?</b>
                                <ul>
                                    <li>Możesz dołączać biblioteki i inne komponenty oparte na licencji Apache 2.0 do swoich komercyjnych projektów rozpowszechnianych na twojej własnej licencji.</li>
                                    <li>Możesz przenosić majątkowe prawa autorskie do projektów informatycznych, do których załączasz biblioteki oparte na licencji Apache 2.0 o ile to co stworzyłeś jest „twórcze” tzn. nie może być tak, że jedynym atutem twojego programu będzie de facto funkcjonalność samej biblioteki/komponentu.</li>
                                    <li>Musisz zachować plik licencyjny w ramach projektu, do którego dołączasz bibliotekę. Najlepiej jeżeli treść licencji znajduje w pliku .txt oraz stanowi załącznik do dokumentacji (o ile takowa istnieje).</li>
                                    <li>Wolno Ci modyfikować takie biblioteki i rozwijać komponenty oparte na licencji Apache 2.0. Możesz też takie biblioteki dalej rozpowszechniać.</li>
                                    <li>Możesz użyć produktu w zastosowaniach komercyjnych</li>
                                </ul>
                            </div>
                            <div class="alert alert-danger">
                                <b>Czego NIE MOŻNA robić?</b>
                                <ul>
                                    <li>???</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>

        <!-- Używanie znaków handlowych oraz logo znanych marek na stronach internetowych -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse_0875749459">
                    <b>Używanie znaków handlowych oraz logo znanych marek na stronach internetowych</b>
                    <span class="label label-success pull-right">Prawo</span>
                </a>
            </div>
            <div id="collapse_0875749459" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>
                        "Można posługiwać się cudzym znakiem towarowym pod warunkiem, że jest  to konieczne dla wskazania przeznaczenia towarów lub usług. Należy pamiętać, że używanie takiego znaku musi być zgodne z uczciwymi praktykami w przemyśle i handlu.
                        Używanie znaku zgodne z uczciwymi praktykami jest wtedy kiedy przedsiębiorca np. umieszcza na swojej stronie internetowej informację handlową: „Sprzedajemy samochody marki: BMW, FORD, FIAT”. Umieszczanie na stronie internetowej dużego dominującego słowno graficznego znaku BMW będzie już przekroczeniem tego prawa ponieważ może wprowadzać w błąd.
                    </p>
                    <p>
                        Użycie znaku jest niezgodne z uczciwymi praktykami jeżeli:
                        <ol>
                            <li>może sprawiać wrażenie istnienia powiązań gospodarczych między osobą trzecią a właścicielem znaku towarowego,</li>
                            <li>narusza wartość znaku poprzez osiąganie nieuzasadnionych korzyści wynikających z jego charakteru odróżniającego albo renomy,</li>
                            <li>prowadzi do dyskredytacji lub oczerniania znaku</li>
                        </ol>
                        Naruszenie prawa występuje już w przypadku powstania prawdopodobieństwa wprowadzenia w błąd. Ocena tego należeć będzie każdorazowo do Sądu, który odniesie ją do ustalonych okoliczności faktycznych konkretnej sprawy."
                        <br><i>~ Źródło: <a href="http://znakitowarowe-blog.pl/cudzy-znak-towarowy/">znakitowarowe-blog.pl</a></i>
                    </p>
                    <hr>
                    <p>
                        "Jeżeli np. prowadzisz sklep internetowy z danym towarem to wolno ci legalnie używać cudzego znaku towarowego. Bylebyś nie przesadzał z jego eksponowaniem.
                        Jeżeli natomiast są to firmy, które obsłużyłeś – byłbym bardzo ostrożny. Takie działanie może zagrażać ich renomie. Oczywiście możesz się bronić, że umieściłeś je w celu informacyjnym.
                        Prawda jest jednak taka, że mogłeś zrobić to bez posługiwania się znakami słowno- graficznymi. Można więc powiedzieć, że umieściłeś je na swojej stronie aby się uwiarygodnić w oczach potencjalnych klientów.
                        No bo skoro zaufały Ci firmy takie jak… to na pewno jesteś rzetelny.
                        Nie da się więc ukryć, że ogrzewasz się przy renomie znanych marek.
                        Dla bezpieczeństwa zadbałbym o <b>pisemną zgodę</b> na posługiwanie tymi znakami. Faktycznie bowiem obecnie właściciele tych znaków nie mają nad nimi żadnej władzy"
                        <br><i>~ Źródło: <a href="http://znakitowarowe-blog.pl/jak-legalnie-uzywac-cudzego-znaku-towarowego/">znakitowarowe-blog.pl</a></i>
                    </p>
                </div>
            </div>
        </div>

        <h3>Inne aspekty WebDev oraz inne pomoce</h3>

        <!-- Spis framework'ów do scrollowanych animacji na stronach -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse_2932245661">
                    <b>Spis framework'ów do scrollowanych animacji na stronach</b>
                    <span class="label label-primary pull-right">CSS</span>
                </a>
            </div>
            <div id="collapse_2932245661" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>
                        "You don’t need any special images or content styles to create scroll effects. There are plenty of free open source JavaScript libraries to help you get the job done. If you want to build your own scroll-to-animate effect, then save yourself some time by using one of these great open source solutions:" ~ vandelaydesign
                    </p>
                    <ul>
                        <li><a href="http://scrollrevealjs.org/">scrollReveal.js</a></li>
                        <li><a href="http://janpaepke.github.io/ScrollMagic/">Scroll Magic</a></li>
                        <li><a href="http://jackonthe.net/css3animateit/">CSS3 Animate It</a></li>
                        <li><a href="http://scrollme.nckprsn.com/">ScrollMe</a></li>
                        <li><a href="http://mynameismatthieu.com/WOW/">WOW.js</a></li>
                        <li><a href="http://prinzhorn.github.io/skrollr/">Skrollr</a></li>
                        <li><a href="https://github.com/tsherif/scroll-em">Scroll ‘Em</a></li>
                        <li><a href="http://demonstration.easy-development.com/jquery-story-tale/">Story Tale</a></li>
                        <li><a href="http://tympanus.net/Blueprints/OnScrollEffectLayout/">On Scroll Effect</a></li>
                        <li><a href="http://johnpolacek.github.io/superscrollorama/">Super Scrollorama</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Pozycjonowanie w Google Maps -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse_1000405549">
                    <b>Pozycjonowanie w Google Maps</b>
                    <span class="label label-warning pull-right">SEO</span>
                </a>
            </div>
            <div id="collapse_1000405549" class="panel-collapse collapse">
                <div class="panel-body">
                    <ol>
                        <li class="bold">Absolutna podstawa to prawidłowo uzupełniona wizytówka.</li>
                        <b>Nazwa firmy</b>: Przed uzupełnieniem tego pola warto sprawdzić czy mapka pokazuje się dla frazy „outlet toruń” czy może „Outlety w Toruniu”. Wpisujemy brand + wybraną wersję. W moim przypadku jest to BOUTIQUE Outlet Toruń. Google może dziwnie zareagować na zbyt dosłowne dopasowanie stąd dodajmy ten brand.
                        <br><b>Adres</b>: Adres i odległość od lokalizacji użytkownika to podstawa kwalifikacji w wyniku wyszukiwania.
                        <br><b>Informacje kontaktowe</b>: Tu jako pierwszy powinien być podany numer stacjonarny gdyż ten potwierdza lokalizację w danym mieście (Google doskonale potrafi rozpoznać lokalizację telefonu na podstawie prefiksu kierunkowego). Jeśli dysponujemy domeną zawierającą lokalizację to jest to potężny czynnik rankingowy.
                        <br><b>O firmie</b>: Tu zwięźle na temat prowadzonej działalności. Można przemycić słowo kluczowe. Pamiętajmy, że dobrze napisana treść decyduje o zaangażowaniu użytkownika. Przekłada się na kliknięcia (wzrost CTR) a w rezultacie poprawia pozycję strony. W myśl zasady „content is king”, warto zrobić to dobrze.
                        <li class="bold">Zadbajmy o opinie</li>
                        … gdyż te podnoszą wiarygodność wśród klientów ale i Google. To również potwierdza moz’owska analiza wskazując na duże ich znaczenie.
                        <li class="bold">Dodaj firmę do "Google Moja Firma" + uzupełnij dodatkowe dane</li>
                        <li class="bold">Linki z opisu są dofollow</li>
                        W opisie firmy możesz dodać link do strony głównej ;) Pamiętaj jednak by tego pola nie zaspamować.
                        <li class="bold">Uzupełnijmy profil zdjęciami z oznaczeniem geograficznym</li>
                        Wskazówka na podstawie moz.com. Matt Cuts, w którymś ze swoich filmików również poruszył ten temat sugerując, że zdjęcia z firmy podnoszą poziom zaufania użytkownika a tym samym Google.
                        <li class="bold">Zbudujmy mapkę dojazdową i opublikujmy ją</li>
                        Możesz to zrobić <a href="https://www.google.pl/maps/d/"> tutaj</a>. Google samo podpowiada i udostępnia możliwość publikacji na społecznościówkach. Wychodzi również z założenia, że jeśli ktoś udostępni wskazówki dojazdu to uważa to miejsce za godne polecenia. Trudno się nie zgodzić z tym tokiem myślenia, prawda? I ten krok działa. Wprawdzie z opóźnieniem ale … zawsze :)
                        <li class="bold">Podlinkujmy naszą wizytówkę w kilku miejscach</li>
                        Najbardziej naturalne do tego celu wydają się społecznościówki, linki w treści itp. Nie ma co przesadzać ilością a na pewno z szybkością podlinkowywania.
                        <li class="bold">Ponadto Google analizuje elementy rankingowe domeny</li>
                        Co za tym idzie, lepsza optymalizacja, autorytet domeny powiązanej z wizytówką, nazwa miasta w tytule strony docelowej, CTR itd. daje szansę na wyższą pozycję również w Google Maps. To wydaje się być logiczne i słuszne. Na podstawie analizy moz.com dla wyszukań lokalnych i … zdrowemu rozsądkowi.
                        <li class="bold">Zastosuj dane strukturalne (rich snippets) na swojej stronie www</li>
                        Dzięki wdrożeniu danych strukturalnych wyszukiwarki internetowe będą wiedziały, że firma która promuje się za pomocą danej strony internetowej posiada fizyczną siedzibę. Ma to bardzo duży wpływ na pozycję wizytówek i powiązanie wizytówki ze stroną, która jest zoptymalizowana pod tym kątem. Przyniesie to bardzo dobre efekty.
                        <hr>
                        <b>Oznaczenie biznesów:</b>
                        <br> czerwony - Wizytówka uzupełniona poprawnie, są zdjęcia oraz dane. Dla pełnego wysokiego pozycjonowania dodaj firmę do "Google Moja Firma".
                        <br> brązowy - Brak części wizytówki. Może to być zdjęcie lub opis.
                    </ol>
                </div>
            </div>
        </div>

        <!-- KONIEC POMOCY & FAQ -->
        </div>
    </div>
</div>

<div class="col-lg-4">
    <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-life-ring"></i> Pomoc</div>
        <div class="panel-body">
            <p>
                <b>Co mogę znaleźć w pomocy?</b>
                <br>Znajdziesz tutaj procedury pozwalające na standaryzację pewnych operacji, a także ogólną pomoc wraz z FAQ.
            </p>
        </div>
    </div>
</div>

<!-- KONIEC STRONY -->
        </div>
    </div>
</body>
</html>
<?php } ?>