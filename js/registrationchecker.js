document.querySelector("main form > button").addEventListener("click",function (e) {
    var pwd = document.querySelector("main form").pwd;
    var pwdrep =document.querySelector("main form").pwdrepeat;
    var email = document.getElementById('email');
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!filter.test(email.value)) {
        email.value = "";
        email.setAttribute("placeholder", 'Email non valido, si prega di inserire un formato valido');
        e.preventDefault();
        return false;
    }
    if (pwd.value.length < 6) {
        pwd.value = "";
        pwd.setAttribute("placeholder", "La password deve essere almeno di 6 caratteri");
        e.preventDefault();
        return false;
    }
    if (pwd.value !== pwdrep.value) {
        pwdrep.value = "";
        pwdrep.setAttribute("placeholder", "Password diverse");
        e.preventDefault();
        return false;
    }
    return true;

});



