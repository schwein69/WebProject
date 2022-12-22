document.querySelector("main form > button").addEventListener("click",function (e) {
    var pwd = document.querySelector("main form").pwd;
    var pwdrep =document.querySelector("main form").pwdrepeat;
    
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



