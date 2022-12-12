const searchBox = document.getElementById('searchBox');
const resultSpace = document.querySelector('main > div:nth-child(2)');

searchBox.addEventListener('input', event => {
    const text = searchBox.value.trim();
    console.log('text: ' + text);
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        const response = JSON.parse(this.responseText);
        if(response.status){
            console.log(response);
            if(response.chats.length == 0){
                resultSpace.innerHTML = "<p>Nessuna chat trovata</p>";
            } else {
                let content = '<ul class="list-group">';
                response.chats.forEach(element => {
                    content += '<li class="list-group-item">' 
                            + '<a href="chat.php?chatId=' + element["idChat"] + '">'
                            + '<img src="' + element["fotoProfilo"] + '" alt="' + element["username"] + '"/>'
                            + '<h2>' + element["username"] + '</h2>'
                            + '<p>' + element["anteprimaChat"] + '</p>'
                            + '</a>'
                            + '</li>';
                });
                content += "</ul>";
                resultSpace.innerHTML = content;
            }
        }
    };
    xhttp.open('POST','api_search_chat.php');
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('text=' + text);
    
});