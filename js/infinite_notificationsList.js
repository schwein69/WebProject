//endless scroll
const chatOffset= 5;
const tolerance = 10;
let currentEnd = chatOffset;
const notifList = document.querySelector('main ul');
document.addEventListener('scroll', addNotification);

addNotification();

function addNotification(){
    if((document.body.offsetHeight + window.scrollY) >= (document.body.scrollHeight - tolerance)
    && notifList != null){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            const response = JSON.parse(this.responseText);
            if(response.status){
                response.notifications.forEach(element => {
                    console.log(element);
                    const notifElement = document.createElement('li');
                    notifElement.classList.add("list-group-item"); 
                    let content = '<div class="row">'
                    + '<div class="col-4">'
                    + '<a href="profile.php?idutente=' + element.idUtenteNotificante + '">'
                    + '<img class="img-fluid avatar" src="' + element.fotoProfilo + '" alt="' + element.username + '"/>'
                    + '</a>'
                    + '</div>'
                    + '<div class="my-auto col-8">'
                    +' <p> <a href="';
                    if(element.isPostNotification){
                        content += 'post.php?postid=' + element.idPostRiferimento;
                    } else {
                        content += 'profile.php?idutente=' + element.idUtenteNotificante;                        
                    }
                    content += '"> ' + element.username + element.text
                            + "</a></p>"
                            + '<p class="text-end small">' + element.notifTimestamp + "</p>"
                            + "</div></div>";
                    notifElement.innerHTML = content;
                    notifList.appendChild(notifElement);
                });
            }
        };
        xhttp.open('POST', 'api_notifications.php');
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send('start=' + currentEnd + '&end=' + chatOffset);
        currentEnd += chatOffset;
    }
}