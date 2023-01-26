document.querySelector("main form > button").addEventListener("click", function (e) {

    const email = document.getElementById('email');
    const filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    const dateFilter = /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/;
    const date = document.getElementById('date');


    if (!filter.test(email.value) || email.value == "") {
        email.value = "";
        let errormsg = document.documentElement.lang == "it" ? "<p class='errmsg' style='display:block'>Email non valido, si prega di inserire un formato valido</p>" : "<p class='errmsg' style='display:block'>Email not valid, please insert a valid format</p>";
        if (email.nextElementSibling == null) {
            email.insertAdjacentHTML("afterend", errormsg)

        }
        e.preventDefault();
    }
    //in account settings
    if (date != null) {
        if (!dateFilter.test(date.value)) {
            date.value = "";
            let errormsg = document.documentElement.lang == "it" ? "<p class='errmsg' style='display:block'>La data deve essere in formato dd-mm-yyyy</p>" : "<p class='errmsg' style='display:block'>The format of date must be dd-mm-yyyy</p>";
            if (date.nextElementSibling == null) {
                date.insertAdjacentHTML("afterend", errormsg)

            }
            e.preventDefault();
        }
    }

});



