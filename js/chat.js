//enter page at bottom
document.addEventListener('load',window.scrollTo(0, document.body.scrollHeight));

//resize chat body
const chatContainer = document.querySelector('main > div.row:nth-child(2)');
const initialHeight = chatContainer.offsetHeight;
function resizeChatBody(){
    console.log('Resize');
    const chatTopOffset = window.pageYOffset + chatContainer.getBoundingClientRect().top;
    const inputTextHeight = document.getElementById('chat-bottom').offsetHeight;
    const footerHeight = document.querySelector('body > div > footer > div').offsetHeight;
    const bottomMargin = 30;
    const minChatHeight = document.body.offsetHeight - chatTopOffset - footerHeight - inputTextHeight - bottomMargin;
    console.log('H:' + chatContainer.offsetHeight);
    console.log('MinH:' + minChatHeight);
    if(initialHeight < minChatHeight){
        chatContainer.setAttribute('style','height:'+minChatHeight+"px");
    }
}

resizeChatBody();
window.addEventListener('resize',resizeChatBody);

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
                newMsg.innerHTML = '<p>' + response.text + '</p>'
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

function readNewMessages(){
    const xhttp = new XMLHttpRequest();
    xhttp.open('POST', 'api_chat.php');
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('chatid='+ chatid);

}

//receive new messages
function getNewMessages(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(){
        const response = JSON.parse(this.responseText);
        if(response.status && response.messages.length > 0){
            //update previous messages start point
            currentStart += response.messages.length;
            //set the new messages as read
            readNewMessages();
            //adding new messages to the page
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
                const lastMessage = document.querySelector('main div.chat-msg:last-child');
                lastMessage.parentNode.insertBefore(chatElement, lastMessage.nextSibling);
            });
        }
    }
    xhttp.open('POST', 'api_chat.php');
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('chatid='+ chatid +'&read=' + false);
}

setInterval(getNewMessages, 200);