if (sessionStorage.getItem("bool") === null) {
    sessionStorage.setItem("bool", true)
}

//funcion para mostrar la contraseña
function verpassword(bool){
    //var tipo = document.getElementById("passLogin");
    var tipo = bool ? document.getElementById("passLogin") : document.getElementById("passSingUp");
    console.log(bool);
    console.log(tipo);

    if(tipo.type == "password") tipo.type = "text"; 

    else tipo.type = "password";
}

function btnLogin(bool) {
    sessionStorage.setItem("bool", bool);
    
    if (sessionStorage.getItem("bool") == "true") MostrarLogin();
    else MostrarLogin();
}

document.addEventListener("DOMContentLoaded", function() { MostrarLogin(); });

function MostrarLogin() {
    if (sessionStorage.getItem("bool") == "true") {
        $('.login').css('display','none');
        $('.singup').css('display','flex');
        //sessionStorage.setItem("bool", false);
    } else {
        $('.login').css('display','flex');
        $('.singup').css('display','none');
        //sessionStorage.setItem("bool", true);
    }
}

function correo(str) {
    if (str === null || str == "") return;
    if (str.indexOf("@") == str.lastIndexOf("@") && 
    str.indexOf("@") > 0 && 
    str.lastIndexOf(".") > (str.indexOf("@") + 1)  && 
    str.indexOf("@") < str.length && 
    str.indexOf("@") > 2 && 
    str.indexOf("@") < (str.length - 2) && 
    str.lastIndexOf(".") < (str.length - 1)&&
    esLetra(str.charAt(str.indexOf("@")+1)) && 
    esLetra(str.charAt(str.indexOf("@")-1))) {
        return true;
    } else {
        return false;
    }
    function esLetra (char) {
        let ascii = char.toUpperCase().charCodeAt(0);
        return (ascii > 64 && ascii < 91) || (ascii > 47 && ascii < 58);
    };
}