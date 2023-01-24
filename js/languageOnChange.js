document.getElementById("notLoggedLanguages").onchange = function() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        window.location.reload();
    };
    xhttp.open("POST", "changeLanguageWhenNotLogged.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("newLanguage=" + this.value);
  }

  
