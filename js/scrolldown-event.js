
function generaArticoli(articoli) {
    let active = true;
    let articolo = `
        <article class="bg-white border border-primary py-3"> 
        <div class="card col-10 col-md-8 mx-auto">
        <div class="card-header">
            <div class="row mt-2">
                <div class="col-4"> <img class="img-fluid avatar" src="${articoli["post"]["fotoProfilo"]}"
                        alt="foto profilo di ${articoli["post"]["username"]}?>"/>
                </div>
                <div class="col-4">
                    <h2 style="font-size: 2vw">
                      ${articoli["post"]["username"]}
                    </h2>
                </div>
                <div class="col-4"> <button value="${articoli["post"]["idUtente"]}" type="button"
                        class="btn btn-light btn-md border border-dark" style="box-shadow: none;">Segui</button>
                </div>
            </div>
        </div>
        <div class="card-body">
        <p class="card-text">
              ${articoli["post"]["testo"]}
        </p>
        <p class="card-text"><small class="text-muted">
                ${articoli["post"]["dataPost"]}
            </small></p> `;

    let concat = "";
    if (articoli["content"].length > 1) {
        concat +=
            `<div id="carousel" class="carousel slide" data-bs-interval="false">
                <div class="carousel-inner">`;
        for (let index = 0; index < articoli["content"].length; index++) {
            if (active) {
                concat += `<div class='carousel-item active'>`;
                active = false;
            } else {
                concat += `<div class='carousel-item'>`;
            }
            concat +=
                `<img class="card-img-bottom my-2 mx-auto" src="${articoli["content"][index]["percorso"]}"
                    alt="${articoli["content"][index]["descrizione"]}" />
                    </div>`;
        }
        concat += `</div>
                <a class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark"></span>
                </a>
                <a class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark"></span>
                </a>
                </div>`;
    } else {
        concat +=
            `<img class="card-img-bottom my-2 mx-auto" src="${articoli["content"][0]["percorso"]}"
                alt="${articoli["content"][0]["descrizione"]}" />`;
    }
    concat += `<a href="#" value="${articoli["post"]["idPost"]}" class="btn btn-primary ms-auto"
            style="display:block ; width: fit-content;">Espandi</a>
            </div>
            <div class="card-footer">
                <ul class="nav nav-pills">
                    <li class="nav-item mx-2">
                        <button type="button" id="like${articoli["post"]["idPost"]}" class="btn btn-light">
                        <img src="`;
    let liked = `${articoli["liked"]}`;
    if (liked == true) {
        concat += `../imgs/icons/heart-fill.svg"`;
    } else {
        concat += `../imgs/icons/heart.svg"`;
    }
    concat += `alt="Like post" />
                        </button>
                        <span>`;
    if (`${articoli["post"]["numLike"]}` > 0) {
        concat += `${articoli["post"]["numLike"]}`;
    }
    concat += `
                        </span>
                    </li>
                    <li class="nav-item mx-2"> <button type="button" id="chat${articoli["post"]["idPost"]}"
                            class="btn btn-light"><img src="../imgs/icons/chat.svg" alt="Commenta post"/></button></li>
                    <li class="nav-item mx-2"> <button type="button" id="save${articoli["post"]["idPost"]}"
                            class="btn btn-light"><img src="../imgs/icons/star.svg" alt="Salva post"/></button></li>
                </ul>
            </div>
        </div>
        </article>`;

    articolo += concat;

    return articolo;
}


function delegate_event(eventType, ancestorElem, childSelector, eventHandler) {
    if (!ancestorElem || (typeof ancestorElem === 'string' && !(ancestorElem = document.querySelector(ancestorElem)))) {
        return
    }

    ancestorElem.addEventListener(eventType, e => {
        if (e.target && e.target.closest && e.target.closest(childSelector)) {
            (eventHandler)(e)
        }
    })

}

delegate_event('click', document, 'button[id^=like]', like);//assegna alla pagina di aggiungere ai button l'evento click, anche quando vengono inseriti dopo dinamicamente


/* $(document).ready(function(){ //stessa cosa ma in jquery
     $(".card-footer ul").on( "click", "button[id^=like]", like)
 });*/



$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
        let xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            console.log(this.responseText);
            const response = JSON.parse(this.responseText);

            if (response.status) {
                let newArticle = generaArticoli(response);
                let lastarticle = document.querySelector("article:last-of-type");
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
        xhttp.send("stringList=" + idString + "&isTag=" + isTag + "&tagName="+ tagName);
    }
});
