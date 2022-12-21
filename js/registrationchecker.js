document.querySelector("main form > button").addEventListener("click",function (e) {
    var pwd = document.querySelector("main form").pwd;
    var pwdrep =document.querySelector("main form").pwdrepeat;
    var email = document.getElementById('email');
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!filter.test(email.value)) {
        email.value = "";
        let errormsg = "<p>Email non valido, si prega di inserire un formato valido</p>";
        if(email.nextElementSibling == null){
            email.insertAdjacentHTML("afterend", errormsg)
        }
        e.preventDefault();
    }else{
        if(email.nextElementSibling){
            email.nextElementSibling.remove();
        }
    }
    if (pwd.value.length < 6) {
        pwd.value = "";
        let errormsg = "<p>La password deve essere almeno di 6 caratteri</p>";
        if(pwd.nextElementSibling == null){
            pwd.insertAdjacentHTML("afterend", errormsg)
        }
        e.preventDefault();
    }else{
        if(pwd.nextElementSibling){
            pwd.nextElementSibling.remove();
        }
    }
    if (pwd.value !== pwdrep.value) {
        pwdrep.value = "";
        let errormsg = "<p>Password diverse</p>";
        if(pwdrep.nextElementSibling == null){
            pwdrep.insertAdjacentHTML("afterend", errormsg)
        }
        e.preventDefault();
    }else{
        if(pwdrep.nextElementSibling){
            pwdrep.nextElementSibling.remove();
        }
    }
    return true;

});



