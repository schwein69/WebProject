delegate_event('click', document, 'button[id^=follower]', follow);
function follow(event) {
    event.preventDefault();
    const source = event.target || event.srcElement;
    const followButton = source.nodeName.toLowerCase() == 'button' ? source : source.parentNode;
    const userId = followButton.id.substring(8);
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        const response = JSON.parse(this.responseText);
        const contentPlace = document.querySelectorAll("button[id=follower" + userId + "]");//tutti i button
        if (response.follower) {//quelli che seguo io
            contentPlace.forEach(element => {
                element.innerText = "seguito";
            });
            if (document.querySelector(".card-body ul li:last-child a").nextSibling != null) {
                let updatePlace = document.querySelector(".card-body ul li:last-child a").nextSibling;
                let value = parseInt(updatePlace.nodeValue) + 1;
                updatePlace.nodeValue = value;

            }
        } else {
            contentPlace.forEach(element => {
                element.innerText = "segui";
            });
            if (document.querySelector(".card-body ul li:last-child a").nextSibling != null) {
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
