function validateform() {
    var pwd = document.myform.pwd.value;
    var pwdrep = document.myform.pwdrepeat.value;
    if (pwd.length < 6) {
        alert("La password deve essere almeno di 6 caratteri");
        return false;
    }
    if (pwd !== pwdrep) {
        alert("Password diverse");
        return false;
    }
    return true;
}


function checkEmail() {

    var email = document.getElementById('email');
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!filter.test(email.value)) {
        alert('Email non valido, si prega di inserire un formato valido');
        email.focus;
        return false;
    }
    return true;
}