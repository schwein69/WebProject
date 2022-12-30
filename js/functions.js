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
function generaArticoli(articoli) {
    let active = true;
    let articolo = `
        <article class="py-3"> 
        <div class="card col-12 col-md-8 mx-auto">
        <div class="card-header">
            <div class="row mt-2">
                <div class="col-4"> <img class="img-fluid avatar" src="${articoli["post"]["idUtente"]}./profile.${articoli["post"]["formatoFotoProfilo"]}"
                        alt="foto profilo di ${articoli["post"]["username"]}?>"/>
                </div>
                <div class="col-4">
                    <h2 style="font-size: 2vw">
                      ${articoli["post"]["username"]}
                    </h2>
                </div>
                <div class="col-4">  
                <button type="button" id="follower${articoli["post"]["idUtente"]}" class="btn btn-primary" style="box-shadow: none;">`;

    if (`${articoli["followedByMe"]}` == "true") {
        articolo += `seguito`;

    } else {
        articolo += `segui`;
    }
        let convertedText = document.createTextNode(articoli["post"]["testo"]);
        articolo += `</button>
                </div>
                </div>
                </div>
                <div class="card-body">
                <p class="card-text">`+convertedText+` </p>
                <p class="card-text"><small class="text-muted">${articoli["post"]["dataPost"]}</small></p> `;

    let concat = "";
    if (articoli["content"].length > 1) {
        concat +=
            `< div id = "carousel" class="carousel slide" data - bs - interval="false" >
        <div class="carousel-inner">`;
        for (let index = 0; index < articoli["content"].length; index++) {
            if (active) {
                concat += `<div class='carousel-item active'>`;
                active = false;
            } else {
                concat += `<div class='carousel-item'>`;
            }
            concat +=
                `<img class="card-img-bottom my-2 mx-auto" src="${articoli["content"][index]["nomeImmagine"]}"
            alt="${articoli["content"][index]["descrizione"]}" />
        </div>`;
        }
        concat += `</div >
                <a class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark"></span>
                </a>
                <a class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark"></span>
                </a>
                </div > `;
    } else if(articoli["content"].length == 1){
        concat +=
            `<img class="card-img-bottom my-2 mx-auto" src = "${articoli["content"][0]["nomeImmagine"]}"
    alt = "${articoli["content"][0]["descrizione"]}" /> `;
    }
    concat += `<a href = "post.php?postid=${articoli["post"]["idPost"]}" value = "${articoli["post"]["idPost"]}" class="btn btn-primary ms-auto"
    style = "display:block ; width: fit-content;" > Espandi</a >
            </div >
            <div class="card-footer">
                <ul class="nav nav-pills">
                    <li class="nav-item mx-2">
                        <button type="button" id="like${articoli["post"]["idPost"]}" class="btn btn-light">
                        <img src="`;
    let liked = `${articoli["liked"]}`;
    if (liked) {
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
                            class="btn btn-light"><img src="../imgs/icons/star.svg" alt="Salva post"/></button></li >
                </ul >
            </div >
        </div >
        </article > `;

    articolo += concat;

    return articolo;
}