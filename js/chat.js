window.scrollTo(0, document.body.scrollHeight);

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
                const lastMsg = document.querySelector('main > div.row > div > div:last-child');
                const newMsg = document.createElement('div');
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