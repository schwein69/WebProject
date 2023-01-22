delegate_event('click', document, 'button.saveButton', save);

function save(event) {
    event.preventDefault();
    const source = event.target || event.srcElement;
    const saveButton = source.nodeName.toLowerCase() == 'button' ? source : source.parentNode;
    const postId = saveButton.value;
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        const response = JSON.parse(this.responseText);
        let saveImg = '';
        if (response.saved) {
            saveImg = '../imgs/icons/star-fill.svg';
        } else {
            saveImg = '../imgs/icons/star.svg';
        }
        saveButton.children[0].src = saveImg;
    };
    xhttp.open("POST", "event_savepost.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("postid=" + postId);
}
