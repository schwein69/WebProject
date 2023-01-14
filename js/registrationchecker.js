document.querySelector("main form > button").addEventListener("click",function (e) {
    const pwd = document.querySelector("main form").pwd;
    const pwdrep =document.querySelector("main form").pwdrepeat;
    const email = document.getElementById('email');
    const username = document.getElementById('name');
    const emailFilter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    const date = document.getElementById('date');
    const whitespaceFilter = /\s/g;
    //regex expression taken at https://stackoverflow.com/questions/15491894/regex-to-validate-date-formats-dd-mm-yyyy-dd-mm-yyyy-dd-mm-yyyy-dd-mmm-yyyy
    const dateFilter = /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/;

    //username check
    if(areThereDangerousChars(username.value)){
        username.nextElementSibling.setAttribute('style','display:block');
        username.nextElementSibling.nextElementSibling.removeAttribute('style');
        e.preventDefault();
    } else if(whitespaceFilter.test(username.value)){
        username.nextElementSibling.nextElementSibling.setAttribute('style','display:block');
        username.nextElementSibling.removeAttribute('style');
    } else{
        username.nextElementSibling.removeAttribute('style');
        username.nextElementSibling.nextElementSibling.removeAttribute('style');
    }

    //email check
    if (!emailFilter.test(email.value)) {
        email.nextElementSibling.setAttribute('style','display:block');
        e.preventDefault();
    }else{
        email.nextElementSibling.removeAttribute('style');
    }

    //date check
    if (!dateFilter.test(date.value)) {
        date.value = "";
        date.nextElementSibling.setAttribute('style','display:block');
        e.preventDefault();
    } else {
        date.nextElementSibling.removeAttribute('style');
    }
    
    //password check
    if (pwd.value.length < 6) {
        pwd.nextElementSibling.setAttribute('style','display:block');
        e.preventDefault();
    }else{
        pwd.nextElementSibling.removeAttribute('style');
    }

    //password matching check
    if (pwd.value !== pwdrep.value) {
        pwdrep.nextElementSibling.setAttribute('style','display:block');
        e.preventDefault();
    }else{
        pwdrep.nextElementSibling.removeAttribute('style');
    }
});



