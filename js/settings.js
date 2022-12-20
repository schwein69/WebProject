
/*document.getElementById("logout")
    .addEventListener("click", function (e) {
        if (!confirm("Do you want logout?")) {
            e.preventDefault();
        } else {
            logout();
        }
    });

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
}*/