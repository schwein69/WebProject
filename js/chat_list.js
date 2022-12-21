//find chat with users
const searchBox = document.getElementById('searchBox');
const resultSpace = document.querySelector('main > div:nth-child(2)');

searchBox.addEventListener('input', event => {
    const text = searchBox.value.trim();
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        const response = JSON.parse(this.responseText);
        if(response.status){
            if(response.chats.length == 0){
                resultSpace.innerHTML = "<p>Nessuna chat trovata</p>";
            } else {
                let content = '<ul class="list-group">';
                response.chats.forEach(element => {
                    content += '<li class="list-group-item">' 
                            + '<a href="chat.php?chatId=' + element["idChat"] + '">'
                            + '<img class="chatAvatar" src="' + element["fotoProfilo"] + '" alt="' + element["username"] + '"/>'
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

//endless scroll
const chatOffset= 5;
let currentEnd = chatOffset;
const chatList = document.querySelector('main ul');
document.addEventListener('scroll', event => {
    if((document.body.offsetHeight + window.scrollY) == document.body.scrollHeight
    && chatList != null){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            const response = JSON.parse(this.responseText);
            if(response.status){
                response.chats.forEach(element => {
                    const chatElement = document.createElement('li');
                    chatElement.classList.add("list-group-item"); 
                    chatElement.innerHTML = '<a href="chat.php?chatId=' + element["idChat"] + '">'
                            + '<img class="chatAvatar" src="' + element["fotoProfilo"] + '" alt="' + element["username"] + '"/>'
                            + '<h2>' + element["username"] + '</h2>'
                            + '<p>' + element["anteprimaChat"] + '</p>'
                            + '</a>';
                    chatList.appendChild(chatElement);
                });
            }
        };
        xhttp.open('POST', 'api_search_chat.php');
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send('testo='+ searchBox.value.trim() +'&start=' + currentEnd + '&end=' + chatOffset);
        currentEnd += chatOffset;
    }
});