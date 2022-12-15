
function logout() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        const response = JSON.parse(this.responseText);
        if (response) {
            window.location.href = "login.php";
        }
    };
    xhttp.open("POST", "logout-event.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
}