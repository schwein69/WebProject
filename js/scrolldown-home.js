

document.addEventListener('scroll', event => {
    if ((document.body.offsetHeight + window.scrollY) == document.body.scrollHeight) {
        let xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            const response = JSON.parse(this.responseText);

            if (response.status) {
                let newArticle = generaArticoli(response);
                let lastarticle = document.querySelector("article:last-of-type");
                lastarticle.insertAdjacentHTML("afterend", newArticle);
                oldId.push(response["post"]["idPost"]);
            }
        };
        xhttp.open("POST", "showmorepostsinhome.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("&start=" + oldId.length + "&end=" + oldId.length + 1);
    }
});
