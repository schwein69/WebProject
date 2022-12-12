const searchBox = document.getElementById('searchBox');

searchBox.addEventListener('input', event => {
    const text = searchBox.value.trim();
    console.log('text: ' + text);
    if(text != ""){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            const response = JSON.parse(this.responseText);
            console.log(response);
        };
        xhttp.open('POST','api_search_chat.php');
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send('text=' + text);
    }
});