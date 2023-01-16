delegate_event('click', document, 'button[id^=follower]', follow);
function follow(event) {
    event.preventDefault();
    const source = event.target || event.srcElement;
    const followButton = source.nodeName.toLowerCase() == 'button' ? source : source.parentNode;
    const userId = followButton.id.substring(8);
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        const response = JSON.parse(this.responseText);
        const contentPlace = document.querySelectorAll("button[id=follower" + userId + "]");//tutti i button che hanno lo stesso id
        if (response.follower) {//quelli che seguo io
            contentPlace.forEach(element => {//aggiorna la scritta a tutti i post dello stesso utente
                element.innerText = element.innerText === "Follow" ? "Followed" : "Seguito";
            });
            if (document.querySelector(".card-body ul li:last-child a") != null && document.querySelector(".card-body ul li:last-child a").nextSibling != null) {//se lo seguo dal profilo aggiorno i numeri
                let updatePlace = document.querySelector(".card-body ul li:last-child a").nextSibling;
                let value = parseInt(updatePlace.nodeValue) + 1;
                updatePlace.nodeValue = value;

            }
        } else {
            contentPlace.forEach(element => {
                element.innerText = element.innerText === "Followed" ? "Follow" : "Segui";
            });
            if (document.querySelector(".card-body ul li:last-child a") != null && document.querySelector(".card-body ul li:last-child a").nextSibling != null) {
                let updatePlace = document.querySelector(".card-body ul li:last-child a").nextSibling;
                let value = parseInt(updatePlace.nodeValue) - 1;
                updatePlace.nodeValue = value;
            }
        }

    };
    xhttp.open("POST", "follow_event.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("userId=" + userId);
}
