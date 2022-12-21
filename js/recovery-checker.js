document.querySelector("main form > button").addEventListener("click",function (e) {

    var email = document.getElementById('email');
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!filter.test(email.value)) {
        email.value = "";
        email.setAttribute("placeholder", 'Email non valido, si prega di inserire un formato valido');
        e.preventDefault();
    }
});



