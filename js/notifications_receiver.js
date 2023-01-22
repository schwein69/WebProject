const notifBadge = document.querySelector('#notifButton > span');

function updateNotificationsCounter(){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        const response = JSON.parse(this.responseText);
        if(response.counter > 0){
            if(notifBadge.classList.contains('d-none')){
                notifBadge.classList.remove('d-none');
            }
            notifBadge.innerHTML = response.counter + '<span aria-label="new notifications"></span>';
        } else {
            if(!notifBadge.classList.contains('d-none')){
                notifBadge.classList.add('d-none');
            }
        }
    };
    xhttp.open('GET','api_notifications_counter.php?type=g');
    xhttp.send();
}

setInterval(updateNotificationsCounter,500);
