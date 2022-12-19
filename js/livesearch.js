
window.onload = function() {
    document.getElementById("searchTextArea").addEventListener("keyup", showResult);
}

function showResult() {
    const textValue = document.getElementById("searchTextArea");
    const radioValue = document.querySelector('input[type="radio"][name="searchOption"]:checked');
    if (textValue.value.length == 0 || radioValue == null) {
        document.getElementById("search keyword").innerHTML = "";
        document.getElementById("search keyword").style.border = "0px";
        return;
    } else if (textValue.value.length > 0 && radioValue != null) {
        let xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            const response = JSON.parse(this.responseText);
            let concat = "";
            response.forEach(element => {
                concat += '<option value="' + element + '" />';
            });
            document.getElementById("search keyword").innerHTML = concat;
            document.getElementById("search keyword").style.border = "1px solid #A5ACB2";

        }
        xhttp.open("POST", "liveSearch.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("textValue=" + textValue.value + "&radioValue=" + radioValue.value);

    }
}
