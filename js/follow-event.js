delegate_event('click', document, "button[class*=followButton]", follow);
function follow(event) {
    event.preventDefault();
    const source = event.target || event.srcElement;
    const followButton = source.nodeName.toLowerCase() == 'button' ? source : source.parentNode;
    const userId = followButton.value;
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        const response = JSON.parse(this.responseText);
        const contentPlace = document.querySelectorAll("button[class*=followButton" + userId + "]");//tutti i button che hanno la stessa classe
        if (response.follower) {//quelli che seguo io
            contentPlace.forEach(element => {//aggiorna la scritta a tutti i post dello stesso utente
                element.innerText = element.innerText === "Follow" ? "Followed" : "Seguito";
            });
            if (document.querySelector(".card-body ul li:nth-child(4) a") != null && document.querySelector(".card-body ul li:nth-child(4) a").nextSibling != null) {//se lo seguo dal profilo aggiorno i numeri
                let updatePlace = document.querySelector(".card-body ul li:nth-child(4) a").nextSibling;
                let value = parseInt(updatePlace.nodeValue) + 1;
                updatePlace.nodeValue = value;

            }
        } else {
            contentPlace.forEach(element => {
                element.innerText = element.innerText === "Followed" ? "Follow" : "Segui";
            });
            if (document.querySelector(".card-body ul li:nth-child(4) a") != null && document.querySelector(".card-body ul li:nth-child(4) a").nextSibling != null) {
                let updatePlace = document.querySelector(".card-body ul li:nth-child(4) a").nextSibling;
                let value = parseInt(updatePlace.nodeValue) - 1;
                updatePlace.nodeValue = value;
            }
        }

    };
    xhttp.open("POST", "follow_event.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("userId=" + userId);
}
