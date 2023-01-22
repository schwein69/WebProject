const commentBox = document.getElementById("userComment");
function comment(event){
    event.preventDefault();
    
    const source = event.target || event.srcElement;
    const commentButton = source.nodeName.toLowerCase() == 'button' ? source : source.parentNode;
    const postId = commentButton.id.substring(11);
    
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function(){
        const timeStamp = new Date(Date.now());
        const timeString = timeStamp.getDate() + "-"
        + timeStamp.getMonth() + "-"
        + timeStamp.getFullYear() + " ";
        const response = JSON.parse(this.responseText);
        if(response.status){
            const newComment = document.createElement('div');
            newComment.classList.add('row');
            newComment.innerHTML =
                                '<div class="col-4 my-auto">'
                                + '<img class="img-fluid avatar" src="' + user.fotoProfilo + '" alt="foto profilo di '
                                + user.username + '"/>'
                                + '</div>'
                                + '<div class="row col-8 m-0 text-start">'
                                + '<h3>' + user.username + '</h3>'
                                + '<p>' + response.text + '</p>'
                                + '<p class="text-end small">' + timeString + '</p>'
                                + '</div>';
            commentBox.value = "";
            const commentInputDiv = document.querySelector('#comments > div.row:last-child');
            commentInputDiv.parentNode.insertBefore(newComment, commentInputDiv);
    
        }
    };

    xhttp.open("POST", "event_comment.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("postid="+postId+"&testo="+commentBox.value);
}