
document.getElementById("changeThemeButton").addEventListener("click",changeTheme);

function changeTheme() {
    let targetTheme = document.body.getAttribute('data-theme') === 'd' ? 'l' : 'd';
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        const response = this.responseText;
        if (response) {
            document.body.setAttribute("data-theme", targetTheme);
        }

    };
    xhttp.open("POST", "theme-api.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("newTheme=" + targetTheme);
}
