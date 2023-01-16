delegate_event('click', document, 'button.removePostButton', removePost);
delegate_event('click', document, 'button.confirmButton', check);

let selectedValue = null;
let articleContainer = null;
let postId = null;
function check(event) {
    event.preventDefault();
    const source = event.target || event.srcElement;
    const selectButton = source.nodeName.toLowerCase() == 'button' ? source : source.parentNode;
    const selected = selectButton.value;
    selectedValue = selected;
    if (selectedValue === "yes") {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            articleContainer.parentNode.remove();//rimuovo il padre dell'articolo, cioè div class=row
            if (document.querySelector(".card-body ul li:nth-child(2) div") != null && document.querySelector(".card-body ul li:nth-child(2) div").nextSibling != null) {
                const updatePlace = document.querySelector(".card-body ul li:nth-child(2) div").nextSibling;
                const value = parseInt(updatePlace.nodeValue) - 1;
                updatePlace.nodeValue = value;
            }
        };
        xhttp.open("POST", "event_removepost.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("postid=" + postId);
    }
    hideBoxAndReactivateScroll("center-container");
}

function removePost(event) {
    event.preventDefault();
    const source = event.target || event.srcElement;
    const removeButton = source.nodeName.toLowerCase() == 'button' ? source : source.parentNode;
    postId = removeButton.value;
    articleContainer = removeButton.closest("div.row > article");//arriva all'articolo
    showBoxAndDeactivateScroll("center-container");
}
