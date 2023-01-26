document.querySelector("button[id*=PswButton]").addEventListener("click",function (e) {
    const pwd = document.querySelector('input[name="pwd"]');
    const pwdrep =document.querySelector('input[name="pwdrepeat"]');
    if (pwd.value.length < 6) {
        pwd.value = "";
        let errormsg = document.documentElement.lang == "it" ? "<p class='errmsg' style='display:block'>La password deve essere almeno di 6 caratteri</p>" : "<p class='errmsg' style='display:block'>Password must have 6 or more characters</p>";
        if(pwd.nextElementSibling == null){
            pwd.insertAdjacentHTML("afterend", errormsg)
        }
        e.preventDefault();
    }
    if (pwd.value !== pwdrep.value) {
        pwdrep.value = "";
        let errormsg = document.documentElement.lang == "it" ? "<p class='errmsg' style='display:block'>Password diverse</p>" : "<p class='errmsg' style='display:block'>Different passwords</p>";
        if(pwdrep.nextElementSibling == null){
            pwdrep.insertAdjacentHTML("afterend", errormsg)
        }
        e.preventDefault();
    }
});



