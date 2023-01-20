//endless scroll
//TODO get language paragraph for user action (like, comment, follow) from server
const chatOffset= 5;
const tolerance = 10;
let currentEnd = chatOffset;
const notifList = document.querySelector('main ul');
document.addEventListener('scroll', event => {
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
                    + '<div class="col-3">'
                    + '<a href="profile.php?idutente=' + element.idUtenteNotificante + '">'
                    + '<img class="chatAvatar" src="' + element.fotoProfilo + '" alt="' + element.username + '"/>'
                    + '</a>'
                    + '</div>'
                    + '<div class="my-auto col-9">'
                    +' <p> <a href="';
                    if(element.isPostNotification){
                        content += 'post.php?postid=' + element.idPostRiferimento;
                    } else {
                        content += 'profile.php?idutente=' + element.idUtenteNotificante;                        
                    }
                    content += '"> ' + element.username + "ha fatto " + element.nomeTipo
                            + "</a></p>"
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
});