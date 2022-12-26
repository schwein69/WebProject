document.querySelector("main form > button").addEventListener("click",function (e) {
    const pwd = document.querySelector("main form").pwd;
    const pwdrep =document.querySelector("main form").pwdrepeat;
    const email = document.getElementById('email');
    const emailFilter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    const date = document.getElementById('date');
    //regex expression taken at https://stackoverflow.com/questions/15491894/regex-to-validate-date-formats-dd-mm-yyyy-dd-mm-yyyy-dd-mm-yyyy-dd-mmm-yyyy
    const dateFilter = /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/;

    if (!emailFilter.test(email.value)) {
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

    if (!dateFilter.test(date.value)) {
        date.value = "";
        date.setAttribute("placeholder", 'La data deve essere in formato dd-mm-yyyy');
        e.preventDefault();
        return false;
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



