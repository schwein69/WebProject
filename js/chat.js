const txtBox = document.getElementById('inputMsg');
const sendBtn = document.querySelector('form > input[type="submit"]');
const chatid = document.getElementsByName('chatid')[0].value;
sendBtn.addEventListener('click', event => {
    event.preventDefault();
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {

    };
xhttp.open("POST", "event_send_message.php");
xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
console.log('msg: ' + txtBox.value);
console.log('chat id: ' + chatid);
xhttp.send("chatid=" + chatid + "&msg=" + txtBox.value);
});