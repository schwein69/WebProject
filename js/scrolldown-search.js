document.addEventListener('scroll', event => {
    if(isTag!=2){
        const tolerance = 20; 
        if ((document.body.offsetHeight + window.scrollY) >= (document.body.scrollHeight-tolerance)) {
            let xhttp = new XMLHttpRequest();
            xhttp.onload = function () {
                const response = JSON.parse(this.responseText);
                if (response.status) {
                    let newArticle = generaArticoli(response);
                    let lastarticle = document.querySelector("main > div.row:last-of-type");
                    lastarticle.insertAdjacentHTML("afterend", newArticle);
                    oldId.push(response["post"]["idPost"]);
                }
            };
            let idString = "";
            oldId.forEach(element => {
                idString += element + ",";
            });
            idString = idString.substring(0, idString.length - 1);
            xhttp.open("POST", "showmorerandomposts.php");

            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("stringList=" + idString + "&isTag=" + isTag + "&tagName="+ tagName +"&start="+oldId.length + "&end="+ oldId.length+1);
        }
    }
});
