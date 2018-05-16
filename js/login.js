
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
 */

/* ====================================================
 * ===== INICJALIZACJA ZDARZEN
 * ==================================================== */

$("#login")
    .click(function(){
        $(this).attr("placeholder", "");
    })
    .focusout(function(){
        $(this).attr("placeholder", "Użytkownik");
    });

$("#passwd")
    .click(function(){
        $(this).attr("placeholder", "");
    })
    .focusout(function(){
        $(this).attr("placeholder", "Hasło");
    });

$("#login-button")
    .click(function(){
        login();
    });

$(document).keypress(function(e) {
    if(e.which == 13) {
        login();
    }
});

/* ====================================================
 * ===== KOMUNIKACJA Z SERWEREM BAZODANOWYM
 * ==================================================== */

 /**
  * Funkcja komunikujaca sie z serwerem PHP i sprawdzajaca(po stronie PHP),
  * czy uzytkownik podal prawidlowe dane logowania.
  * @version 1.0.1
  */
function login(){
    if($("#login").val() != "" && $("#passwd").val() != "")
            if($("#login").val().length < 4 || $("#passwd").val().length < 4){
                show_error("Login i hasło nie mogą mieć mniej niż 4 znaki!");
            }else{
                $("#title").html("Sprawdzam poprawność danych...");
                $.ajax({
                    type:"post",
                    url:"inc/ajax.php?f=login",
                    data:$("form").serialize(),
                    success:function(response){
                        switch(response){
                            case "OK":
                                $("#error").hide();
                                $('form').fadeOut(500);
                                $('.wrapper').addClass('form-success');
                                $("#title").html("Zalogowano pomyślnie!");
                                setTimeout("window.location.href = 'dashboard.php';", 2500);
                                break;
                            case "BAD_PASSWORD":
                                show_error("Nieprawidłowy login lub hasło!");
                                $("#title").html("PastaMedia");
                                break;
                            default:
                                show_error("Podczas logowania wystąpił błąd!<br>Kod: 0x69");
                                $("#title").html("PastaMedia");
                                break;
                        }
                    },
                    error:function(response){
                        $("#title").html("Podczas logowania wystąpił błąd!<br>Kod: 0x55");
                    }
                });
        }else{
            show_error("Wypełnij wszystkie pola!");
    }
}

/**
 * Funkcja wyswietlajaca blad
 * @param {string} text 
 * @version 1.0.1
 */
function show_error(text){
    $("#error")
        .html(text)
        .fadeIn("slow");
}