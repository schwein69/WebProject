/*function loadDoc(event) {
    event.preventDefault();
    const inputValue = document.getElementById("searchValue").value;
    const searchValue = document.getElementsByName("searchOption").value;//by tag or by username
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        const response = JSON.parse(this.responseText);
        let posts = generaPosts(response.data);
        const appendAfterSearchBar = document.getElementById("searchbar").nextElementSibling;
        appendAfterSearchBar.innerHTML = posts;
    };
    xhttp.open("POST", "api-search.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("inputValue=" + inputValue + "&searchValue"+ searchValue);
}*/