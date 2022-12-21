
const container = document.body;
console.log(document.getElementById("changeThemeButton"));
document.getElementById("changeThemeButton").addEventListener("click",changeTheme);

function changeTheme() {
    let targetTheme = container.getAttribute('data-theme') === 'd' ? 'l' : 'd';
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        const response = this.responseText;
        if (response) {
            container.setAttribute("data-theme", targetTheme);
        }

    };
    xhttp.open("POST", "theme-api.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("newTheme=" + targetTheme);
}
