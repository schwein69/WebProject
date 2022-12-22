
document.getElementById("thumb").addEventListener("dblclick", function (e) {
    document.getElementById("image").click();
});

document.querySelector("input[type='file']").addEventListener("change", function (event) {
    document.getElementById("thumb").src = URL.createObjectURL(event.target.files[0]);
});

/*document.getElementById("updateDataButton").addEventListener("click", function (event) {
    const username = document.getElementById("name");
    const email = document.getElementById("email");
    const birthday = document.getElementById("date");
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        const response = JSON.parse(this.responseText);
        
    };
    xhttp.open("POST", "api-changeUserData.php.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("name=" + username.value + "&email=" + email.value + "&date=" + birthday.value);
});

*/
