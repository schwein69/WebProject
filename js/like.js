delegate_event('click', document, 'button[id^=like]', like);
const commentBtn = document.getElementsByClassName("commentBtn");
if (commentBtn != null) {
    for (let index = 0; index < commentBtn.length; index++) {
        const id = commentBtn[index].id;
        const postId = id.substring(7);
        const redirectUrl = '../src/post.php?postid=' + postId + '#comment';
      // console.log(postId);
        commentBtn[index].addEventListener('click', event => window.location.href=redirectUrl);
    }
}

function like(event) {
    event.preventDefault();
    const source = event.target || event.srcElement;
    const likeButton = source.nodeName.toLowerCase() == 'button' ? source : source.parentNode;
    const postId = likeButton.id.substring(4);
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        console.log(this.responseText);
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
