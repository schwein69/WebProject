
const chatButton = document.getElementById('menuChatButton');
let chatBadge;
if(chatButton != null){
    chatBadge = chatButton.querySelector('span:nth-child(2)');
    chatBadge.setAttribute('display','display:none;');
    setInterval(updateNewMessagesNumber,300);
}
function updateNewMessagesNumber(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(){
        const response = JSON.parse(this.responseText);
        if(response.chats.length > 0){
            let totMsgs = 0;
            response.chats.forEach(element => {
                totMsgs += element.numMsgs;
            });
            chatBadge.innerHTML = totMsgs + '<span aria-label="unread messages"></span>';
            chatBadge.setAttribute('style','');
        } else{
            chatBadge.setAttribute('style','display:none;');
        }
    };
    xhttp.open('GET','api_notifications_counter.php?type=c');
    xhttp.send();

}
