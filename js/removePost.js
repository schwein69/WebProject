delegate_event('click', document, 'button.removePostButton', removePost);

function removePost(event) {
    event.preventDefault();
    const source = event.target || event.srcElement;
    const removeButton = source.nodeName.toLowerCase() == 'button' ? source : source.parentNode;
    const postId = removeButton.value;
    const articleCont = removeButton.closest("div.row > article");//arriva all'articolo
    const msg = confirm("Conferma l'eliminazione?");//TODO traduzione, confirm box??? ask Cara
    if (msg) {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            articleCont.parentNode.remove();//rimuovo il padre dell'articolo, cioè div class=row
            const updatePlace = document.querySelector(".card-body ul li:nth-child(2) div").nextSibling
            const value = parseInt(updatePlace.nodeValue) - 1;
            updatePlace.nodeValue = value;

        };
        xhttp.open("POST", "event_removepost.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("postid=" + postId);
    }

}
