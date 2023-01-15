delegate_event('click', document, 'button.removePostButton', removePost);
delegate_event('click', document, 'button.confirmButton', check);


function showBoxAndDeactivateScroll() {
    document.body.style.pointerEvents = "none";
    document.body.style.overflow = "hidden";
    document.querySelector("div.center-container").setAttribute('style', 'display:block;');
    document.querySelector("div.center-container").style.pointerEvents = "auto";
    document.querySelector("div.center-container").style.top = window.scrollY + "px";

}

function hideBoxAndReactivateScroll() {
    document.body.style.pointerEvents = "auto";//attiva eventi
    document.body.style.overflow = "";//rimostra scrollbar
    document.querySelector("div.center-container").setAttribute('style', 'display:none;');//nascondi box
    document.querySelector("div.center-container").style.pointerEvents = "none";//disattiva eventi per sicurezza
}


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
    hideBoxAndReactivateScroll();
}

function removePost(event) {
    event.preventDefault();
    const source = event.target || event.srcElement;
    const removeButton = source.nodeName.toLowerCase() == 'button' ? source : source.parentNode;
    postId = removeButton.value;
    articleContainer = removeButton.closest("div.row > article");//arriva all'articolo
    showBoxAndDeactivateScroll();
}
