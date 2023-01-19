delegate_event('click', document, 'button.sharePostButton', sharePost);
delegate_event('click', document, 'button.confirmShareButton', check);


let selectedFriends = null;
let postIdToShare = null;

function getCheckboxesValues() {//get array of user id to share
    return [].slice.apply(document.querySelectorAll("div.center-container2 input[type=checkbox]"))
        .filter(function (c) { return c.checked; })
        .map(function (c) { return c.value; });
}

function check(event) {
    event.preventDefault();
    const source = event.target || event.srcElement;
    const selectButton = source.nodeName.toLowerCase() == 'button' ? source : source.parentNode;
    const selected = selectButton.value;//si o no
    if (selected === "yes" && getCheckboxesValues().length > 0) {//se seleziono si e la lista non è nullo allora condivido
        selectedFriends = getCheckboxesValues();
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            selectedFriends = null; //pulisco la lista
        };
        xhttp.open("POST", "event_sharepost.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(selectedFriends);
    } else if (selected === "yes" && getCheckboxesValues().length <= 0) {
        document.querySelector(".feedback-area").innerHTML = document.documentElement.lang == "en" ? "You must select at least one friend!" : "Devi scegliere almeno un amico!";
        return;
    }
    document.querySelector(".feedback-area").innerHTML = "";
    hideBoxAndReactivateScroll("center-container2");
}

function sharePost(event) {
    event.preventDefault();
    const source = event.target || event.srcElement;
    const sharePostButton = source.nodeName.toLowerCase() == 'button' ? source : source.parentNode;
    postIdToShare = sharePostButton.value;//id del post

    showBoxAndDeactivateScroll("center-container2");
}
