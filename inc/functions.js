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
 * = Funkcje JavaScript dla PastaCMS
 * = = = = = = = = = = = = = = = = = =
 * =
 * = 1. Funkcje AJAX
 * = 2. Inne funkcje JavaScript
 * =
 * = = = = = = = = = = = = = = = = = =
 */

/* ---------------------------------
 * 0. Inicjalizacja
 * --------------------------------- */
$(window).ready(function () {
    setMenuActive();
});

/* ---------------------------------
 * 1. Funkcje AJAX
 * --------------------------------- */

 /**
  * Funkcja laczaca sie przez AJAX z serwerem PHP i uruchamiajaca dodawanie nowej platnosci do bazy.
  * W miejscu zastosowania funkcji znalezc musza sie 3 pola input o id:
  * - new_payment_date - data platnosci
  * - new_payment_amount - kwota
  * - new_payment_name - nazwa platnosci
  * @param {string} mode 
  * @param {int} id 
  * @version 1.0.1
  */
function addNewPayment(mode, id){
    if(mode == "website" || mode == "computer_service" || mode == "other"){
        var date = $("#new_payment_date").val();
        var amount = $("#new_payment_amount").val();
        var name = $("#new_payment_name").val();
        if(date && amount && name){
            if(!isNaN(id)){
                name = name.replace("+", "%2B");
                name = name.replace("&", "%26");
                $.ajax({
                    url: "inc/ajax.php?f=addNewPayment&mode="+mode+"&id="+id+"&date="+date+"&amount="+amount+"&name="+name,
                    success:function(response){
                        switch(response){
                            case "OK":
                                showSuccess("add_payment_alert", "Dodano nową płatność w wysokości "+amount+" zł!");
                                $("#new_payment_date").val(null);
                                $("#new_payment_amount").val(null);
                                $("#new_payment_name").val(null);
                                showConnectedPayments("payments_list", mode, id, true);
                                break;
                            case "ERR_ID":
                                showError("add_payment_alert", "Podany przez funkcję identyfikator jest nieprawidłowy!");
                                break;
                            case "ERR_MODE":
                                showError("add_payment_alert", "Podany tryb jest nieprawidłowy! Dostępne tryby to: 'website', 'computer_service' oraz 'other'.");
                                break;
                            case "ERR_QUERY":
                                showError("add_payment_alert", "Podczas dodawania nowych danych wystąpił błąd!");
                                break;
                            default:
                                showError("add_payment_alert", "Podczas dodawania płatności wystąpił nieznany błąd!");
                                break;
                        }
                    },
                    error:function(){
                        showError("add_payment_alert", "Podczas łączenia z wymaganymi funkcjonalnościami systemu wystąpił nieoczekiwany błąd!");
                    }
                });
            }else{
                showError("add_payment_alert", "Podany identyfikator lub wartość prawdopodobnie nie jest liczbą!");
            }
        }else{
            showError("add_payment_alert", "Nie udało się pobrać danych z pola daty, kwoty lub komentarza do płatności! Jeśli problem będzie się powtarzał, sprawdź dokumentację tej funkcji.");
        }
    }else{
        showError("add_payment_alert", "Podany tryb funkcji jest niewłaściwy! Dostępne tryby to: 'website', 'computer_service' oraz 'other'.");
    }
}

/**
 * Funkcja wyswietla liste polaczonych ze zleceniem lub strona platnosci.
 * Dostepne tryby: 'website', 'computer_service' oraz 'other'.
 * @param {string} return_id - identyfikator div w ktorym ma wyswietlic liste
 * @param {string} mode - dla jakiej kategorii wyswietlic dane
 * @param {int} id - identyfikator strony/serwisu, dla ktorego zaladowac dane
 * @param {bool} editable - czy elementy maja zawierac przycisk usuniecia?
 * @version 1.0.0
 */
function showConnectedPayments(return_id, mode, id, editable){
    if(mode == "website" || mode == "computer_service" || mode == "other"){
        $.ajax({
            url:"inc/ajax.php?f=showConnectedPayments&mode="+mode+"&id="+id+"&editable="+editable,
            success:function(response){
                if(response.indexOf("list-group-item")>=0)
                    $("#"+return_id).html(response); //list-group-item
                else
                    showError("add_payment_alert", "Podczas odświeżania listy płatności wystąpił błąd!");
            },
            error:function(){
                showError("add_payment_alert", "Podczas łączenia z listą płatności wystąpił błąd!");
            }
        });
    }else{
        showError("add_payment_alert", "Podany tryb funkcji jest niewłaściwy! Dostępne tryby to: 'website', 'computer_service' oraz 'other'.");
    }
}

/**
 * Funkcja usuwajaca dana platnosc, a nastepnie wyswietlajaca odswiezona liste platnosci.
 * @param {string} mode - dla jakiej kategorii wyswietlic dane po usunieciu platnosci
 * @param {int} id_delete - identyfikator platnosci, ktora ma zostac usunieta
 * @param {int} id_work - identyfikator strony lub zlecenia serwisu komputerowego
 * @version 1.0.0
 */
function deletePayment(mode, id_delete, id_work){
    if(!isNaN(id_delete)){
        if(mode == "website" || mode == "computer_service" || mode == "other"){
            $.ajax({
                url:"inc/ajax.php?f=deletePayment&id="+id_delete,
                success:function(response){
                    switch(response){
                        case "OK":
                            showSuccess("add_payment_alert", "Płatność usunięta!");
                            console.log(mode); // DEBUG
                            showConnectedPayments("payments_list", mode, id_work, true);
                            break;
                        case "ERR_QUERY":
                            showError("add_payment_alert", "Podczas wysyłania danych do bazy wystąpił błąd!");
                            break;
                        case "ERR_WRONG_ID":
                            showError("add_payment_alert", "Wysłany do funkcji identyfikator prawdopodobnie nie jest liczbą!");
                            break;
                        default:
                            showError("add_payment_alert", "Podczas wykonywania operacji wystąpił nieznany błąd!");
                            break;
                    }
                },
                error:function(){
                    showError("add_payment_alert", "Podczas łączenia z głównymi funkcjami systemu wystąpił błąd!");
                }
            });
        }else{
            showError("add_payment_alert", "Podany tryb funkcji jest niewłaściwy! Dostępne tryby to: 'website', 'computer_service' oraz 'other'.");
        }
    }else{
        showError("add_payment_alert", "Wysłany do funkcji identyfikator prawdopodobnie nie jest liczbą!");
    }
}

/* ---------------------------------
 * 2. Inne funkcje JavaScript
 * --------------------------------- */

 /**
 * Funkcja przeszukujaca tabele w poszukiwaniu ciagu znakow podanego na wejsciu.
 * Edytuje podana tabele tak, aby wyswietlac tylko wiersze, gdzie w kolumnie numer
 * 'td_number' (liczac od lewej od 0) znajduje sie wartosc zawierajaca ciag znakow
 * na wejsciu.
 * @param {string} id_input
 * @param {string} id_table
 * @param {int} td_number
 * @version 1.0.0
 */
function searchInsideTable(id_input, id_table, td_number){
    var input = $("#"+id_input);
    var filter = input.val().toUpperCase();
    var table = document.getElementById(id_table);
    var tr = table.getElementsByTagName("tr");
    var results_counter = 0;
  
    for (i = 0; i < tr.length; i++) {
      var td = tr[i].getElementsByTagName("td")[td_number];
      if (td) {
        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
          results_counter++;
        } else {
          tr[i].style.display = "none";
        }
      }
    }

    if(results_counter == 0){
        table.style.display = "none";
    }else{
        table.style.display = "";
    }
}

/**
 * Funkcja wyswietlajaca formularz dodawania nowego klienta do bazy.
 * @param {string} display_id - identyfikator div lub innego elelemtu, do ktorego ma zostac zwrocony
 * formularz dodawania nowego klienta.
 * @version 1.0.0
 */
function showAddNewClientForm(display_id){
    $("#"+display_id).html(
        '<div class="panel panel-default"><div class="panel-body">'
        + '<b>Nowy klient:</b><hr>'
        + '<div class="form-group">'
        + '<label>Imię <font color="red">*</font></label>'
        + '<div class="input-group mb-2 mr-sm-2 mb-sm-0">'
        + '<div class="input-group-addon"><i class="fa fa-fw fa-user"></i></div>'
        + '<input type="text" class="form-control" name="client_first_name" autocomplete="on" required>'
        + '</div></div>'

        +' <div class="form-group">'
        + '<label>Nazwisko <font color="red">*</font></label>'
        + '<div class="input-group mb-2 mr-sm-2 mb-sm-0">'
        + '<div class="input-group-addon"><i class="fa fa-fw fa-user"></i></div>'
        + '<input type="text" class="form-control" name="client_second_name" autocomplete="on" required>'
        + '</div></div>'

        + '<div class="row">'
        + '<div class="form-group col-md-5">'
        + '<label>Telefon kontaktowy</label>'
        + '<div class="input-group mb-2 mr-sm-2 mb-sm-0">'
        + '<div class="input-group-addon"><i class="fa fa-fw fa-phone"></i></div>'
        + '<input type="tel" class="form-control" name="client_phone" autocomplete="off" minlength=9 maxlength=9>'
        + '</div></div>'

        + '<div class="col-md-1 text-center"><b>LUB<br><i class="fa fa-fw fa-step-backward"></i><i class="fa fa-fw fa-step-forward"></i></b></div>'

        + '<div class="form-group col-md-6">'
        + '<label>Email</label>'
        + '<div class="input-group mb-2 mr-sm-2 mb-sm-0">'
        + '<div class="input-group-addon"><i class="fa fa-fw fa-at"></i></div>'
        + '<input type="email" class="form-control" name="client_mail" autocomplete="off">'
        + '</div></div>'
        + '</div>'

        +'</div></div>'
    );
}

/**
 * Funkcja sprawdzajaca, czy numer ma dwie cyfry. Jesli ma jedna, dopisuje
 * zero wiodace i zwraca numer dwucyfrowy.
 * @param {int} number 
 * @version 1.0.0
 */
function checkTime(number) {
    if(number<10){
        number="0"+number;
    }
    return number;
}

/**
 * Funkcja wyswietlajaca aktualna date i godzine. Odswieza sie co sekunde.
 * @version 1.0.0
 */
function startClock() {
    var today = new Date();
    $("#clock").html(checkTime(today.getDate()) + "-" + checkTime(today.getMonth()+1) + "-" + today.getFullYear() + "<br>" + checkTime(today.getHours()) + ":" + checkTime(today.getMinutes()) + ":" + checkTime(today.getSeconds()));
    t = setTimeout(function () {
        startClock()
    }, 500);
}

/**
 * Funkcja oznaczajaca kolorem zoltym aktualny miesiac w kalendarzu platnosci.
 * @version 1.0.0
 */
function currentMonth() {
    var date = new Date().getMonth() + 1;
    var year = new Date().getFullYear();
    var selected_year = $("#aktualny_rok").html().match(/\d+/g).map(Number);
    if (!selected_year) {
        selected_year = year;
    }
    if (selected_year == year)
        $("#month"+date).addClass("warning");
}

/**
 * Funkcja wstawiajaca template do pola 'input' opisu serwisu komputerowego.
 * @param {string} id
 * @version 1.0.0
 */
function setComputerServiceTemplate(id) {
    $("#"+id).val("[b]Ustalenia wstępne:[/b]\n\n[b]Diagnoza:[/b]\n\n[b]Przebieg pracy:[/b]\n\n[b]Podsumowanie:[/b]");
}

/**
 * Funkcja wstawiajaca otrzymany tekst do pola 'input' z nazwa dodawanej platnosci.
 * @param {string} text 
 * @version 1.0.0
 */
function setPaymentName(text){
    $("#new_payment_name").val(text);
}

/**
 * Funkcja wyswietlajaca login dla panelu administracyjnego
 * @version 1.0.0
 */
function redirectToCPanel(){
    if (confirm('Po wciśnięciu przycisku OK zostaniesz przekierowany do logowania cPanel.')) {
        alert("p501215");
        window.open("http://psc1997.xaa.pl:2082", "_blank");
    }
}

/**
 * Funkcja wyswietlajaca komunikat o sukcesie w miejscu, ktorego ID zostalo podane na wejsciu.
 * @param {string} display_id - identyfikator div lub innego elementu, w ktorym ma wyswietlic sie komunikat
 * @param {string} text - tresc komunikatu o powodzeniu operacji
 * @version 1.0.0
 */
function showSuccess(display_id, text){
    $("#"+display_id).html("<div class='alert alert-success alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><i class='fa fa-fw fa-info-circle'></i> "+text+"</div>");
}

/**
 * Funkcja wyswietlajaca komunikat o bledzie w miejscu, ktorego ID zostalo podane na wejsciu.
 * @param {string} display_id  - identyfikator div lub innego elementu, w ktorym ma wyswietlic sie komunikat
 * @param {string} text - tresc komunikatu o bledzie podczas operacji
 * @version 1.0.0
 */
function showError(display_id, text){
    $("#"+display_id).html("<div class='alert alert-danger alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><i class='fa fa-fw fa-exclamation-triangle'></i> <strong>UWAGA!</strong><br>"+text+"</div>");
}


/* ############################
 * # TODO
 * ############################
*/

/**
 * Funkcja zaznaczajaca w menu aktualnie otwarta strone.
 * Funkcja sprawdza, jaki plik jest aktualne otwarty (pobiera go z paska adresu przegladarki),
 * a nastepnie wyszukuje w obiekcie 'menu_select' jaka pozycje w menu ma zaznaczyc.
 */
function setMenuActive() {
    var file = window.location.pathname.split('/').pop();
    file = file.substr(0, file.length-4);

    var menu_select = {
        "dashboard":"Dashboard",
        "websites":"Strony Internetowe",
        "websitesMore":"Strony Internetowe",
        "websitesEdit":"Strony Internetowe"
    };


    //alert(menu_select.file.val());
    /*var name = $("#menu_left").childNode.nodeValue;
    alert(name);*/
}
