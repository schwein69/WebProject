function follow(event) {
    event.preventDefault();
    const source = event.target || event.srcElement;
    const followButton = source.nodeName.toLowerCase() == 'button' ? source : source.parentNode;
    const userId = followButton.id.substring(6);
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        const response = JSON.parse(this.responseText);
        const contentPlace = followButton.nextSibling;
        if (response.followByMe) {//quelli che seguo io
            contentPlace.innerText = "Seguito";
        } else {      
            contentPlace.innerText = "Segui";
        }      
    };
    xhttp.open("POST", "follow_event.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("userId=" + userId);
}
