<?php
/*
 * ██████╗  █████╗ ███████╗████████╗ █████╗ ███╗   ███╗███████╗██████╗ ██╗ █████╗ 
 * ██╔══██╗██╔══██╗██╔════╝╚══██╔══╝██╔══██╗████╗ ████║██╔════╝██╔══██╗██║██╔══██╗
 * ██████╔╝███████║███████╗   ██║   ███████║██╔████╔██║█████╗  ██║  ██║██║███████║
 * ██╔═══╝ ██╔══██║╚════██║   ██║   ██╔══██║██║╚██╔╝██║██╔══╝  ██║  ██║██║██╔══██║
 * ██║     ██║  ██║███████║   ██║   ██║  ██║██║ ╚═╝ ██║███████╗██████╔╝██║██║  ██║
 * ╚═╝     ╚═╝  ╚═╝╚══════╝   ╚═╝   ╚═╝  ╚═╝╚═╝     ╚═╝╚══════╝╚═════╝ ╚═╝╚═╝  ╚═╝
 * 01010111 01100101
 * 01101100 01101111 01110110 01100101
 * 01110000 01100001 01110011 01110100 01100001
 * 01100001 01101110 01100100
 * 01100011 01101111 01100100 01101001 01101110 01100111 00100001 00111100 00110011
 *
 * = = = = = = = = = = = = = = = = = =
 * = Funkcje PHP dla PastaCMS
 * = = = = = = = = = = = = = = = = = =
 * =
 * = 1. Operacje na danych (baza oraz pliki)
 * =    a) Dodawanie danych
 * =    b) Modyfikacja danych
 * =    c) Usuwanie danych
 * =    d) Wyswietlanie danych
 * = 2. Funkcje walidujace i sprawdzajace
 * = 3. Funkcje wyswietlajace komunikaty, bledy, ...
 * = 4. Inne
 * =
 * = = = = = = = = = = = = = = = = = =
 */

error_reporting(0);
@session_start();
@require_once("config.php");
/**
 * Funkcja sprawdzajaca wersje PHP dzialajaca na serwerze.
 * W przypadku nieobslugiwanej wersji wyswietla blad, a nastepnie konczy dzialanie skryptu.
 *
 * @version 1.0.0
 */
function checkPHP(){
    if(defined("PHP_MAJOR_VERSION") && PHP_MAJOR_VERSION < 7){
        showError("Wersja PHP zainstalowana na serwerze (PHP ".PHP_MAJOR_VERSION.") nie spełnia minimalnych wymagań! Zaktualizuj wersję PHP do wersji 7.0 lub nowszej!");
        exit(1);
    }
}
checkPHP();

/**
 * Funkcja uruchamiajaca polaczenie z baza danych MySQL.
 * Jesli udalo sie polaczyc z baza danych, zwrocona zostanie prawda.
 * W przypadku braku polaczenia funkcja wyswietla blad, a nastepnie konczy dzialanie skryptu PHP.
 * @version 1.0.1
 */
function connectDatabase(){
    if(@$GLOBALS['polaczenie'] = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)){
        return true;
    }else{
        showError("Nie udało się połączyć z bazą danych!");
        exit(1);
    }
}
connectDatabase();

/* ########################################
 * # 1a. Dodawanie danych
 * ######################################## */

/**
 * Funkcja dodajaca nowego uzytkownika do systemu.
 * 
 * @param array $user_data
 * @version 1.0.0
 */
function addUser(array $user_data){
    foreach ($user_data as $key => &$value) {
        $value = validate($value);
    }
    $errors = [];

    $zapytanie = "SELECT `id` FROM `users` WHERE `login` LIKE '".$user_data['login']."'";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    if(mysqli_num_rows($query) !== 0)
        $errors[] = "W systemie istnieje już użytkownik o nazwie '".$user_data['login']."'!";
    if(strlen($user_data['login']) < 5)
        $errors[] = "Nazwa użytkownika nie może być krótrza niż 5 znaków! (minimum 5 znaków)";
    if(strlen($user_data['passwd']) < 5)
        $errors[] = "Hasło użytkownika nie może być krótrze niż 5 znaków! (minimum 5 znaków)";
    if($user_data['permissions_level'] == "x" || $user_data['permissions_level'] > 3)
        $errors[] = "Nie wprowadzono prawidłowego poziomu uprawnień!";

    if(empty($errors)){
        $zapytanie = "INSERT INTO `users` (`id_unique`, `login`, `password`, `permission_level`) VALUES ('".md5(uniqid())."', '".$user_data['login']."', '".password_hash($user_data['passwd'], PASSWORD_BCRYPT)."', '".$user_data['permissions_level']."')";
        $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
        if($query){
            addToLog(1, "Dodano nowego użytkownika do systemu: ".$user_data['login']." posiadającego ".$user_data['permissions_level']." poziom uprawnień (".getUserPermissionName($user_data['permissions_level']).").");
            showSuccess("Pomyślnie utworzono nowego użytkownika!");
        }else{
            addToLog(2, "Podczas dodawania nowego użytkownika do bazy wystąpił błąd!");
            showError("Wystąpił błąd podczas tworzenia nowego użytkownika...");
        }
    }else{
        showError("Podczas tworzenia uzytkownika wystąpiły następujące błędy:<ul><li>".implode("</li><li>", $errors)."</li></ul>");
    }
}

/**
 * Funkcja dodajaca nowa strone internetowa do bazy. Przed dodaniem dane sa walidowane.
 *
 * @param array $website_data - wszystkie dane na temat nowej strony, ktore musza zostac wprowadzone do bazy.
 * @version 1.0.0
 */
function addWebsite(array $website_data){
    foreach ($website_data as $key => &$value){
        $value = validate($value);
        if($key == "website_name"){
            $value = str_replace("&amp;#34;", "\'", $value);
            $value = str_replace("&amp;#39;", "\'", $value);
        }
    }

    $errors = [];
    if(strlen($website_data['website_name'])<2)
        $errors[] = "Nazwa strony nie może być krótrza niż 2 znaki! (minimum 2 znaki)";
    if(strlen($website_data['website_address'])<4)
        $errors[] = "Adres internetowy nie może być krótrzy niż 4 znaki! (minimum 4 znaki)";
    if(!is_numeric($website_data['server_provider']))
        $errors[] = "Niepoprawny identyfikator dostawcy serwera!";
    if(!is_numeric($website_data['cms']))
        $errors[] = "Niepoprawny identyfikator systemu zarządzania treścią (CMS)!";
    if(!is_numeric($website_data['status']))
        $errors[] = "Niepoprawny identyfikator statusu strony!";
    if($website_data['contact_person'] == "")
        $errors[] = "Niepoprawny identyfikator osoby kontaktowej!";
    if(substr($website_data['website_address'], 0, 7) == "http://")
        $errors[] = "W adresie strony internetowej należy pominąć przedrostek 'http://'!";
    
    if(empty($errors)){
        $zapytanie = "INSERT INTO `websites` (`id_unique`, `name`, `web_address`, `server_provider`, `cms`, `id_contact_person`, `status`)
            VALUES ('".md5(uniqid())."', '".$website_data['website_name']."', '".$website_data['website_address']."', '".$website_data['server_provider']."', '".$website_data['cms']."', '".$website_data['contact_person']."', '".$website_data['status']."')";
        $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
        if($query){
            @header("Location: websites.php");
            showSuccess("Dodano nową stronę internetową! Jeśli nie zostałeś przekierowany automatycznie, kliknij <a href='websites.php' class='alert-link'>w ten link</a>.");
        }else{
            addToLog(2, "Podczas dodawania nowej strony do bazy wystąpił błąd!");
            showError("Nie udało się dodać nowej strony do bazy danych!");
        }
    }else{
        showError("Podczas dodawania nowej strony wystąpiły następujące błędy:<ul><li>".implode("</li><li>", $errors)."</li></ul>");
    }
}

/**
 * Funkcja dodajaca nowy serwer do systemu. Przed dodaniem dane sa walidowane.
 * 
 * @param array $server_data
 * @version 1.0.0
 */
function addServer(array $server_data){
    foreach ($server_data as $key => &$value) {
        $value = validate($value);
    }
    $errors = [];
    if(strlen($server_data['server_provider']) < 2)
        $errors[] = "Nazwa dostawcy serwera nie może być krótrza niż 2 znaki! (minimum 2 znaki)";
    if(!is_numeric($server_data['type']))
        $errors[] = "Niepoprawny identyfikator typu usługi";

    if(empty($errors)){
        $zapytanie = "INSERT INTO `servers` (`id_unique`, `server_provider`, `expires_date`, `type`, `comment`) VALUES ('".md5(uniqid())."', '".$server_data['server_provider']."', '".$server_data['expires_date']."', '".$server_data['type']."', '".$server_data['comment']."')";
        $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
        if($query){
            showSuccess("Pomyślnie dodano nową usługę do bazy!");
        }else{
            addToLog(2, "Podczas dodawania serwera/hostingu do bazy wystąpił błąd!");
            showError("Podczas dodawania serwera/hostingu wystąpił nieznany błąd.<br>Jeśli problem będzie się powtarzał, skontaktuj się z administratorem systemu.");
        }
    }else{
        showError("Podczas dodawania nowego serwera wystąpiły następujące błędy:<ul><li>".implode("</li><li>", $errors)."</li></ul>");
    }
}

/**
 * Funkcja odpowiadajaca za dodanie nowego zlecenia komputerowego do bazy danych. Dane wejsciowe sa walidowane podczas
 * dodawania ich do bazy. Jesli dane zostana dodane poprawnie, nastepuje przekierowanie do szczegolow wlasnie
 * dodanego zlecenia serwisu komputerowego. Jesli przekierowanie nie zadziala, uzytkownik zobaczy komunikat
 * o dodanym zleceniu z informacja, aby kliknac w link (przenoszacy recznie na strone nowego zlecenia).
 *
 * @param array $service_data - tablica zawierajaca dane nowego zlecenia
 * @version 1.0.0
 */
function addComputerService(array $service_data){
    foreach ($service_data as $key => &$value) {
        $value = validate(str_replace("'", '"', $value));
    }

    $id_u = md5(uniqid());
    $errors = [];

    if($service_data['date_start'] == "0000-00-00" || $service_data['date_start'] == null)
        $errors[] = "Data rozpoczęcia zlecenia nie została ustawiona prawidłowo!";
    if(!isset($service_data['id_client']) || $service_data['id_client'] == "")
        $errors[] = "Brak prawidłowego identyfikatora klienta!";
    if(strlen($service_data['device'])<4)
        $errors[] = "Nazwa urządzenia nie może być krótrza niż 4 znaki! (minimum 4 znaki)";

    if(empty($errors)){
        $zapytanie = "INSERT INTO `computer_service` (`id_unique`, `date_start`, `id_client`, `device`, `comment`, `status`) VALUES ('".$id_u."', '".$service_data['date_start']."', '".$service_data['id_client']."', '".$service_data['device']."', '".$service_data['comment']."', '0')";
        $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
        if($query){
            showSuccess("Nowe zlecenie zostało dodane do systemu!<br>Jeśli nie zostałeś automatycznie przekierowany, <a href='computerServiceMore.php?id_u=".$id_u."' class='alert-link'>kliknij tutaj</a>.");
            @header("Location: computerServiceMore.php?id_u=".$id_u);
        }else{
            addToLog(2, "Podczas dodawania nowego zlecenia serwisu komputerowego do bazy danych wystąpił błąd!");
            showError("Podczas dodawania zlecenia wystąpił nieznany błąd!<br>Jeśli problem będzie się powtarzał, skontaktuj się z administratorem systemu.");
        }
    }else{
        showError("Podczas dodawania nowego zgłoszenia wystąpiły następujące błędy:<ul><li>".implode("</li><li>", $errors)."</li></ul>");
    }
}

/**
 * Funkcja dodajaca nowego klienta to bazy danych. Przed dodaniem waliduje i sprawdza dane.
 *
 * @param array $client_data - tablica zawierajaca dane nowego klienta:
 * 1) first_name - imie klienta
 * 2) socond_name - nazwisko klienta
 * 3) phone - telefon kontaktowy do klienta
 * 4) email - adres email
 * 5) address - fizyczny adres zamieszkania
 * 6) comment - dodatkowy komentarz lub opis
 * @version 1.0.1
 */
function addClient(array $client_data){
    foreach ($client_data as $key => &$value) {
        $value = validate($value);
    }

    $errors = [];
    if($client_data['phone'] == null && $client_data['email'] == null)
        $errors[] = "Nowy klient musi posiadać przynajmniej jedną z dwóch możliwości kontaktu! Wpisz numer telefonu lub adres email!";
    if(strlen($client_data['first_name']) < 3)
        $errors[] = "Imię nie może być krótrze niż 3 znaki! (minimum 3 znaki)";
    if(strlen($client_data['second_name']) < 3)
        $errors[] = "Nazwisko nie może być krótrze niż 3 znaki! (minimum 3 znaki)";
    if($client_data['phone'] != null && !is_numeric($client_data['phone']))
        $errors[] = "Podany numer telefonu musi składać się tylko z cyfr!";
    if($client_data['email'] != null && !filter_var($client_data['email'], FILTER_VALIDATE_EMAIL))
        $errors[] = "Podany adres email musi posiadać małpę (@), kropkę oraz domenę!";

    if(empty($errors)){
        $zapytanie = "INSERT INTO `clients` (`id_unique`, `first_name`, `second_name`, `phone`, `email`, `address`) VALUES ('".md5(uniqid())."', '".$client_data['first_name']."', '".$client_data['second_name']."', '".@$client_data['phone']."', '".@$client_data['email']."', '".@$client_data['address']."')";
        $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
        if($query){
            showSuccess("Nowy klient został pomyślnie dodany!");
            return true;
        }else{
            showError("Nie udało się dodać nowego klienta do bazy!<br>Jeśli problem będzie się powtarzał, skontaktuj się z administratorem systemu!");
            addToLog(3, "Wystąpił błąd podczas dodawana nowego klienta do bazy! (błąd MySQL)");
            return false;
        }
    }else{
        showError("Podczas dodawania nowego klienta do bazy wystąpiły następujące problemy:<ul><li>".implode("</li><li>", $errors)."</li></ul>");
        return false;
    }
}

/**
 * AJAX
 * Funkcja dodaje do bazy nowa platnosc. Platnosc dodawana jest do kategorii zaleznej od otrzymanego parametru.
 *
 * @param string $mode
 * @param integer $id
 * @param string $date
 * @param float $amount
 * @param string $comment
 * @version 1.0.0
 */
function addNewPayment(string $mode, int $id, string $date, float $amount, string $comment){
    if(is_numeric($id)){
        if($mode == "website" || $mode == "computer_service" || $mode == "other"){
            switch($mode){
                case "website":
                    $zapytanie = "INSERT INTO `payments` (`id_website`, `payment_date`, `value`, `comment`) VALUES ('".validate($id)."', '".validate($date)."', '".validate($amount)."', '".validate($comment)."')";
                    break;
                case "computer_service":
                    $zapytanie = "INSERT INTO `payments` (`id_computer_service`, `payment_date`, `value`, `comment`) VALUES ('".validate($id)."', '".validate($date)."', '".validate($amount)."', '".validate($comment)."')";
                    break;
                default:
                    $zapytanie = "INSERT INTO `payments` ( `payment_date`, `value`, `comment`) VALUES ('".validate($date)."', '".validate($amount)."', '".validate($comment)."')";
                    break;
            }
            $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
            if($query){
                echo "OK";
            }else{
                echo "ERR_QUERY";
            }
        }else{
            echo "ERR_MODE";
        }
    }else{
        echo "ERR_ID";
    }
}

/**
 * Funkcja logujaca aktywnosc. Waliduje dane na wejsciu, a nastepnie wprowadza je do bazy danych.
 * 
 * @param int $type - poziom waznosci:
 * 1: Informacja,
 * 2: Ostrzezenie,
 * 3: Blad.
 * @param string $comment
 * @version 1.0.0
 */
function addToLog(int $type, string $comment){    
    if($type != 1 && $type != 2 && $type != 3) // DEBUG
        $comment .= "[hr]".print_r(debug_backtrace(), true); // DEBUG
    $zapytanie = "INSERT INTO `site_log` (`time`, `type`, `comment`) VALUES ('".date("Y-m-d H:i:s")."', '".validate($type)."', '".validate($comment)."')";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    if($query)
        return true;
    else
        return false;
}

/* ########################################
 * # 1b. Modyfikacja danych
 * ######################################## */

/**
 * Funkcja edytujaca strone internetowa. Przed dodaniem dane sa walidowane.
 *
 * @param array $website_data - tablica z danymi do zapisania.
 * @version 1.0.1
 */
function editWebsite(array $website_data){
    foreach ($website_data as $key => &$value){
        $value = validate($value);
        if($key == "website_name"){
            $value = str_replace("&amp;#34;", "\'", $value);
            $value = str_replace("&amp;#39;", "\'", $value);
        }
        if($key == "contact_person" || $key == "contact_person2"){
            if($value == "")
                $value = "NULL";
        }
    }
    
    $errors = [];
    if(strlen($website_data['website_name'])<2)
        $errors[] = "Adres internetowy nie może być krótrzy niż 2 znaki! (minimum 2 znaki)";
    if(strlen($website_data['website_address'])<4)
        $errors[] = "Adres internetowy nie może być krótrzy niż 4 znaki! (minimum 4 znaki)";
    if($website_data['contact_person'] == null)
        $errors[] = "Nie wybrano głównej osoby kontaktowej (klienta)";
    if($website_data['status'] != 0 && $website_data['date_created'] == "0000-00-00")
        $errors[] = "Zaznaczono ukończenie strony, ale nie podano daty utworzenia!";

    if(!is_numeric($website_data['server_provider']))
        $errors[] = "Niepoprawny identyfikator dostawcy serwera!";
    if(!is_numeric($website_data['cms']))
        $errors[] = "Niepoprawny identyfikator systemu zarządzania treścią!";
    if(!is_numeric($website_data['status']))
        $errors[] = "Niepoprawny identyfikator statusu strony!";
    
    if(empty($errors)){
        $zapytanie = "UPDATE `websites` SET `date_created` = '".$website_data['date_created']."', `name` = '".$website_data['website_name']."', `web_address` = '".$website_data['website_address']."',
                        `server_provider` = '".$website_data['server_provider']."', `domain_provider` = '".$website_data['domain_provider']."', `domain_expire_date` = '".$website_data['domain_expire_date']."',
                        `payment_for_me` = '".$website_data['payment_for_me']."', `payment_for_me_date` = '".$website_data['payment_for_me_date']."', `status` = '".$website_data['status']."',
                        `cms` = '".$website_data['cms']."', `comment` = '".$website_data['comment']."', `id_contact_person` = ".$website_data['contact_person'].",
                        `id_contact_person2` = ".$website_data['contact_person2']."
                        WHERE `websites`.`id_unique` LIKE '".$website_data['id_u']."'";

        if(mysqli_query($GLOBALS['polaczenie'], $zapytanie)){
            showSuccess("Dane strony zostały zaktualizowane!");
        }else{
            addToLog(2, "Podczas edycji strony internetowej ".$website_data['website_name']." baza danych MySQL zwróciła błąd!");
            showError("Podczas edycji strony wystąpił nieznany błąd!");
        }
    }else{
        showError("Podczas edycji strony wystąpiły następujące błędy:<ul><li>".implode("</li><li>", $errors)."</li></ul>");
    }
}

/**
 * Funkcja edytujaca dane serwera. Przed edycja dane sa weryfikowane.
 *
 * @param array $server_data - tablica zawierajaca dane serwera.
 * @version 1.0.1
 */
function editServer(array $server_data){
    foreach ($server_data as $key => &$value) {
        $value = validate($value);
    }
    $zapytanie = "UPDATE `servers` SET
                    `server_provider` = '".$server_data['server_provider']."',
                    `expires_date` = '".$server_data['expires_date']."',
                    `type` = '".$server_data['server_type']."',
                    `comment` = '".$server_data['comment']."'
                    WHERE `servers`.`id_unique` LIKE '".$server_data['id_u']."'";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    if($query){
        showSuccess("Dane serwera zostały zaktualizowane!");
    }else{
        addToLog(2, "Podczas edycji danych serwera wystąpił błąd!");
        showError("Podczas aktualizacji danych serwera wystąpił błąd!<br>Jeśli problem będzie się powtarzał, skontaktuj się z administratorem systemu!");
    }
}

/**
 * Funkcja edytujaca istniejace zlecenie serwisu komputerowego. Przed edycja danych sprawdza,
 * czy istnieje zlecenie o podanym identyfikatorze. Dane sa walidowane przed dodaniem do bazy.
 *
 * @param array $service_data
 * @version 1.0.1
 */
function editComputerService(array $service_data){
    foreach ($service_data as $key => &$value) {
        $value = validate($value);
    }
    $errors = [];
    $check = getComputerServiceData($service_data['id_u']);
    if($check == null)
        $errors[] = "Zlecenie, które próbujesz edytować nie istnieje!<br>Jeśli problem będzie się powtarzał, skontaktuj się z administratorem systemu.";
    if($service_data['date_start'] == "0000-00-00" || $service_data['date_start'] == null)
        $errors[] = "Data rozpoczęcia zlecenia nie została ustawiona prawidłowo!";
    if($service_data['status'] == 1 && $service_data['date_end'] == "0000-00-00")
        $errors[] = "Zlecenie zostało oznaczone jako zakończone, ale nie podano daty jego zakończenia!";
    if(!is_numeric($service_data['status']))
        $errors[] = "Wprowadzono nieprawidłowy status zlecenia!<br>Jeśli problem będzie się powtarzał, skontaktuj się z administratorem systemu.";
    if(!isset($service_data['id_client']) || $service_data['id_client'] == "")
        $errors[] = "Brak prawidłowego identyfikatora klienta!";
    if(strlen($service_data['device'])<4)
        $errors[] = "Nazwa urządzenia nie może być krótrza niż 4 znaki! (minimum 4 znaki)";
    if($service_data['date_start'] > $service_data['date_end'] && $service_data['date_end'] != "0000-00-00" && $service_data['status'] == 1)
        $errors[] = "Data zakończenia nie może być datą wcześniejszą, niż data rozpoczęcia!";

    if(empty($errors)){
        $zapytanie = "UPDATE `computer_service` SET `date_start` = '".$service_data['date_start']."', `date_end` = '".$service_data['date_end']."',
                    `id_client` = '".$service_data['id_client']."', `device` = '".$service_data['device']."',
                    `comment` = '".$service_data['comment']."', `status` = '".$service_data['status']."' WHERE `computer_service`.`id_unique` LIKE '".$service_data['id_u']."'";
        $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
        if($query){
            showSuccess("Dane zlecenia zostały zaktualizowane!");
        }else{
            addToLog(2, "Podczas edycji danych zlecenia seriwus komputerowego wystąpił błąd!");
            showError("Podczas wysyłania informacji do bazy wystąpił nieznany błąd!<br>Jeśli problem będzie się powtarzał, skontaktuj się z administratorem systemu.");
        }
    }else{
        showError("Podczas edycji zgłoszenia wystąpiły następujące błędy:<ul><li>".implode("</li><li>", $errors)."</li></ul>");
    }
}

/**
 * Funkcja odpowiadajaca za edycje danych klienta.
 *
 * @param array $client_data - tablica zawierajaca dane klienta do umieszczenia w bazie.
 * @version 1.0.1
 */
function editClient(array $client_data){
    foreach ($client_data as $key => &$value) {
        $value = validate($value);
    }

    $errors = [];
    if($client_data['phone'] == null && $client_data['email'] == null)
        $errors[] = "Klient musi posiadać przynajmniej jedną z dwóch możliwości kontaktu! Wpisz numer telefonu lub adres email!";
    if(strlen($client_data['first_name']) < 3)
        $errors[] = "Imię nie może być krótrze niż 3 znaki! (minimum 3 znaki)";
    if(strlen($client_data['second_name']) < 3)
        $errors[] = "Nazwisko nie może być krótrze niż 3 znaki! (minimum 3 znaki)";
    if($client_data['phone'] != null && !is_numeric($client_data['phone']))
        $errors[] = "Podany numer telefonu musi składać się tylko z cyfr!";
    if($client_data['email'] != null && !filter_var($client_data['email'], FILTER_VALIDATE_EMAIL))
        $errors[] = "Podany adres email musi posiadać małpę (@), kropkę oraz domenę!";

    if(empty($errors)){
        $zapytanie = "UPDATE `clients` SET `first_name` = '".$client_data['first_name']."', `second_name` = '".$client_data['second_name']."', `phone` = '".$client_data['phone']."', `email` = '".$client_data['email']."', `address` = '".$client_data['address']."', `comment` = '".$client_data['comment']."' WHERE `clients`.`id_unique` LIKE '".$client_data['id_u']."' ";
        $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
        if($query){
            showSuccess("Nowe dane klienta zostały zaktualizowane!");
        }else{
            showError("Podczas edycji danych klienta wystąpił nieznany błąd!<br>Jeśli problem będzie się powtarzał, skontaktuj się z administratorem systemu!");
            addToLog(3, "Podczas edycji danych klienta wystąpił nieznany błąd z bazą MySQL");
        }
    }else{
        showError("Podczas edycji danych klienta wystąpiły następujące błędy:<ul><li>".implode("</li><li>", $errors)."</li></ul>");
    }
}

/**
 * Funkcja odpowiada za walidacje oraz wyslanie pliku na serwer.
 * Domyslnie do kazdego nowego pliku w katalogu dopisywany jest jego numer oraz data i godzina wyslania
 * np. '001 - 2018-01-21 21:45:10 - plik.pdf'. Jesli jednak skrypt wykryje, ze CMS pracuje pod kontrola
 * systemu Windows, to zamiast dwukropkow godzina zostanie rozdzielona myslnikami (np. godz 21-45-10).
 * Funkcja przyjmie jedynie te pliki, ktore zostaly dozwolone globalnie (rozszerzenia, ktore znajduja sie
 * w tablicy $allowed_global_ext).
 *
 * @param string $path - pelna sicezka do ktorej ma trafic plik, wraz z nazwa i rozszerzeniem pliku
 * @param string $allowed_local_ext - dozwolone rozszerzenie pliku
 * @param string $static_name - domyslne null. W razie podania, system ustawi statyczna nazwe pliku a nastepnie wysle go na serwer.
 * @param bool $resize - domyslne null. Parametr dotyczy tylko wysylanych zdjec. W przypadku true wymiary wysylanego zdjecia zostana zmienione.
 * @version 1.0.0
 */
function uploadFile(string $path, string $allowed_local_ext, string $static_name = null, bool $resize = null){
    $file_size  = $_FILES['document']['size'];
    $file_name 	= $_FILES['document']['name'];
    $file_tmp   = $_FILES['document']['tmp_name'];
    $file_type	= $_FILES['document']['type'];
    $file_ext	= pathinfo($file_name, PATHINFO_EXTENSION);
    $errors = [];
    $max_size = 10; // 10MiB
    $allowed_global_ext = [
        "pdf",
        "png",
        "jpg",
        "jpeg"
    ];

    if($file_ext !== $allowed_local_ext)
        $errors[] = "Nieprawidłowe rozszerzenie pliku! Wyślij plik .$allowed_local_ext!";
    if($file_size > ($max_size*1048576))
        $errors[] = "Wysyłany plik jest za duży! Maksymalny rozmiar to ".($max_size*1048576)." MiB.";
    if(!is_readable($file_tmp))
        $errors[] = "Katalog tymczasowy nie posiada odpowiednich praw odczytu!";
    if(!is_readable($path))
        $errors[] = "Katalog docelowy nie posiada odpowiednich praw odczytu!";
    if(!is_writeable($file_tmp))
        $errors[] = "Katalog tymczasowy nie posiada odpowiednich praw zapisu!";
    if(!is_writeable($path))
        $errors[] = "Katalog docelowy nie posiada odpowiednich praw zapisu!";
    if(!in_array($file_ext, $allowed_global_ext))
        $errors[] = "W systemie nie dozwolono wysyłania pliku, który próbujesz wysłać!<br>Dozwolone rozszerzenia to: ".implode(", ", $allowed_global_ext);

    if(empty($errors)){
        if(!$static_name){
            @$last_file = substr(end(array_diff(scandir($path), array('.', '..'))),0 , 3);
            if($last_file == null){
                $last_file = "001";
            }else{
                $last_file += "1";
                $last_file = str_pad($last_file, 3, "0", STR_PAD_LEFT);
            }
            $file_name = $last_file." - ".date('Y-m-d H:i:s')." - ".$file_name;
        }else{
            $file_name = $static_name;
        }

        if(strtoupper(substr(PHP_OS, 0, 3)) == "WIN")
            $file_name = str_replace(":", "-", $file_name);

        //TODO
        if($resize){
            if(!in_array($file_ext, ['png, jpg, jpeg'])){

            }
        }

        if(move_uploaded_file($file_tmp, $path.$file_name)){
            addToLog(1, "Plik [i]".$path.$file_name."[/i] został właśnie wysłany na serwer.");
            showSuccess("Plik został wysłany!");
        }else{
            showError("Podczas wysyłania pliku wystąpił nieznany błąd!");
        }
    }else{
        showError("Podczas wysyłania pliku wystąpiły następujące błędy: <ul><li>".implode("</li><li>", $errors)."</li></ul> Plik nie został wysłany.");
    }
}

/* ########################################
 * # 1c. Usuwanie danych
 * ######################################## */

/**
 * Funkcja usuwajaca uzytkownika z bazy. W przypadku, gdy w bazie istnieje tylko jeden uzytkownik
 * funkcja zglosi blad, i nie usunie uzytkownika.
 * 
 * @param string $id_u
 * @version 1.0.0
 */
function deleteUser(string $id_u){
    $zapytanie = "SELECT `id` FROM `users`";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    if(mysqli_num_rows($query) > 1){
        $deleted_user = getUserLogin($id_u);
        $zapytanie = "DELETE FROM `users` WHERE `id_unique` LIKE '".validate($id_u)."'";
        if(mysqli_query($GLOBALS['polaczenie'], $zapytanie)){
            addToLog(1, "Usunięto użytkownika $deleted_user przez użytkownika ".getUserLogin($_SESSION['JezusServerHome']));
            showSuccess("Usunięto użytkownika!");
            if($id_u == $_SESSION['JezusServerHome'])
                logout();
        }else{
            addToLog(3, "Podczas usuwania użytkownika $deleted_user wystąpił błąd!");
            showError("Nie udało sie usunąć użytkownika");
        }
    }else{
        showError("Nie możesz usunąć ostatniego użytkownika! W systemie musi istnieć chociaż jeden użytkownik.");
    }
}

/**
 * Funkcja usuwajaca platnosc o podanym ID.
 * Wywolywana za pomoca AJAX.
 *
 * @param int $id - id platnosci, ktora ma zostac usunieta.
 * @version 1.0.0
 */
function deletePayment(int $id){
    if(is_numeric($id)){
        $zapytanie = "DELETE FROM `payments` WHERE `payments`.`id` = ".validate($id);
        $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
        if($query)
            echo "OK";
        else
            echo "ERR_QUERY";
    }else{
        echo "ERR_WRONG_ID";
    }
}

/**
 * Funkcja usuwajaca pliki z systemu.
 * Usunie tylko pliki, ktorych rozszerzenia zostaly do tego dopuszczone.
 *
 * @param string $file - sciezka do pliku wraz z jego rozszerzeniem, np. '/doc/file_001.pdf'
 * @version 1.0.0
 */
function deleteFile(string $file){
    if(file_exists($file)){
        $allowed_ext = [
            "pdf",
            "png",
            "jpg",
            "jpeg"
        ];
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        if(in_array($ext, $allowed_ext)){
            if(unlink($file)){
                addToLog(1, "Plik $file został właśnie usunięty przez użytkownika ".getUserLogin($_SESSION['JezusServerHome']));
                showSuccess("Plik został usunięty!");
            }else{
                showError("Podczas usuwania pliku wystąpił nieznany błąd!");
            }
        }else{
            showError("Rozszerzenie pliku, który próbujesz usunąć nie zostało dopuszczone do usuwania!");
        }
    }else{
        showError("Plik, który próbujesz usunąć nie istnieje!");
    }
}

/**
 * Funkcja usuwajaca dany serwer z bazy danych. Przed usunieciem serwera funkcja sprawdza, czy do serwera
 * nie sa podpiete jakiekolwiek strony internetowe. Jesli sa, funkcja wyswietla blad.
 *
 * @param string $id_u
 * @version 1.0.0
 */
function deleteServer(string $id_u){
    $zapytanie = "SELECT `id` FROM `servers` WHERE `id_unique` LIKE '".validate($id_u)."'";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    if($query){
        $r = mysqli_fetch_array($query);
        if(showWebsitesHostedOnServer($r['id']) == null){
            $zapytanie = "DELETE FROM `servers` WHERE `servers`.`id_unique` LIKE '".validate($id_u)."'";
            $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
            if($query){
                @header("Location: servers.php");
                showSuccess("Serwer został usunięty!");
            }else{
                showError("Podczas usuwania serwera wystąpił błąd!");
            }
        }else{
            showWarning("Nie udało się usunąć serwera z powodu podpiętych pod niego stron.<br>Zmień serwer w ustawieniach każdej z nich, a następnie spróbuj ponownie usunąć ten serwer.");
            showWebsitesHostedOnServer($r['id']);
        }
    }else{
        showError("Wystąpił błąd podczas sprawdzania połączeń serwera ze stronami internetowymi!<br>Jeśli problem będzie się powtarzał, skontaktuj się z administratorem systemu!");
    }
}

/**
 * Funkcja usuwajaca dane zlecenie serwisu komputerowego z bazy danych.
 * Funkja sprawdza, czy podane zlecenie istnieje, a nastepnie usuwa wszystkie
 * platnosci powiazane z tym zleceniem, usuwa dane zlecenie a nastepnie
 * usuwa folder dla plikow oraz zdjec wraz z tymi plikami.
 *
 * @param string $id_u - unikalny identyfikator zgloszenia serwisu komputerowego
 * @version 1.0.0
 */
function deleteComputerService(string $id_u){
    $zapytanie = "SELECT `id` FROM `computer_service` WHERE `id_unique` LIKE '$id_u'";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    if($query){
        $r = mysqli_fetch_array($query);
        if($r){
            $zapytanie = "DELETE FROM `payments` WHERE `payments`.`id_computer_service` = ".$r['id'];
            $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
            if($query){
                showInfo("Usunięto wszystkie płatności powiązane z tym zleceniem!");
                $zapytanie = "DELETE FROM `computer_service` WHERE `computer_service`.`id_unique` LIKE '$id_u'";
                $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
                if($query){
                    if(deleteDirectory("uploads/doc/computer_service/".$id_u) && deleteDirectory("uploads/img/computer_service/".$id_u)){
                        showSuccess("Zlecenie zostało usunięte z systemu!");
                    }else{
                        showWarning("Zlecenie zostało usunięte z systemu, ale wystąpił błąd podczas usuwania folderu z danymi zlecenia.");
                    }
                }else{
                    showError("Podczas usuwania zlecenia wystąpił błąd!<br>Jeśli problem będzie się powtarzał, skontaktuj się z administratorem systemu!");
                }
            }else{
                showError("Nie udało się usunąć wszystkich płatności powiązanych z tym zleceniem!<br>Zlecenie nie zostało usunięte.");
            }
        }else{
            showError("Nie udało się prawidłowo załadować danych potrzebnych do usunięcia zlecenia!");
        }
    }else{
        showError("Nie udało się pobrać danych wymaganych do usunięcia zlecenia!<br>Jeśli problem będzie się powtarzał, skontaktuj się z administratorem systemu!");
    }
}

/**
 * Funkcja usuwajaca folder wraz z danymi. Najpierw usuwa wszystkie pliki wewnatrza folderu,
 * po czym kasuje folder i zwraca prawde.
 *
 * @param string $dir - sciezka do folderu, ktory ma zostac usuniety
 * @version 1.0.0
 */
function deleteDirectory(string $dir){
    if(is_dir($dir)){
        $files = scandir($dir);
        foreach ($files as $key => $value) {
            if($value !== "." && $value !== "..")
                unlink($dir."/".$value);
        }
        $files = scandir($dir);
        if(sizeof($files) === 2){
            if(rmdir($dir)){
                showSuccess("Folder z danymi został usunięty!");
                return true;
            }else{
                showError("Wystąpił nieznany błąd podczas usuwania folderu!");
            }
        }else{
            showError("Nie udało się usunąć wszystkich plików z folderu, dlatego folder nie został usunięty!");
        }
    }else{
        showError("Podany folder nie istnieje!");
    }
}

/* ########################################
 * # 1d. Wyswietlanie danych
 * ######################################## */

/**
 * Funkcja zwracajaca tablice z danymi konkretnej strony internetowej.
 * Dodatkowo, jesli strona istnieje, ale nie istnieje folder do wysylania
 * dokumentow lub grafiki, to utworzone zostana odpowiednie katalogi.
 * Jesli strona o podanym unikatowym id nie istnieje, funkcja zwroci false.
 *
 * @param string $id_u
 * @return array
 * @version 1.0.0
 */
function getWebsiteData(string $id_u){
    $zapytanie = "SELECT * FROM `websites` WHERE `id_unique` LIKE '".validate($id_u)."' LIMIT 1";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    if($query){
        $r = mysqli_fetch_array($query);
        if(mysqli_num_rows($query) > 0){
            $paths = [
                "uploads/doc/websites/".$id_u,
                "uploads/img/websites/".$id_u
            ];
            foreach ($paths as $path) {
                if (!is_dir($path))
                    mkdir($path, 0777, true);
            }
            foreach ($r as $key => &$value) {
                if($value == "0000-00-00")
                    $value = null;
            }
            return $r;
        }else{
            return false;
        }
    }else{
        showError("Podczas pobierania danych strony wystąpił błąd!");
    }
}

/**
 * Funkcja zwracajaca tablice z danymi konkretnego zlecenia serwisu komputerowego.
 * Dodatkowo, jesli zlecenie istnieje, ale nie istnieje folder do wysylania
 * dokumentow lub grafiki, to utworzone zostana odpowiednie katalogi.
 * Jesli zlecenie o podanym unikatowym id nie istnieje, funkcja zwroci false.
 *
 * @param string $id_u
 * @return array
 * @version 1.0.0
 */
function getComputerServiceData(string $id_u){
    $zapytanie = "SELECT * FROM `computer_service` WHERE `id_unique` LIKE '".validate($id_u)."' LIMIT 1";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    if($query){
        $r = mysqli_fetch_array($query);
        if(mysqli_num_rows($query) > 0){
            $paths = [
                "uploads/doc/computer_service/".$id_u,
                "uploads/img/computer_service/".$id_u
            ];
            foreach ($paths as $path) {
                if (!is_dir($path))
                    mkdir($path, 0777, true);
            }
            return $r;
        }else{
            return false;
        }
    }else{
        showError("Podczas pobierania danych strony wystąpił błąd!");
    }
}

/**
 * Funkcja zwracajaca tablice zawierajaca dane serwera o podanym na wejsciu identyfikatorze.
 *
 * @param string $id - unikalny identyfikator lub identyfikator liczbowy serwera.
 * @version 1.0.0
 */
function getServerData(string $id){
    if(is_numeric($id))
        $zapytanie = "SELECT * FROM `servers` WHERE `id` = ".validate($id)." LIMIT 1";
    else
        $zapytanie = "SELECT * FROM `servers` WHERE `id_unique` LIKE '".validate($id)."' LIMIT 1";

    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    if($query){
        if(mysqli_num_rows($query)>0){
            $r = mysqli_fetch_array($query);
            return $r;
        }else{
            showWarning("Nie znaleziono serwera o podanym identyfikatorze!");
        }
    }else{
        showError("Wystąpił błąd podczas ładowania danych!<br>Jeśli problem będzie się powtarzał, skontaktuj się z administratorem systemu.");
    }
}

/**
 * Funkcja zwracajaca tablice zawierajaca dane klienta o podanym na wejsciu identyfikatorze.
 * W przypadku braku parametru funkcja nie zwroci nic.
 *
 * @param string $id - unikalny identyfikator lub identyfikator liczbowy klienta.
 * @version 1.0.1
 */
function getClientData(string $id = null){
    if($id){
        if(is_numeric($id))
            $zapytanie = "SELECT * FROM `clients` WHERE `id` = ".validate($id)." LIMIT 1";
        else
            $zapytanie = "SELECT * FROM `clients` WHERE `id_unique` LIKE '".validate($id)."' LIMIT 1";

        $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
        if($query){
            if(mysqli_num_rows($query)>0){
                $r = mysqli_fetch_array($query);
                $zapytanie = "SELECT COUNT(`id`)  AS 'ILOSC_ZGLOSZEN', MAX(DATEDIFF(`date_end`, `date_start`)) AS 'MAX_CZAS_SERWISOWANIA' FROM `computer_service` WHERE `id_client` = ".$r['id'];
                $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
                if($query){                
                    $r = array_merge($r, mysqli_fetch_array($query));
                    return $r;
                }else{
                    showError("Nie udało się pobrać statystyk klienta!");
                }
            }else{
                showWarning("Nie znaleziono klienta o podanym identyfikatorze!");
            }
        }else{
            showError("Wystąpił błąd podczas ładowania danych!<br>Jeśli problem będzie się powtarzał, skontaktuj się z administratorem systemu.");
        }
    }
}

/**
 * Funkcja zwracajaca ID ostatniego klienta w bazie lub falsz,
 * jesli klient nie istnieje.
 *
 * @version 1.0.0
 */
function getLastClientId(){
    $zapytanie = "SELECT `id` FROM `clients` ORDER BY `id` DESC LIMIT 1";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    if($query){
        $r = mysqli_fetch_array($query);
        return $r['id'];
    }else{
        showError("Nie udało się pobrać identyfikatora nowo dodanego klienta!");
        return false;
    }
}

/**
 * Funkcja zwracajaca ID klienta po podaniu unikalnego identyfikatora na wejsciu
 * lub falsz, jesli klient nie istnieje lub wystapil blad podczas sprawdzania.
 *
 * @param string $id_u - unikalny identyfikator klienta
 * @version 1.0.0
 */
function getClientId(string $id_u){
    $zapytanie = "SELECT `id` FROM `clients` WHERE `id_unique` LIKE '".$id_u."' LIMIT 1";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    if($query){
        if(mysqli_num_rows($query) > 0){
            $r = mysqli_fetch_array($query);
            return $r['id'];
        }else{
            showError("Brak użytkownika o podanym unikatowym identyfikatorze!");
            return false;
        }
    }else{
        showError("Nie udało się pobrać identyfikatora nowo dodanego klienta!");
        return false;
    }
}

/**
 * Funkcja zwracajaca login uzytkownika, na podstawie unikatowego ID.
 * 
 * @param string $id_u
 * @version 1.0.0
 */
function getUserLogin(string $id_u){
    $zapytanie = "SELECT `login` FROM `users` WHERE `id_unique` LIKE '".validate($id_u)."' LIMIT 1";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    if($query){
        $r = mysqli_fetch_array($query);
        return $r['login'];
    }else{
        return "unknown";
    }
}

/**
 * Funkcja zwraca nazwe systemu CMS, ktora odpowiada przyporzadkowanemu numerowi.
 * W przypadku braku CMS o danym numerze, funkcja zwroci CMS 'Nieznany'.
 * Jesli funkcja zostanie wywolana bez parametru, zwraca laczna ilosc CMS w tablicy (+1 jako cms 'Nieznany').
 * Nowe pozycje dodawac TYLKO na koncu tablicy.
 *
 * @param integer $number
 * @version 1.0.1
 */
function getCmsName(int $number = null){
    $cms = array("Statyczny HTML (brak CMS)", "PastaCMS", "Wordpress", "Joomla", "Drupal",
        "Magento", "Blogger", "Shopify", "Bitrix", "TYPO3", "Squarespace", "PrestaShop",
        "MyBB", "vBulletin", "phpBB");
    if($number !== null){
        if(!empty($cms[$number]))
            return $cms[$number];
        else
            return "Nieznany";
    }else{
        return sizeof($cms)+1;
    }
}

/**
 * Funkcja zwraca nazwe statusu prac nad strona, ktora odpowiada przyporzadkowanemu numerowi.
 * W przypadku statusu o niezanym numerze, funkcja zwroci 'Nieznany'.
 * Jesli funkcja zostanie wywolana bez parametru, zwraca laczna ilosc staelementow tablicy.
 *
 * @param integer $number
 * @version 1.0.0
 */
function getStatusName(int $number = null){
    $status = array(
        /*0*/ "W trakcie produkcji",
        /*1*/ "Ukończono (bez administrowania)",
        /*2*/ "Aktualnie administrowana",
        /*3*/ "Porzucono"
    );
    if($number !== null){
        if(!empty($status[$number]))
            return $status[$number];
        else
            return "Nieznany";
    }else{
        return sizeof($status);
    }
}

/**
 * Funkcja zwraca nazwe typu serwera, ktora odpowiada przyporzadkowanemu numerowi.
 * W przypadku braku typu o danym numerze, funkcja zwroci 'Nieznany'.
 * Jesli funkcja zostanie wywolana bez parametru, zwraca laczna ilosc elementow tablicy.
 *
 * @param integer $number
 * @version 1.0.0
 */
function getServerTypeName(int $number = null){
    $status = array(
        /*0*/ "Hosting",
        /*1*/ "Dedykowany serwer",
        /*2*/ "Inny (podaj w opisie serwera)",
    );
    if($number !== null){
        if(!empty($status[$number]))
            return $status[$number];
        else
            return "Nieznany";
    }else{
        return sizeof($status);
    }
}

/**
 * Funkcja zwraca nazwe poziomu uprawnien uzytkownika, ktora odpowiada przyporzadkowanemu numerowi.
 * W przypadku braku poziomu o danym numerze, funkcja zwroci 'Nieznany'.
 * Jesli funkcja zostanie wywolana bez parametru, zwraca laczna ilosc elementow tablicy.
 *
 * @param integer $number
 * @version 1.0.0
 */
function getUserPermissionName(int $number = null){
    $status = array(
        /*0*/ "Użytkownik",
        /*1*/ "Serwisant Komputerowy",
        /*2*/ "Administrator Stron Internetowych",
        /*3*/ "Administrator Globalny"
    );
    if($number !== null){
        if(!empty($status[$number]))
            return $status[$number];
        else
            return "Nieznany";
    }else{
        return sizeof($status);
    }
}

/**
 * Funkcja zwracajaca tablice zawierajaca znajdujace sie w bazie serwery lub hostingi.
 * Indeks tablicy odpowiada danemu identyfikatorowi serwera.
 *
 * @return array $servers
 * @version 1.0.0
 */
function getServerList(){
    $zapytanie = "SELECT `id`, `server_provider` FROM `servers` ";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    if($query){
        for($i=0; $i<mysqli_num_rows($query); $i++){
            $r = mysqli_fetch_array($query);
            $servers[$r['id']] = $r['server_provider'];
        }
        return $servers;
    }else{
        showError("Podczas tworzenia listy dostępnych serwerów wystąpił błąd!");
    }
}

/**
 * Funkcja generujaca i wyswietlajaca wykres przy uzyciu biblioteki ChartJS.
 * Obsluguje wyswietlanie kilu typow wykresow.
 * Jesli kolorystyka wykresu zostanie podana w RGB, to ostatnia wartosc (przezroczystosc),
 * jesli jest 1 zostaje zamieniona na 0.2 dla tla (ramka jest 1 a tlo 0.2).
 * 
 * @param string $type - typ wykresu
 * @param string $title - tytul wykresu
 * @param array $data - dane, ktore maja zostac wyswietlone na wykresie
 * @param array $labels - opis poszczegolnych danych
 * @param array $colors_border - dodatkowa tablica zawierajaca kolorystyke wykresu. Jesli 'null', do wykres otrzyma jeden z kilku domyslnych zestawow kolorystycznych.
 * Kolory moga zostac podane zarowno w zapisie kodu HTML ('$FFF000'), jak i RGB ('rgba(75, 192, 192, 0.2)').
 * @version 1.0.0
 */
function showChart(string $type, string $title, array $data, array $labels, array $colors_border = null){
    $errors = array();
    if($type != "pie" && $type != "doughnut" && $type != "lineSoft" && $type != "lineSharped" && $type != "bar" && $type != "horizontalBar"){
        $errors[] = "Nieprawidłowy tryb! Dostępne tryby: 'pie', 'doughnut', 'lineSoft', 'lineSharped', 'bar', 'horizontalBar'.";
    }
    if(sizeof($data) != sizeof($labels))
            $errors[] = "Ilość danych oraz ilość opisów nie zgadzają się!";
    if(!empty($colors_border)){
        if(sizeof($data) != sizeof($colors_border))
            $errors[] = "Ilość kolorów dla kategorii oraz ilość kategorii nie zgadzają się!";
    }
    if(sizeof($data) > 19)
        $errors[] = "Za dużo danych! Maksymalna ilość to 19 elementów!";
    
    if(empty($errors)){
        $random_id = md5(uniqid());
        $colors_default = array(
            "#F44336,#E91E63,#9C27B0,#673AB7,#3F51B5,#2196F3,#03A9F4,#00BCD4,#009688,#4CAF50,#8BC34A,#CDDC39,#FFEB3B,#FFC107,#FF9800,#FF5722,#795548,#9E9E9E,#607D8B",
            "#ff7400,#fd8b17,#ffa242,#ffc367,#f9de8a,#cad6db,#b4bfc3,#a2a8b6,#7f96ab,#657790",
            "#0A181F,#143913,#214E63,#2B8274,#349D7C,#3CB45E,#53C653,#77D175,#9CDD98,#B3E6E4",
            "#d50000,#c51162,#aa00ff,#6200ea,#304ffe,#2962ff,#0091ea,#00b8d4,#00bfa5,#00c853",
            "#263238,#212121,#3e2723,#dd2c00,#ff6d00,#ffab00,#ffd600,#aeea00,#64dd17,#00c853",
            "#9dc6d8,#00b3ca,#7dd0b6,#1d4e89,#d2b29b,#e38690,#f69256,#ead98b,#965251,#c6cccc",
            "#BF360C,#E64A19,#FF5722,#FF8A65,#FFCCBC,#FFF3E0,#FFCC80,#FFA726,#F57C00,#E65100",
            "#263238,#455A64,#607D8B,#90A4AE,#CFD8DC,#212121,#616161,#9E9E9E,#E0E0E0,#F5F5F5"
        );

        if($colors_border == null){
            if(sizeof($data) <= 10)
                $colors_border = explode(",", $colors_default[6]);
            else
                $colors_border = explode(",", $colors_default[0]);
        }else{
            for($i=0; $i<sizeof($colors_border); $i++){
                if(preg_match("/^rgba/", $colors_border[$i])){
                    $colors_background[$i] = str_replace("1)", "0.2)", $colors_border[$i]);
                }
            }
        }
        
        if($type == "lineSharped")
            $sharped = "elements: { line: { tension : 0 }},";
        else
            $sharped = null;

        switch($type){
            case "pie":
            case "doughnut":
                $config = "backgroundColor: ['".@implode("','", $colors_border)."']
                        }]},
                        options: {
                            title: {
                                display: true,
                                text: '$title'
                            }}";
                break;

            case "lineSharped":
            case "lineSoft":
                $type = "line";
                $config = "label: '".$title."',

                        <!-- The color of the line -->
                        borderColor: ['rgba(75, 192, 192, 1)'],

                        <!-- The fill color under the line -->
                        backgroundColor: ['rgba(75, 192, 192, 0.2)'],

                        <!-- The border color for points -->
                        pointBorderColor: ['rgba(75, 192, 192, 1)'],

                        <!-- The fill color for points -->
                        pointBackgroundColor: ['rgba(75, 192, 192, 0.2)'],
                        borderWidth: 1
                    }]},
                options: {
                    $sharped
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]}}";
                break;

            case "bar":
            case "horizontalBar":
                $config = "label: '".$title."',
                            backgroundColor: ['".@implode("','", $colors_background)."'],
                            borderColor: ['".@implode("','", $colors_border)."'],
                            borderWidth: 1
                            }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero:true
                                        }
                                    }]}}";
                break;
            default:
                exit(1);
                break;
        }

        echo "<canvas id='$random_id' width='400' height='300'></canvas>
        <script>
            var myChart = new Chart(document.getElementById('$random_id'), {
            type: '$type', data:{
                labels: ['".implode("','", $labels)."'],
                datasets: [{
                    data: [".implode(",", $data)."], $config });
        </script>";
    }else{
        showError("<ul><li>".implode("</li><li>", $errors)."</li></ul>");
    }
}

/**
 * Funkcja pokazujaca wykres z porownaniem zarobkow w poszczegolnych kategoriach uslug.
 * 
 * @param int $year - rok, dla ktorego ma zostac wyswietlony wykres zarobkow.
 * @version 1.0.1
 */
function showPaymentsPieChart(int $year = null){
    if(!$year || !is_numeric($year))
        $year = date("Y");
    $zapytanie = "SELECT 'WEBSITES' AS 'TYPE', YEAR(`payments`.`payment_date`) AS ROK, ROUND(SUM(`payments`.`value`),2) AS ZAROBEK FROM `payments`
        WHERE id_website IS NOT NULL AND YEAR(`payments`.`payment_date`) = ".$year."
        GROUP BY ROK
    UNION
        SELECT 'COMPUTER_SERVICE', YEAR(`payments`.`payment_date`) AS ROK, ROUND(SUM(`payments`.`value`),2) AS ZAROBEK FROM `payments`
        WHERE id_computer_service IS NOT NULL AND YEAR(`payments`.`payment_date`) = ".$year."
        GROUP BY ROK
    UNION
        SELECT 'OTHER', YEAR(`payments`.`payment_date`) AS ROK, ROUND(SUM(`payments`.`value`),2) AS ZAROBEK FROM `payments`
        WHERE id_website IS NOT NULL AND id_computer_service IS NOT NULL AND YEAR(`payments`.`payment_date`) = ".$year."
        GROUP BY ROK";

    $ilosc_kategorii = 3;
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    if($query){
        for($i=0; $i<$ilosc_kategorii; $i++){
            $r = mysqli_fetch_array($query);
            $wartosci[$i] = $r['ZAROBEK'];
        }
        $title = "Zarobki dla danych kategorii w roku ".$year;
        $labels = array("Strony Internetowe", "Serwis Komputerowy", "Inne");
        $colors = array("#FFCD56", "#36A2EB", "#C0C0C0");
        showChart("pie", $title, $wartosci, $labels, $colors);
    }else{
        showError("Nie udało się załadować danych do wyświetlenia wykresu!");
    }
}

/**
 * Funkcja wyswietlajaca wykres miesiecznych zarobkow i finansow firmy dla danego roku.
 * Jesli zarobki na dany miesiac beda ujemne, kolor wykresu dla danego
 * miesiaca zamiast zielonego zostanie oznaczony na czerwono.
 *
 * @param int $year - rok, dla ktorego ma zostac wyswietlony wykres zarobkow.
 * @version 1.0.1
 */
function showMonthlyPaymentsChart(int $year = null){
    if(!$year || !is_numeric($year))
        $year = date("Y");

    $zapytanie = "SELECT MONTH(`payments`.`payment_date`)-1 AS 'MIESIAC', ROUND(SUM(`payments`.`value`),2) AS 'KWOTA' FROM `payments` WHERE YEAR(`payment_date`) = ".$year." GROUP BY MIESIAC ORDER BY MIESIAC";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    $months = ["Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień"];
    $colors = [];

    if($query){
        for($i=0; $i<12; $i++){
            $r = mysqli_fetch_array($query);
            if($r['MIESIAC'] !== null){
                $data[$i] = $r['KWOTA'];
            }else{
                $data[$i] = 0;
            }

            if($r['KWOTA'] >= 0){
                $colors[$i] = "rgba(60, 118, 61, 1)";
            }else{
                $colors[$i] = "rgba(255, 50, 50, 1)";
            }
        }
        showChart("bar", "Łączne miesięczne zarobki", $data, $months, $colors);
    }else{
        showError("Nie udało się załadować danych wymaganych do wyświetlenia wykresu.");
    }
}

/**
 * Funkcja wyswietlajaca wykres liniowy z zarobkami w kolejnych latach.
 *
 * @version 1.0.1
 */
function showYearlyPaymentsChart(){
    $zapytanie = "SELECT YEAR(`payments`.`payment_date`) AS 'ROK', ROUND(SUM(`payments`.`value`),2) AS ZAROBEK FROM `payments` LEFT JOIN `computer_service` ON `payments`.`id_computer_service` = `computer_service`.`id` GROUP BY ROK ORDER BY ROK DESC";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    $years[] = date("Y")-5;
    for($i=1; $i<6; $i++)
        $years[$i] = $years[$i-1]+1;

    if($query){
        for($i=0; $i<6; $i++){
            $r = mysqli_fetch_array($query);
            if($r['ROK'] !== null)
                $data[$i] = $r['ZAROBEK'];
            else
                $data[$i] = 0;
        }
        $data = array_reverse($data);
        showChart("lineSoft", "Porównanie rocznych przychodów", $data, $years);
    }else{
        showError("Nie udało się załadować danych wymaganych do wyświetlenia wykresu.");
    }
}

/**
 * Funkcja wyswietalajaca tabele zlecen serwisu komputerowego.
 * Na poczatku tabeli pojawia sie aktualnie otwarte zlecenia.
 * 
 * @version 1.0.0
 */
function showComputerServiceList(){
    $zapytanie = "SELECT `computer_service`.`id_unique`, `computer_service`.`date_start`, `computer_service`.`device`, `computer_service`.`status`, CONCAT(`clients`.`first_name`, ' ', `clients`.`second_name`) AS 'PERSON' FROM `computer_service` INNER JOIN `clients` ON `computer_service`.`id_client` = `clients`.`id` ORDER BY `computer_service`.`status`, `computer_service`.`date_start` DESC, `computer_service`.`id` DESC ";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    if($query){
        if(mysqli_num_rows($query)>0){
            echo "<table class='table table-bordered table-hover table-striped table-condensed'>
            <tr>
                <th><i class='fa fa-fw fa-calendar'></i> Data przyjęcia</th>
                <th><i class='fa fa-fw fa-user'></i> Klient</th>
                <th><i class='fa fa-fw fa-laptop'></i> Urządzenie</th>
                <th></th>
            </tr>";
            for($i=0; $i<mysqli_num_rows($query); $i++) {
                $r = mysqli_fetch_array($query);
                if($r['status'] == 1)
                    $class = "default";
                else
                    $class = "warning";

                echo "<tr class='".$class."'>
                    <td>".$r['date_start']."</td>
                    <td>".$r['PERSON']."</td>
                    <td>".$r['device']."</td>
                    <td><a href='computerServiceMore.php?id_u=".$r['id_unique']."' class='btn btn-".$class." btn-xs full-width'><i class='fa fa-arrow-right'></i></a></td>
                </tr>";
            }
            echo "</table>";
        }else{
            showInfo("Brak zgłoszeń serwisu komputerowego.");
        }
    }else{
        showError("Nie udało się wyświetlić listy zgłoszeń serwisu komputerowego...");
    }
}

/**
 * Funkcja wyswietlajaca rozwijana liste serwerow, umozliwiajac
 * wybranie konkretnego serwera. Jesli podany zostal parametr 'selected_id',
 * to serwer z podanym unikalnym identyfikatorem zostanie domyslnie wybrany.
 *
 * @param string $selected_id
 * @version 1.0.0
 */
function showServersDopdown(string $selected_id = null){
    $zapytanie = "SELECT `id`, `server_provider` FROM `servers`";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    if($query){
        echo "<optgroup label='Serwery:'>";
        while($r = mysqli_fetch_array($query)){
            if($selected_id && $r['id'] == $selected_id){
                echo "<option value='".$r['id']."' selected>".$r['server_provider']."</option>";
            }else{
                echo "<option value='".$r['id']."'>".$r['server_provider']."</option>";
            }
        }
        echo "</optgroup>";
    }
}

/**
 * Funkcja wyswietlajaca tabele z wszystkimi klientami w systemie.
 * 
 * @version 1.0.0
 */
function showClientsList(){
    $zapytanie = "SELECT `id_unique`, `first_name`, `second_name` FROM `clients` ORDER BY `second_name`, `first_name` ";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    if($query){
        if(mysqli_num_rows($query)>0){
            echo "<table class='table table-bordered table-hover table-striped table-condensed' id='clients_table'>
            <tr>
                <th><i class='fa fa-fw fa-user'></i> Imię</th>
                <th><i class='fa fa-fw fa-user'></i><i class='fa fa-fw fa-sort-alpha-asc'></i> Nazwisko</th>
                <th></th>
            </tr>";
            for($i=0; $i<mysqli_num_rows($query); $i++) {
                $r = mysqli_fetch_array($query);
                echo "<tr>
                    <td>".$r['first_name']."</td>
                    <td>".$r['second_name']."</td>
                    <td><a href='clientsMore.php?id_u=".$r['id_unique']."' class='btn btn-default btn-xs full-width'><i class='fa fa-arrow-right'></i></a></td>
                </tr>";
            }
            echo "</table>";
        }else{
            showInfo("Brak klientów w bazie.");
        }
    }else{
        showError("Nie udało się wyświetlić listy klientów...");
    }
}

/**
 * Funkcja wyswietlajaca rozwijana liste klientow w systemie, umozliwiajac
 * wybranie konkretnego klienta. Jesli podany zostal parametr 'selected_id_u',
 * to klient z podanym unikalnym identyfikatorem zostanie domyslnie wybrany.
 *
 * @param string $selected_id_u
 * @version 1.0.0
 */
function showClientsDopdown(string $selected_id_u = null){
    $zapytanie = "SELECT `id_unique`, CONCAT(`first_name`, ' ', `second_name`) AS 'KLIENT' FROM `clients` ";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    if($query){
        echo "<optgroup label='Klienci:'>";
        while($r = mysqli_fetch_array($query)){
            if($selected_id_u && $r['id_unique'] == $selected_id_u){
                echo "<option value='".$r['id_unique']."' selected>".$r['KLIENT']."</option>";
            }else{
                echo "<option value='".$r['id_unique']."'>".$r['KLIENT']."</option>";
            }
        }
        echo "</optgroup>";
    }
}

/**
 * Funkcja wyswietla liste platnosci dla danej strony internetowej lub serwisu komputerowego,
 * w zaleznosci od wybranego trybu.
 *
 * @param string $mode - tryb wyswietlania. Dostepne tryby: 'website' oraz 'computer_service'
 * @param integer $id - identyfikator strony lub serwisu komputerowego
 * @param bool $editable - czy funkcja ma wyswietlic przyciski pozwalajace na usuwanie wartosci z bazy
 * @version 1.0.0
 */
function showConnectedPayments(string $mode, int $id, bool $editable = null){
    $mode = validate($mode);
    $id = validate($id);
    if($mode == "website" || $mode == "computer_service"){
        $zapytanie = "SELECT * FROM `payments` WHERE `id_$mode`= $id";
        $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
        if($query){
            $bilans = 0;
            for($i=0; $i<mysqli_num_rows($query); $i++){
                $r = mysqli_fetch_array($query);
                $bilans += $r['value'];
                echo "<li class='list-group-item'>".$r['comment'];
                    if($editable)
                        echo "<button class='btn btn-danger btn-xs pull-right' onclick='deletePayment(\"".$mode."\", ".$r['id'].", $id)'><i class='fa fa-trash'></i></button>";
                echo "<span class='badge'><font color='#c2c2c2'>".$r['payment_date']." | </font>".getMoneyValue($r['value'])." zł</span></li>";
            }
            if($bilans > 0)
                echo "<li class='list-group-item list-group-item-info'><b>BILANS</b><span class='badge'>".getMoneyValue($bilans)." zł</span></li>";
            elseif($bilans == 0)
                echo "<li class='list-group-item list-group-item-info'><b>BILANS</b><span class='badge'>0 zł</span></li>";
            else
                echo "<li class='list-group-item list-group-item-danger'><b>BILANS</b><span class='badge'>".getMoneyValue($bilans)." zł</span></li>";
            
        }else{
            showError("Podczas pobierania danych wystąpił błąd!");
        }
    }else{
        showError("Niewłaściwy tryb! Dostępne tryby: 'website' oraz 'computer_service'!");
    }
}

/**
 * Funkcja wyswietlajaca log systemu.
 * @version 1.0.0
 */
function showSiteLog(){
    $zapytanie = "SELECT * FROM `site_log` ORDER BY `site_log`.`time` DESC LIMIT 1000";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    if($query){
            echo "<table class='table table-striped table-bordered table-condensed'>
                    <tr>
                     <th style='width: 80px'><i class='fa fa-fw fa-clock-o'></i> Czas</th>
                     <th style='width: 80px'><i class='fa fa-fw fa-list'></i> Typ</th>
                     <th><i class='fa fa-fw fa-exclamation-circle'></i> Zdarzenie</th>
                    </tr>";
            for ($i=0; $i<mysqli_num_rows($query); $i++){
                $r = mysqli_fetch_array($query);
                switch($r['type']){
                    case 1:
                        $class = "info";
                        $type = "<span class='label label-info'>Informacja</label>";
                        break;
                    case 2:
                        $class = "warning";
                        $type = "<span class='label label-warning'>Ostrzeżenie</label>";
                        break;
                    case 3:
                        $class = "danger";
                        $type = "<span class='label label-danger'>Błąd</label>";
                        break;
                    default:
                        $class = "";
                        $type = "<span class='label label-default'>Nieznany</label>";
                        break;
                }
                echo "<tr class='".$class."'>
                        <td>".$r['time']."</td>
                        <td>".$type."</td>
                        <td>".bbCode($r['comment'])."</td>
                    </tr>";
                }
            echo "</table>";
        }else{
            showError("Nie udało się pokazać logu strony...");
        }
}

/**
 * Funkcja wyswietlajaca cennik. Wszystkie uslugi pogrupowane zostaly w odpowiednie kategorie.
 * Jesli zmienna editable = true, dane zostana wyswietlone w formie input'ow.
 *
 * @param boolean $editable
 * @version 1.0.0
 */
function showPricingList(bool $editable){
    $VAT = 1.23;
    $categories = [
        "Systemy operacyjne",
        "Laptopy",
        "Sieci komputerowe",
        "Strony internetowe",
        "Pozostałe"
    ];
    echo "<table class='table table-striped table-hover table-bordered' id='pricing_table'>";
    for($i=0; $i<sizeof($categories); $i++){
        echo "<tr class='active'>
                <th>".$categories[$i]."</th>
                <th class='text-right' style='width: 115px'>Netto</th>
                <th class='text-right' style='width: 115px'>Brutto</th>
            </tr>";
        $zapytanie = "SELECT * FROM `pricing_list` WHERE `type` LIKE '".$categories[$i]."'";
        $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
        if($query){
            for($x=0; $x<mysqli_num_rows($query); $x++){
                $r = mysqli_fetch_array($query);
                echo "<tr>
                        <td>";
                    if($editable){
                        echo "<input type='text' class='form-control input-sm' value='".$r['service_name']."' id='name-".$i."-".$x."'>
                                <textarea class='form-control input-sm' placeholder='Opis...' maxlength='200' id='description-".$i."-".$x."'>".$r['description']."</textarea>";
                    }else{
                        echo $r['service_name']."<br><i>".$r['description']."</i>";
                    }
                    echo "</td>";
                    
                    if($editable){
                        if($r['value_resizable'] == 0){
                            echo "<td class='warning'><input type='text' class='form-control input-sm' value='".$r['value_default']."' id='price-".$i."-".$x."'></td>
                                <td class='success'><input type='text' class='form-control input-sm' value='AUTO' disabled></td>";
                        }else{
                            echo "<td class='warning'><input type='text' class='form-control input-sm' value='".$r['value_min']." - ".$r['value_max']."' id='price-".$i."-".$x."'></td>
                                <td class='success'><input type='text' class='form-control input-sm' value='AUTO' disabled></td>";
                        }
                    }else{
                        if($r['value_resizable'] == 0){
                            echo "<td class='warning text-right'>".getMoneyValue((float)$r['value_default'])." zł</td>
                                <td class='success text-right'>".getMoneyValue((float)(ceil($r['value_default']*$VAT)))." zł</td>";
                        }else{
                            $value_min = $r['value_min']*$VAT;
                            $value_max = $r['value_max']*$VAT;
                            echo "<td class='warning text-right'>od ".getMoneyValue((float)$r['value_min'])." zł<br>do ".getMoneyValue((float)$r['value_max'])." zł</td>
                                <td class='info text-right'>od ".getMoneyValue((float)ceil($value_min))." zł<br>do ".getMoneyValue((float)ceil($value_max))." zł</td>";
                        }
                    }
                echo "</tr>";
            }
        }
    }
    echo "</table>";
}

/**
 * Funkcja wyswietlajaca liste plikow w podanym katalogu.
 *
 * @param string $path
 * @param bool $editable
 * @version 1.0.0
 */
function showFiles(string $path, bool $editable = null){
    if(is_readable($path)){
        $linked_files = array_diff(scandir($path), array('.', '..'));
        if(!empty($linked_files)){
            echo "<ul class='list-group'>";
            foreach($linked_files as $data)
                if($editable){
                    echo "<li class='list-group-item'>
                            <a href='$path/$data' target='_blank'>
                                <img src='img/svg/pdf.svg' class='icon-20px' alt='PDF' />
                                $data
                            </a>
                            <a href='?id_u=".$_GET['id_u']."&status=deleteDocument&name=".substr($data, 0, strpos($data, "."))."'>
                                <button class='btn btn-danger btn-xs pull-right'><i class='fa fa-trash'></i></button>
                            </a>";
                    echo "</li>";
                }else{
                    echo "<a href='".$path."/".$data."' target='_blank' class='list-group-item'><img src='img/svg/pdf.svg' class='icon-20px' alt='PDF' /> ".$data."</a>";
                }
            echo "</ul>";
        }else{
            showInfo("Brak plików.");
        }
    }else{
        showError("Podana ścieżka nie ma odpowiednich praw do odczytu!");
    }
}

/**
 * Funkcja wyswietlajaca strony internetowe z danej kategorii, w zaleznosci od podanego trybu.
 *
 * @param string $mode - status strony (during_work, finished, administrate, dropped)
 * @version 1.0.1
 */
function showWebsites(string $mode = null){
    if($mode == "during_work" || $mode == "finished" || $mode == "administrate" || $mode == "dropped"){
        switch($mode){
            case "during_work":
                $mode = 0;
                break;
            case "finished":
                $mode = 1;
                break;
            case "administrate":
                $mode = 2;
                break;
            case "dropped":
                $mode = 3;
                break;
        }
        $zapytanie = "SELECT `id`, `id_unique`, `name`, `web_address`, `server_provider`, `domain_provider`, `status`, `cms` FROM `websites` WHERE `status` = $mode ORDER BY `name`";
        $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
        if($query){
            if(mysqli_num_rows($query)>0){
                for($i = 0; $i<mysqli_num_rows($query); $i++){
                    $r = mysqli_fetch_array($query);
                    $class = "default";
                    $wordpress = null;
                    if($r['status'] == 0)
                        $class = "warning";
                    if($r['cms'] == 2)
                        $wordpress = "<a href='http://".$r['web_address']."/wp-admin' class='btn btn-info btn-xs pull-right' style='margin-right: 5px;' target='_blank'>
                                        <i class='fa fa-wordpress'></i> <i class='fa fa-sign-in'></i>
                                    </a>";

                    echo "<div class='alert-$class'>
                            <div class='media-left'>
                                <img class='media-object' src='uploads/img/websites/".$r['id_unique']."/icon.png' alt='".$r['name']."' height='64' width='64'>
                            </div>
                            <div class='media-body'>
                                <h4 class='media-heading'>".$r['name']."</h4>
                                <i>".$r['web_address']."</i>
                                <a href='websitesMore.php?id_u=".$r['id_unique']."'>
                                    <button class='btn btn-$class pull-right'>Więcej</button>
                                </a>
                                $wordpress
                            </div>
                        </div>
                        <hr>";
                }
            }else{
                if($mode != 0)
                    showInfo("Brak stron internetowych w tej kategorii.");
            }
        }else{
            showError("Podczas pobierania danych do wyświetlenia wystąpił błąd!");
        }
    }else{
        showError("Nieprawidłowy tryb! Dostępne tryby to 'during_work', 'finished', 'administrate' oraz 'dropped'.");
    }
}

/**
 * Funkcja wyswietlajaca kalendarz z oznaczonymi miesiacami platnosci za roczne utrzymanie strony internetowej.
 * 
 * @param int $rok
 * @param int $miesiac
 * @version 1.0.0
 */
function showWebsitesCalendar(int $rok, int $miesiac){
    if($rok != null && $miesiac != null){
        $zapytanie = "SELECT `id_unique`, `name`, `payment_for_me`, MONTH(`payment_for_me_date`) AS Miesiac, YEAR(`payment_for_me_date`) AS Rok FROM `websites` WHERE `payment_for_me_date` != '0000-00-00' AND YEAR(`payment_for_me_date`) = '".validate($rok)."' AND MONTH(`payment_for_me_date`) = '".validate($miesiac)."' ";
        $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
        for($i=0; $i<mysqli_num_rows($query); $i++){
            $r = mysqli_fetch_array($query);
            echo "<a href='websitesMore.php?id_u=".$r['id_unique']."' class='btn btn-success btn-xs full-width'>".$r['name']."</a><br><br>";
        }
    }
}

/**
 * Funkcja wyswietlajaca 20 najbardziej zblizajacych sie platnosci od klientow, ktorym utrzymuje strone.
 *
 * @version 1.0.0
 */
function showWebsitesUpcomingPayments(){
    $zapytanie = "SELECT `name`, `payment_for_me`, `payment_for_me_date`, datediff(`payment_for_me_date`,CURDATE()) AS 'roznica', `status` FROM `websites` WHERE `payment_for_me` != 0 AND `status` = 2 ORDER BY `roznica` LIMIT 20 ";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    if($query){
        if(mysqli_num_rows($query) != 0){
            for($i=0; $i<mysqli_num_rows($query); $i++){
                $r = mysqli_fetch_array($query);
                switch($r['roznica']){
                    case ($r['roznica']<0):
                        showError($r['payment_for_me_date']." | ".$r['name']."<p class='pull-right'>".getMoneyValue($r['payment_for_me'])." zł</p><br>".abs($r['roznica'])." dni temu <b>minął termin płatności za roczne utrzymanie</b>!<br>Domena tej strony mogła stracić ważność!<br>Jeśli strona została porzucona, zmień jej status na odpowiedni.");
                        break;
                    case ($r['roznica']<=7):
                        showError($r['payment_for_me_date']." | ".$r['name']."<p class='pull-right'>".getMoneyValue($r['payment_for_me'])." zł</p><br>Pozostało ".$r['roznica']." dni! Jeśli nie zostanie dokonana płatność, domena tej strony może zostać anulowana!");
                        break;
                    case ($r['roznica']<=31):
                        showWarning($r['payment_for_me_date']." | ".$r['name']."<p class='pull-right'>".getMoneyValue($r['payment_for_me'])." zł</p><br>Pozostało ".$r['roznica']." dni!");
                        break;
                    case ($r['roznica']>31):
                        showInfo($r['payment_for_me_date']." | ".$r['name']."<p class='pull-right'>".getMoneyValue($r['payment_for_me'])." zł</p>");
                        break;
                }
            }
        }else{
            showInfo("Brak nadchodzących płatności.");
        }
    }else{
        showError("Podczas pobierania danych wystąpił błąd!");
    }
}

/**
 * Funkcja wyswietlajaca liste serwerow wraz z stronami,
 * ktore sa pod nie podpiete (wymagana funkcja 'showWebsitesHostedOnServer()')
 *
 * @version 1.0.0
 */
function showServers(){
    $zapytanie = "SELECT *, DATEDIFF(`expires_date`, NOW()) AS POZOSTALO_DNI FROM `servers` ";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    if($query){
        if(mysqli_num_rows($query)>0){
            echo "<div class='table-responsive'>
                    <table class='table table-condensed'>";
            for ($i=0; $i<mysqli_num_rows($query); $i++) {
                $r = mysqli_fetch_array($query);
                $type = $r['type'];
                switch($type){
                    case 0:
                        $type = "Hosting";
                        $icon = "hosting.png";
                        break;
                    case 1:
                        $type = "Dedykowany serwer";
                        $icon = "server.png";
                        break;
                    case 2:
                        $type = "Inny typ usługi";
                        $icon = "other.png";
                        break;
                    default:
                        $type = "Nieznany";
                        $icon = "unknown.png";
                        break;
                }

                echo "<tr>
                        <th rowspan='3' class='th-centered'>
                            <img src='img/".$icon."' alt='".$type." icon' style='width: 64px; height='64px'>
                            <br>".$type."
                            <br>".$r['server_provider']."
                        </th>
                        <td colspan='2'>
                            <a href='serversEdit.php?id_u=".$r['id_unique']."' class='btn btn-default btn-xs pull-right'><i class='fa fa-pencil-square-o'></i> Edytuj</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Data wygaśnięcia:</b>
                            <br>".$r['expires_date']." (pozostało ".$r['POZOSTALO_DNI']." dni)
                        </td>
                        <td rowspan='2'>";
                showWebsitesHostedOnServer($r['id']);
                echo "</td>
                    </tr>
                    <tr>
                        <td>
                            <b>Opis:</b>
                            <br>".nl2br(bbCode($r['comment']))."
                        </td>
                    </tr>
                    <tr>
                        <td colspan='4' class='info'></td>
                    </tr>";
            }
            echo "</table></div>";
        }else{
            showInfo("Brak serwerów w bazie.");
        }
    }else{
        showError("Podczas ładowania danych wystąpił nieznany błąd!");
    }
}

/**
 * Funkcja wyswietla w tabeli wszystkie dokonane transakcje (zarobki oraz wydatki).
 * Dane posortowane sa od najnowszych do najstarszych. Maksymalnie wyswietlic mozna 1000 rekordow.
 *
 * @param int $count - ilosc rekordow do wyswietlenia
 * @version 1.0.1
 */
function showTransactions(int $count){
    if($count < 1000){
        $zapytanie = "SELECT payments.*, websites.name FROM `payments` INNER JOIN websites ON `payments`.`id_website` = `websites`.`id` UNION SELECT payments.*, computer_service.device FROM `payments` INNER JOIN computer_service ON `payments`.`id_computer_service` = `computer_service`.`id` ORDER BY `payment_date` DESC, `id` DESC LIMIT ".$count;
        $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
        if($query){
            if(mysqli_num_rows($query) > 0){
                echo "<table class='table table-bordered table-hover table-striped table-condensed'>
                        <tr>
                            <th><i class='fa fa-fw fa-calendar'></i> Data</th>
                            <th><i class='fa fa-fw fa-square'></i> Strona / Urządzenie</th>
                            <th><i class='fa fa-fw fa-commenting'></i> Opis</th>
                            <th style='width: 80px'><i class='fa fa-fw fa-money'></i> Kwota</th>
                        </tr>";
                for($i=0; $i<mysqli_num_rows($query); $i++){
                    $r = mysqli_fetch_array($query);
                    echo "<tr><td>".$r['payment_date']."</td>";
                    if($r['id_website'] != null)
                        echo "<td>[<i class='fa fa-fw fa-globe'></i>] ".$r['name']."</td>";
                    elseif($r['id_computer_service'] != null)
                        echo "<td>[<i class='fa fa-fw fa-laptop'></i>] ".$r['name']."</td>";
                    else
                        echo "<td>[<i class='fa fa-fw fa-credit-card'></i>] Inne</td>";
                    echo "<td>".$r['comment']."</td><td class='text-right'>";
                    if($r['value'] < 0)    
                        echo "<font color='red'>".getMoneyValue($r['value'])." zł</font>";
                    else
                        echo getMoneyValue($r['value'])." zł";
                    echo "</td></tr>";
                }
                echo "</table>";
            }else{
                showInfo("Brak płatności w bazie.");
            }
        }else{
            showError("Podczas ładowania danych wystąpił nieznany bład.<br>Jeśli problem będzie się powtarzał, skontaktuj się z administratorem systemu.");
        }
    }else{
        showError("Funkcja przekracza maksymalną ilość transakcji do zwrócenia (maksymalnie 1000 wyników)! Zmień wartość, a następnie wywołaj funkcję jeszcze raz!");
    }
}

/**
 * Funkcja wyswietlajaca liste stron, ktore sa utrzymywane na serwerze o podanym identyfikatorze.
 * W przypadku braku stron powiazanych z serwerem na liscie pojawi sie jeden wpis - stosowny komunikat.
 *
 * @param integer $id - identyfikator serwera
 * @version 1.0.0
 */
function showWebsitesHostedOnServer(int $id){
    $zapytanie = "SELECT `id_unique`, `name`, `web_address`, `status` FROM `websites` WHERE `server_provider` = ".$id." AND (`status` = 0 OR `status` = 2) ";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    if($query){
        echo "<b>Strony utrzymywane na tym serwerze:</b><br>";
        if(mysqli_num_rows($query)>0){
            for($i=0; $i<mysqli_num_rows($query); $i++){
                $r = mysqli_fetch_array($query);
                if($r['status'] == 0)
                    $class = "label-warning";
                else
                    $class = "label-default";
                echo "<span class='label $class'>".$r['name']."</span> ";
            }
        }else{
            echo "<span class='label label-info'>Brak stron internetowych powiązanych z tą usługą</span>";
        }
    }else{
        showError("Podczas ładowania danych wystąpił nieznany błąd!<br>Jeśli problem będzie się powtarzał częściej, skontaktuj się z administratorem systemu.");
    }
}

/**
 * Funkcja wyswietlajaca wszystkich uzytkownikow systemu.
 *
 * @version 1.0.0
 */
function showUsers(){
    $zapytanie = "SELECT * FROM `users` ";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    if($query){
        echo "<table class='table table-striped'>
                <tr>
                    <th>Login</th>
                    <th>Ostatnio online</th>
                    <th>Poziom uprawnień</th>
                    <th></th>
                </tr>";
        for($i=0; $i<mysqli_num_rows($query); $i++){
            $r = mysqli_fetch_array($query);
            echo "<tr>
                    <td>".$r['login']."</td>
                    <td>".$r['last_online']."</td>
                    <td>".getUserPermissionName($r['permission_level'])."</td>
                    <td>
                        <a href='?status=deleteUser&id=".$r['id_unique']."'><button class='btn btn-danger btn-xs' onclick=\"return confirm('Czy napewno chcesz USUNĄĆ użytkownika ".$r['login']."?')\"><i class='fa fa-trash'></i></button></a>
                    </td>
                </tr>";
        }
        echo "</table>";
    }else{
        showError("Nie udało sie wczytac listy użytkowników!<br>Jeśli problem będzie się powtarzał, skontaktuj sie z administracją systemu!");
    }
}

/**
 * Funkcja wyswietlajaca wykres miesiecznie zakonczonych zgloszen serwisu komputerowego.
 *
 * @version 1.0.0
 */
function showMonthlyComputerServiceChart(){
    $zapytanie = "SELECT MONTH(`date_end`)-1 AS 'MIESIAC', COUNT(`id`) AS 'ILOSC' FROM `computer_service` WHERE `status` = 1 AND YEAR(`date_end`) = YEAR(CURDATE()) GROUP BY MONTH(`date_end`)-1 ";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    $months = ["Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień"];
    $data = [];
    if($query){
        for($i=0; $i<12; $i++){
            $r = mysqli_fetch_array($query);
            if($r['MIESIAC'] !== null)
                $data[$i] = $r['ILOSC'];
            else
                $data[$i] = 0;
        }
        showChart("lineSoft", "Ilość zakończonych zgłoszeń", $data, $months);
    }else{
        showError("Nie udało się załadować danych wymaganych do wyświetlenia wykresu.");
    }
}

/**
 * Funkcja wyswietlajaca losowy cytat.
 *
 * @version 1.0.0
 */
function showRandomQuote(){
    $quotes = [
        "'Potykając się, można zajść daleko; nie wolno tylko upaść i nie podnieść się.' ~ Goethe",
        "'Motywacja jest tym, co pozwala Ci zacząć. Nawyk jest tym, co pozwala Ci wytrwać.' ~ Jim Ryun",
        "'Wiele rzeczy małych stało się wielkimi, tylko dzięki odpowiedniej reklamie.' ~ Mark Twain",
        "'Nigdy, nigdy, nigdy, nigdy się nie poddawaj.' ~ Winston Churchill",
        "'W biznesie czas pracy nie gra roli. Ważne jest tylko to, aby zdążyć na czas i aby być na czasie.' ~ Ewa Lewandowska",
        "'Jakość pamięta się o wiele dłużej niż cenę.' ~ Gucci",
        "'Naszym absolutnie fundamentalnym celem jest zarabianie pieniędzy poprzez zadowolenie klientów.' ~ Sir John Egan",
        "'Jeżeli coś ci się nie uda, możesz być rozczarowany. Jeżeli jednak nie będziesz dalej próbować, już po tobie.' ~ Beverly Sills",
        "'70% naszych decyzji zakupowych podejmujemy w oparciu o to, jak jesteśmy traktowani jako ludzie, a tylko 30% bazuje na właściwościach produktu.' ~ John McKean",
        "'Nie bój się zrobić czegoś głupiego. W najgorszym razie to po prostu nie zadziała.' ~ Peter Shankman",
        "'Każda marka jest ze swej natury doświadczeniem. Firmy mają patenty, produkty i procesy, zaś konsumenci mają marki - w swoich głowach, sercach, zdobyte poprzez doświadczenia.' ~ Marek Jeżewski",
        "'Wsłuchiwanie się w głos klientów powinno stać się biznesem każdej firmy.' ~ Tom Peters",
        "'O jakości można mówić, kiedy tym co do nas wraca są klienci a nie produkty' ~ motto Siemensa"
    ];
    echo $quotes[rand(0, sizeof($quotes)-1)];
}

/**
 * Funkcja wyswietla tytul witryny jako 'PastaMedia | [TEXT]'.
 * 
 * @param string $title
 * @version 1.0.0
 */
function showSiteTitle(string $title){
    return "PastaMedia | ".$title;
}

/* ########################################
 * # 2. Funkcje walidujace i sprawdzajace
 * ######################################## */

/**
 * Funkcja zamieniajaca BB-Code na kod HTML. Oblsuguje znaczniki:
 * [b], [i], [u], [s], [center], [hr], [br], [a], [img], [code], [color]
 * 
 * @param string $text
 * @version 1.0.0
 */
function bbCode(string $text){
    $text = str_replace("[b]", "<b>", str_replace("[/b]", "</b>", $text));
    $text = str_replace("[i]", "<i>", str_replace("[/i]", "</i>", $text));
    $text = str_replace("[u]", "<u>", str_replace("[/u]", "</u>", $text));
    $text = str_replace("[s]", "<s>", str_replace("[/s]", "</s>", $text));
    $text = str_replace("[center]", "<center>", str_replace("[/center]", "</center>", $text));
    $text = str_replace("[hr]", "<hr>", $text);
    $text = str_replace("[br]", "<br>", $text);
    // A HREF
    $text = preg_replace("#\[a\](.*?)\[/a\]#si",'<a href="\\1" target="_blank" />*Zewnętrzny Link*', $text);
    // IMG
    $text = preg_replace("#\[img\](.*?)\[/img\]#si",'<img src="\\1" alt="" style="max-width:300px;" />', $text);
    // CODE
    $text = preg_replace("#\[code\](.*?)\[/code\]#si",'<pre>\\1</pre>', $text);
    // FONT COLOR
    $text = preg_replace("#\[color=(http://)?(.*?)\](.*?)\[/color\]#si", "<span style=\"color:\\2\">\\3</span>", $text);
    return $text;
}

/**
 * Funkcja walidujaca otrzymane dane.
 *
 * @param string $text - dane do walidacji
 * @param int $mode - tryb walidowania (restrykcyjny(true) oraz domyslny(false))
 * @version 1.0.0
 */
function validate(string $text = null, int $mode = null){
    if($text != null){
        $text = str_replace('"', '\"', $text);
        $text = str_replace("'", "\'", $text);
        if($mode)
            return trim(htmlspecialchars($text));
        else
            return htmlspecialchars($text);
    }else{
        return false;
    }
}

/**
 * Funkcja przyjmujaca wartosc liczbowa, i zwracajaca ta wartosc w poprawnej
 * notacji pieniedzy, tj. 10,00, 15,99, itd...
 *
 * @param float $value
 * @version 1.0.0
 */
function getMoneyValue(float $value = null){
    if($value)
        return number_format((float)$value, 2);
    else
        return false;
}

/**
 * Funkcja sprawdzajaca, czy aktualnie zalogowany uzytkownik ma odpowiednie uprawnienia.
 * Jeśli aktualnie nie ma zalogowanego zadnego uzytkownika, funkcja wyswietli komunikat
 * o wygaslej sesji wraz z linkiem do logowania.
 * 
 * @param int $level - minimalny poziom uprawnien, aby zwrocic true
 * @version 1.0.2
 */
function checkUserPermissions(int $level){
    $zapytanie = "SELECT `permission_level` FROM `users` WHERE `id_unique` LIKE '".@$_SESSION['JezusServerHome']."'";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    if($query){
        if(mysqli_num_rows($query) > 0){
            $r = mysqli_fetch_array($query);
            if($r['permission_level'] == $level){
                return true;
            }else{
                return false;
            }
        }else{
            showError("Wygląda na to, że sesja logowania wygasła! Zaloguj się ponownie <a href='".WEB_ADDRESS."/login.php'>tutaj</a>");
            exit(0);
        }
    }else{
        showError("Nie udało się sprawdzić poziomu uprawnień użytkownika!");
        return false;
    }
}

/**
 * Funkcja sprawdzajaca, czy w logu systemu nie doszlo do jakichkolwiek podejrzanych zdarzen,
 * np. 10x pod rzad nieudana proba zalogowania do systemu lub tez nieprawidlowy status zdarzenia.
 *
 * @version 1.0.0
 */
function checkLogAnomaly(){
    $anomaly = [];
    $error = false;

    // Sprawdzenie nietypowego statusu zdarzenia
    $zapytanie = "SELECT `id` FROM `site_log` WHERE `type` != 1 AND `type` != 2 AND `type` != 3 ";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    if($query){
        if(mysqli_num_rows($query) > 0)
            $anomaly[] = "Nieprawidłowe statusy zdarzeń (ilość: ".mysqli_num_rows($query).")";
    }else{
        $error = true;
    }

    // Sprawdzenie nieudanych prob logowania
    $zapytanie = "SELECT `id`, `time` FROM `site_log` WHERE `type` = 3 AND `comment` LIKE 'Nieudana pr__ba zalogowania%' ORDER BY `id` DESC";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    if($query){
        $counter = 0;
        $last_id = null;
        while($r = mysqli_fetch_array($query)){
            if($r['id']-- == $last_id)
                $counter++;
            else
                $counter = 0;
            $last_id = $r['id'];
            if($counter > 8){
                $anomaly[] = "Prawdopodobna próba włamania do systemu! Ponad 8 pozycji pod rząd w logu systemu to nieudane próby logowania!";
                break;
            }
        }
    }else{
        $error = true;
    }

    if($error)
        showError("Nie udało się pobrać przynajmniej części danych z logu systemu!<br>Automatyczne sprawdzanie logu nie działa właściwie!");
    if(!empty($anomaly))
        showError("Automatyczny system kontroli logów systemu wykrył następujące błędy:<ul><li>".implode("</li><li>", $anomaly)."</li></ul>");
}

/**
 * Funkcja sprawdzajaca, czy nie zbliza sie data platnosci za domene strony internetowej.
 * W razie platnosci w terminie mniejszym niz miesiac, funkcja wyswietla odpowiedni komunikat.
 * 
 * @version 1.0.0
 */
function checkDomainExpire(){
    $zapytanie = "SELECT `id_unique`, `name`, `domain_expire_date`, DATEDIFF(`domain_expire_date`, CURDATE()) AS 'ROZNICA' FROM `websites` WHERE `status` = 2 AND `domain_expire_date` != '0000-00-00'";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    if($query){
        for($i = 0; $i < mysqli_num_rows($query); $i++){
            $r = mysqli_fetch_array($query);
            if($r['ROZNICA']<0)
                showError(abs($r['ROZNICA'])." dni temu <b>wygasła domena</b> dla strony '<b>".$r['name']."</b>'!<br>Jeśli domena nie będzie odnawiana, przejdź do edycji strony i oznacz ją jako porzuconą.<br>W innym przypadku poinformuj klienta, że cena za odnowienie domeny wyniesie więcej z uwagi na jej wygaśnięcie!");
            elseif($r['ROZNICA']<=7)
                showError("Pozostało ".$r['ROZNICA']." dni do opłaty za <b>domenę</b> dla strony '<b>".$r['name']."</b>'! (domena wygasa ".$r['domain_expire_date'].")<br>Za ".$r['ROZNICA']." dni <b>domena zostanie anulowana</b>, a cena za jej ponowne wznowienie mocno wzrośnie!<br><a href='websitesMore.php?id_u=".$r['id_unique']."' class='alert-link'>Przejdź do ustawień strony</a>");
            elseif($r['ROZNICA']<=14)
                showWarning("Pozostało ".$r['ROZNICA']." dni do opłaty za <b>domenę</b> dla strony '<b>".$r['name']."</b>'! (domena wygasa ".$r['domain_expire_date'].")<br><a href='websitesMore.php?id_u=".$r['id_unique']."' class='alert-link'>Przejdź do ustawień strony</a>");
            elseif($r['ROZNICA']<=30)
                showInfo("Pozostało ".$r['ROZNICA']." dni do opłaty za <b>domenę</b> dla strony '<b>".$r['name']."</b>'! (domena wygasa ".$r['domain_expire_date'].")<br>Pamiętaj, aby poinformować klienta o zbliżającej się płatności!");
        }
    }else{
        showError("Nie udało się załadować danych stron internetowych!");
    }
}

/**
 * Funkcja sprawdzajaca, czy jakis serwis komputerowy nie trwa dluzej niz tydzien.
 * W razie zbyt dlugiego czasu zgloszenia serwisu, wyswietli odpowiedni komunikat.
 * 
 * @version 1.0.0
 */
function checkComputerService(){
    $zapytanie = "SELECT `id_unique`, `date_start`, `status`, datediff(CURDATE(), `date_start`) AS roznica FROM `computer_service` WHERE `status` = 0 AND date_start ORDER BY `date_start` ";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    if($query){
        $ile = mysqli_num_rows($query);
        for($i=0; $i<$ile; $i++){
            $r = mysqli_fetch_array($query);
            if($r['roznica'] >= 21)
                showError("Jedno ze zleceń serwisu komputerowego <b>trwa już ponad trzy tygodnie</b>!<br><a href='computerServiceMore.php?id_u=".$r['id_unique']."' class='alert-link'>Zobacz to zlecenie</a>.");
            elseif($r['roznica'] >= 10)
                showWarning("Jedno ze zleceń serwisu komputerowego trwa już ponad półtorej tygodnia!<br><a href='computerServiceMore.php?id_u=".$r['id_unique']."' class='alert-link'>Zobacz to zlecenie</a>.");
        }
    }else{
        showError("Nie udało się załadować danych serwisu komputerowego!");
    }
}

/**
 * Funkcja sprawdza, czy nie zbliza sie termin oplaty za serwer,
 * a w razie platnosci w terminie mniejszym niz miesiac wyswietla odpowiedni komunikat.
 * 
 * @version 1.0.0
 */
function checkServersExpire(){
    $zapytanie = "SELECT `server_provider`, `expires_date`, datediff(`expires_date`, CURDATE()) AS roznica FROM `servers` WHERE `expires_date` IS NOT NULL ";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    if($query){
        $ile = mysqli_num_rows($query);
        for($i=0; $i<$ile; $i++){
            $r = mysqli_fetch_array($query);
            if($r['roznica'] < 0)
                showError(abs($r['roznica'])." dni temu <b>wygasła usługa hostingu lub serwera</b>! (<b>".$r['server_provider']."</b>)<br>Jeśli usługa nie będzie odnawiana, usuń ją.");
            elseif($r['roznica'] < 7)
                showError("Pozostało mniej niż tydzień (".$r['roznica']." dni) do wygaśnięcia usługi serwera lub hostingu! (<b>".$r['server_provider']."</b>)<br><a href='servers.php' class='alert-link'>Przejdź do panelu zarządzania serwerami</a>");
            elseif($r['roznica'] < 31)
                showWarning("Pozostało mniej niż miesiąc (".$r['roznica']." dni) do wygaśnięcia usługi serwera lub hostingu! (<b>".$r['server_provider']."</b>)<br><a href='servers.php' class='alert-link'>Przejdź do panelu zarządzania serwerami</a>");
        }
    }else{
        showError("Nie udało się załadować danych serwerów!");
    }
}

/**
 * Funkcja sprawdza, czy odpowiednie foldery maja prawidlowe uprawnienia.
 * W razie wykrycia nieprawidlowych uprawnien, zwraca komunikat o nieproawidlowosci.
 * 
 * @version 1.0.0
 */
function checkFolderPermissions(){
    $errors = array();
    $paths = array("uploads/doc/websites",
                   "uploads/img/websites",
                   "uploads/doc/computer_service",
                   "uploads/img/computer_service");
    foreach ($paths as $path) {
        if(is_writable($path) == false)
            $errors[] = $path;
    }

    if(!empty($errors)){
        showError("Foldery: <ul><li>".implode("</li><li>", $errors)."</li></ul> nie posiadają odpowiednich praw zapisu!");
    }
}

/**
 * Funkcja logujaca do systemu. Najpierw sprawdza, czy podany uzytkownik istnieje
 * w bazie danych. Jesli tak, sprawdza podane haslo. Jesli wszystko sie zgadza,
 * do sesji JezusServerHome przypisane zostaje unikatowe id uzytkownika a sam
 * uzytkownik zostaje zalogowany.
 * Funkcja wywolywana glownie przez AJAX z pliku login.php.
 * 
 * @param string $login
 * @param string $password
 * @version 1.0.0
 */
function login(string $login, string $password){
    $login = validate($login, 0);
    $password = validate($password, 0);

    $zapytanie = "SELECT `id_unique`, `login`, `password`, `permission_level` FROM `users` WHERE `login` LIKE '".$login."'";
    $query = mysqli_query($GLOBALS['polaczenie'], $zapytanie);
    $r = mysqli_fetch_array($query);
        
    if($login == $r['login'] && password_verify($password, $r['password'])){
            $_SESSION['JezusServerHome'] = $r['id_unique'];
            if($_SESSION['JezusServerHome']){
                $zapytanie = "UPDATE `users` SET `last_online` = '".date('Y-m-d H:i:s')."' WHERE `id_unique` LIKE '".$r['id_unique']."'";
                if(mysqli_query($GLOBALS['polaczenie'], $zapytanie)){
                    echo "OK";
                    exit();
                }else{
                    addToLog(2, "Zalogowano użytkownika ".$login.", ale wystąpił błąd podczas aktualizowania czasu ostatniego logowania.");
                    echo "OK";
                }
            }else{
                addToLog(3, "Nie udało się utworzyć sesji logowania dla użytkownika ".$login.".");
                echo "ERR";
            }
    }else{
        addToLog(3, "Nieudana próba zalogowania na konto: ".$login."[br]- Przeglądarka: ".$_SERVER['HTTP_HOST']."[br]- User Agent: ".$_SERVER['HTTP_USER_AGENT']."[br]- Adres IP Hosta: ".$_SERVER['REMOTE_ADDR']."[br]- Port: ".$_SERVER['REMOTE_PORT']);
        echo "BAD_PASSWORD";
    }
}

/**
 * Funkcja odpowiadajaca za wylogowanie z systemu.
 * 
 * @version 1.0.0
 */
function logout(){
    session_destroy();
    echo "Zostałeś wylogowany z systemu!";
}

/* ########################################
 * # 3. Funkcje wyswietlajace komunikaty
 * ######################################## */

/**
 * Funkcja wyswietlajaca komunikat zakonczenia operacji informacja.
 * 
 * @param string $message
 * @version 1.0.0
 */
function showInfo(string $message){
    echo "<div class='alert alert-info'> <i class='fa fa-info-circle'></i> ".$message."</div>";
}

/**
 * Funkcja wyswietlajaca komunikat zakonczenia operacji sukcesem.
 * 
 * @param string $message
 * @version 1.0.0
 */
function showSuccess(string $message){
    echo "<div class='alert alert-success'> <i class='fa fa-fw fa-info-circle'></i> ".$message."</div>";
}

/**
 * Funkcja wyswietlajaca komunikat zakonczenia operacji ostrzezeniem.
 * 
 * @param string $message
 * @version 1.0.0
 */
function showWarning(string $message){
    echo "<div class='alert alert-warning'> <i class='fa fa-fw fa-exclamation-triangle'></i> <strong>Uwaga!</strong><br>".$message."</div>";
}

/**
 * Funkcja wyswietlajaca komunikat zakonczenia operacji bledem.
 * 
 * @param string $message
 * @version 1.0.0
 */
function showError(string $message){
    echo "<div class='alert alert-danger'> <i class='fa fa-fw fa-exclamation-triangle'></i> <strong>UWAGA!</strong><br>".$message."</div>";
}

/* #################################
 * #
 * ### Funkcje w trakcie rozwijania
 * #
 * #################################
 */

/**
 * Funkcja laczaca sie z zewnetrznym API na serwerze
 * i pobierajaca wyniki ankiety jakosci pracy informatyka.
 * 
 * @param string $mode - okresla jakie dane ma zwrocic API (websites, computer_service, other). W przypadku null API zwroci wyniki dla wszystkich kategorii.
 */
function getPollResults(string $mode){
    $api_link = "http://localhost/dashboard/ACTUAL%20WORK/PastaMedia%20Survey%20API/api.php";
    $key = "gwWoh1IAuU82BQVq22hAq3hGbW8F1Ozm-kvw1F32Q2610rSiq7mRwI2jCBsh4isBw";
    $available_modes = [
        "a",
        "b"
    ];
    if(in_array($mode, $available_modes)){
        $data = file_get_contents($api_link."?key=".$key."&mode=".$mode);
        if($data){
            //return json_decode($data);
        }else{
            showError("Nie udało się odebrać danych z zewnętrzengo API systemu ankietowego.");
        }
    }else{
        showError("Nieprawidłowy tryb! Dostępne tryby to: '".implode("', '", $available_modes)."'.");
    }
}
?>