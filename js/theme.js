
document.getElementById("changeThemeButton").addEventListener("click",changeTheme);

function changeTheme() {
    const selectedValue = document.getElementById("themes").value;
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        const response = this.responseText;
        if (response) {
            document.body.setAttribute("data-theme", selectedValue);
        }

    };
    xhttp.open("POST", "theme-api.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("newTheme=" + selectedValue);
}
