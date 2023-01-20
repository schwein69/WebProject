//find chat with users
const searchBox = document.getElementById('searchBox');
const resultSpace = document.querySelector('main > div:nth-child(2)');

//endless scroll variables
const chatOffset= 5;
const tolerance = 10;
let currentEnd = chatOffset;
const chatList = document.querySelector('main ul');


searchBox.addEventListener('input', event => {
    const text = searchBox.value.trim();
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        const response = JSON.parse(this.responseText);
        if(response.status){
            currentEnd = chatOffset;
            if(response.chats.length == 0){
                resultSpace.innerHTML = "<p>Nessuna chat trovata</p>";
            } else {
                let content = '<ul class="list-group chatbg p-0">';
                response.chats.forEach(element => {
                    content += '<li id="chat' + element["idChat"] + '" class="list-group-item chatbg">' 
                            + '<a href="chat.php?chatId=' + element["idChat"] + '">'
                            + '<div class="row">'
                            + '<div class="col-3">'
                            + '<img class="chatAvatar" src="' + element["fotoProfilo"] + '" alt="' + element["username"] + '"/>'
                            + '</div>'
                            + '<div class="row col-9">'
                            + '<h2>' + element["username"] + '</h2>'
                            + '<div class="row mx-auto">'
                            + '<p>' + element["anteprimaChat"] + '</p>'
                            + '<span style="'+ (element["unreadMessages"] > 0 ? "":"display:none") + ';" class="badge bg-secondary">' + element["unreadMessages"] + '</span>'
                            + '</div>'
                            + '</div>'
                            + '</div>'
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
document.addEventListener('scroll', event => {
    if((document.body.offsetHeight + window.scrollY) >= (document.body.scrollHeight - tolerance)
    && chatList != null){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            const response = JSON.parse(this.responseText);
            if(response.status){
                response.chats.forEach(element => {
                    
                    const chatElement = document.createElement('li');
                    chatElement.classList.add("list-group-item","chatbg");
                    chatElement.id = "chat" + element["idChat"]; 
                    chatElement.innerHTML = '<a href="chat.php?chatId=' + element["idChat"] + '">'
                            + '<div class="row">'
                            + '<div class="col-3">'
                            + '<img class="chatAvatar" src="' + element["fotoProfilo"] + '" alt="' + element["username"] + '"/>'
                            + '</div>'
                            + '<div class="row col-9">'
                            + '<h2>' + element["username"] + '</h2>'
                            + '<div class="row mx-auto">'
                            + '<p>' + element["anteprimaChat"] + '</p>'
                            + '<span style="'+ (element["unreadMessages"] > 0 ? "":"display:none") + ';" class="badge bg-secondary">' + element["unreadMessages"] + '</span>'
                            + '</div>'
                            + '</div>'
                            + '</div>'
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

//update chats preview
function updateChatsPreview(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        const response = JSON.parse(this.responseText);
        if(response.status){
            response.chats.forEach(element => {
                const chatElem = document.getElementById('chat'+element["idChat"]);
                chatElem.querySelector('p').innerHTML = element["anteprimaChat"];
                if(element["unreadMessages"] > 0){
                    const chatElemBadge = chatElem.querySelector('span')
                    chatElemBadge.innerHTML = element["unreadMessages"];
                    chatElemBadge.setAttribute('style','');
                }
            });
        }
    };
    xhttp.open('POST', 'api_search_chat.php');
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('testo='+ searchBox.value.trim() +'&start=' + 0 + '&end=' + currentEnd);
}



setInterval(updateChatsPreview,300);