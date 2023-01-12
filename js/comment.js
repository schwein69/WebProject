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
                                '<img class="img-fluid rounded" src="' + user.fotoProfilo + '" alt="foto profilo di '
                                + user.username + '" style="width: auto; max-width: 25%;"/>'
                                +    '<h3>' + user.username + '</h3>'
                                +    '<p>' + commentBox.value + '</p>'
                                +    '<p>' + timeString + '</p>'
            commentBox.value = "";
            const commentInputDiv = document.querySelector('#comments div.row:last-child');
            commentInputDiv.parentNode.insertBefore(newComment, commentInputDiv);
    
        }
    };

    xhttp.open("POST", "event_comment.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("postid="+postId+"&testo="+commentBox.value);
}