//TODO reading messages
//TODO autoreceive messagges
//enter page at bottom
document.addEventListener('load',window.scrollTo(0, document.body.scrollHeight));


//send messages
const txtBox = document.getElementById('inputMsg');
const sendBtn = document.querySelector('form > input[type="submit"]');
const errElem = document.getElementById('errMsg');
const chatid = document.getElementsByName('chatid')[0].value;
sendBtn.addEventListener('click', event => {
    event.preventDefault();
    if(txtBox.value.trim()!=""){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            const timeStamp = new Date(Date.now());
            const response = JSON.parse(this.responseText);
            if(response.status){
                const newMsg = document.createElement('div');
                const lastMsg = document.querySelector('main > div.row > div > div:last-child');
                newMsg.classList.add('chat-msg');
                newMsg.classList.add('my-1');
                newMsg.classList.add('text-end');
                newMsg.classList.add('ms-auto');
                const timeString = timeStamp.getDate() + "-"
                                   + timeStamp.getMonth() + "-"
                                   + timeStamp.getFullYear() + " "
                                   + timeStamp.getHours() + ":"
                                   + timeStamp.getMinutes();
                newMsg.innerHTML = '<p>' + txtBox.value + '</p>'
                                    + '<span class="text-end">' + timeString + '</span>';
                if(lastMsg!=null){
                    lastMsg.insertAdjacentElement("afterend",newMsg);
                } else {
                    document.querySelector('main > div.row > div').appendChild(newMsg);
                }
                txtBox.value="";
                window.scrollTo(0, document.body.scrollHeight);
            } else {
                errElem.innerText = response.err;
            }
        };
        xhttp.open("POST", "event_send_message.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("chatid=" + chatid + "&msg=" + txtBox.value.trim());
    }
});

//endless scroll
const messagesOffset= 1;
let currentStart = 10;

function chatScrollingTop(){
    if(window.scrollY == 0){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            const response = JSON.parse(this.responseText);
            if(response.status){
                response.messages.forEach(element => {
                    const chatElement = document.createElement('div');
                    chatElement.classList.add('chat-msg');
                    chatElement.classList.add('my-1');
                    
                    if(element.isSecondUser){
                        chatElement.classList.add('text-start');
                    } else{
                        chatElement.classList.add('text-end');
                        chatElement.classList.add('ms-auto');
                    }
                    chatElement.innerHTML = '<p>' + element.testoMsg +'</p>'
                                            + '<span class="text-end">'
                                            + element.msgTime
                                            '</span>';
                    const firstMessage = document.querySelector('main div.chat-msg');
                    firstMessage.parentNode.insertBefore(chatElement, firstMessage);
                });
            }
        };
        xhttp.open('POST', 'api_chat.php');
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send('chatid='+ chatid +'&start=' + currentStart + '&end=' + messagesOffset);
        currentStart += messagesOffset;
    }
}
let scrollingTimeout = null;
document.addEventListener('scroll', event => {
    if(window.scrollY == 0){
        scrollingTimeout = setInterval(chatScrollingTop, 300);
    } else if(scrollingTimeout != null){
        clearInterval(scrollingTimeout);
        scrollingTimeout = null;
    }
});