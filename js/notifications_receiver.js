//find chat with users
const notifBadge = document.querySelector('#notifButton > span');
notifBadge.setAttribute('style','display:none;');

function updateNotificationsCounter(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        const response = JSON.parse(this.responseText);
        if(response.counter > 0){
            notifBadge.setAttribute('style','');
            notifBadge.innerHTML = response.counter + '<span aria-label="unread messages"></span>';
        } else {
            notifBadge.setAttribute('style','display:none;');
        }
    };
    xhttp.open('GET','api_notifications_counter.php');
    xhttp.send();
}

setInterval(updateNotificationsCounter,500);
