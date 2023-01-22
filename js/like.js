delegate_event('click', document, 'button.likeButton', like);
delegate_event('click', document, 'button.commentBtn', comment);

function comment(event) {
    event.preventDefault();
    const source = event.target || event.srcElement;
    const commentButton = source.nodeName.toLowerCase() == 'button' ? source : source.parentNode;
    const postId = commentButton.value;
    const redirectUrl = '../src/post.php?postid=' + postId + '#comment';
    window.location.href = redirectUrl;
}

function like(event) {
    event.preventDefault();
    const source = event.target || event.srcElement;
    const likeButton = source.nodeName.toLowerCase() == 'button' ? source : source.parentNode;
    const postId = likeButton.value;
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {

        const response = JSON.parse(this.responseText);

        const numLikePlace = likeButton.nextElementSibling;
        let likeImg = '';
        let numLike = '';
        if (response.liked) {
            likeImg = '../imgs/icons/heart-fill.svg';
            numLike = numLikePlace.innerText.length == 0 ? '1' : '' + (parseInt(numLikePlace.innerText) + 1);
        } else {
            likeImg = '../imgs/icons/heart.svg';
            numLike = parseInt(numLikePlace.innerText) == 1 ? '' : '' + (numLikePlace.innerText - 1);
        }
        likeButton.children[0].src = likeImg;
        numLikePlace.innerText = numLike;
    };
    xhttp.open("POST", "event_like.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("postid=" + postId);
}
