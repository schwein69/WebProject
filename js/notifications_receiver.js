//TODO add this script to every page that requires it
//TODO put display none in html

const notifBadge = document.querySelector('#notifButton > span');
notifBadge.setAttribute('style','display:none;');

function updateNotificationsCounter(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        const response = JSON.parse(this.responseText);
        if(response.counter > 0){
            notifBadge.setAttribute('style','');
            notifBadge.innerHTML = response.counter + '<span aria-label="new notifications"></span>';
        } else {
            notifBadge.setAttribute('style','display:none;');
        }
    };
    xhttp.open('GET','api_notifications_counter.php?type=g');
    xhttp.send();
}

setInterval(updateNotificationsCounter,500);
