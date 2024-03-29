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
function showBoxAndDeactivateScroll(container) {
    document.body.style.pointerEvents = "none";
    document.body.style.overflow = "hidden";
    //document.querySelector("div." + container).setAttribute('style', 'display:block;');
    document.querySelector("div." + container).classList.add("d-flex");
    document.querySelector("div." + container).classList.add("justify-content-center");
    document.querySelector("div." + container).style.pointerEvents = "auto";
    document.querySelector("div." + container).style.top = window.scrollY + "px";
    document.querySelector("div." + container).style.left = window.screenX + "px";//center in base al body e non al parent secondario(settingstemplate.php)

}

function hideBoxAndReactivateScroll(container) {
    document.body.style.pointerEvents = "auto";//attiva eventi
    document.body.style.overflow = "";//rimostra scrollbar
    //document.querySelector("div." + container).setAttribute('style', 'display:none;');//nascondi box
    document.querySelector("div." + container).classList.remove("d-flex");
    document.querySelector("div." + container).classList.remove("justify-content-center");
    document.querySelector("div." + container).style.pointerEvents = "none";//disattiva eventi per sicurezza
}
function generaArticoli(articoli) {
    let articolo = `
        <div class="row">
        <article class="card p-0 col-12 col-md-8 mx-auto"> 
        <div class="card-header">
            <div class="row mt-2">
                <div class="col-4"> 
                <a href="../src/profile.php?idUtente=${articoli["post"]["idUser"]}">
                <img class="img-fluid avatar" src="../imgs/uploads/${articoli["post"]["idUser"]}/profile.${articoli["post"]["formatoFotoProfilo"]}" alt="${articoli["imagealt"]}"/>
                </a>
                </div>
                <div class="col-4">
                <h2 style="font-size: x-large;">
                    ${articoli["post"]["username"]}
                </h2>
                </div>
                <div class="col-4">`
    if (!articoli["isLoggedUserPost"]) {
        articolo += `<button type="button" value="${articoli["post"]["idUser"]}" class="btn followButton${articoli["post"]["idUser"]}"> ${articoli["followbtntext"]}</button>`;
    } else {
        articolo += `<a href="edit_post.php?postid=${articoli["post"]["idPost"]}" class="btn">${articoli["postEditText"]}</a>`;
        articolo += `<button type="button" value="${articoli["post"]["idUser"]}" class="btn removePostButton"><img src="../imgs/icons/trash3.svg" alt="${articoli["removeText"]}"/></button>`;
    }
    articolo += `</div>
                     </div>
                     </div>
                <div class="card-body">
                <p class="card-text">${articoli["post"]["testo"]} </p>
                <p class="card-text">${articoli["post"]["dataPost"]}</p>`;
    let active = true;
    let concat = "";
    if (articoli["post"]["media"].length > 1) {
        concat +=
            `<div id="carousel${articoli["post"]["idPost"]}" class="carousel slide" data-bs-interval="false">
        <div class="carousel-inner">`;

        for (let index = 0; index < articoli["post"]["media"].length; index++) {
            if (active) {
                concat += `<div class='carousel-item active'>`;
                active = false;
            } else {
                concat += `<div class='carousel-item'>`;
            }
            if (articoli["post"]["media"][index]["isImage"]) {
                concat +=
                    `<img class="card-img-bottom my-2 mx-auto" src="${articoli["post"]["mediaPath"] + articoli["post"]["media"][index]["nomeImmagine"]}"
                alt="${articoli["post"]["media"][index]["descrizione"]}" />`
            } else {
                concat += `<video class="card-img-bottom my-2 mx-auto" controls loop>
                <source src="${articoli["post"]["mediaPath"] + articoli["post"]["media"][index]["nomeImmagine"]}" type="video/${articoli["post"]["media"][index]["formato"]}"/>
                ${articoli["post"]["media"][index]["descrizione"] != "" ? articoli["post"]["media"][index]["descrizione"] : 'Video not supported'}
            </video>`;
            }
            concat += `</div>`;
        }
        concat += `</div>
                <a class="carousel-control-prev" type="button" data-bs-target="#carousel${articoli["post"]["idPost"]}" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark"></span>
                </a>
                <a class="carousel-control-next" type="button" data-bs-target="#carousel${articoli["post"]["idPost"]}" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark"></span>
                </a></div>`;
    } else if (articoli["post"]["media"].length == 1) {
        if (articoli["post"]["media"][0]["isImage"]) {
            concat +=
                `<img class="card-img-bottom my-2 mx-auto" src="${articoli["post"]["mediaPath"] + articoli["post"]["media"][0]["nomeImmagine"]}"
            alt="${articoli["post"]["media"][0]["descrizione"]}" />`
        } else {
            concat += `<video class="card-img-bottom my-2 mx-auto" controls loop>
            <source src="${articoli["post"]["mediaPath"] + articoli["post"]["media"][0]["nomeImmagine"]}" type="video/${articoli["post"]["media"][0]["formato"]}"/>
            ${articoli["post"]["media"][0]["descrizione"] != "" ? articoli["post"]["media"][0]["descrizione"] : 'Video not supported'}
           </video>`;
        }

    }
    concat += `<a href = "post.php?postid=${articoli["post"]["idPost"]}" value = "${articoli["post"]["idPost"]}" class="btn ms-auto"
               style = "display:block ; width: fit-content;">${articoli["readMore"]}</a>
               </div>`;

    if (articoli["post"]["tags"] != null && articoli["post"]["tags"].length > 0) {
        concat += `<section>
                <h2 class="text-start">Tags</h2>
                <ul class="list-group list-group-horizontal">`;
        articoli["post"]["tags"].forEach(element => {
            concat += ` <li class="list-group-item badge rounded-pill mx-1 bg-primary text-light">` + element["nomeTag"] + `</li>`;
        });
        concat += `</ul>
           </section>`
    }

    concat += `<div class="card-footer">
                <ul class="nav nav-pills">
                    <li class="nav-item mx-2">
                        <button type="button" value="${articoli["post"]["idPost"]}" class="btn likeButton">
                        <img src="${articoli["liked"] ? "../imgs/icons/heart-fill.svg" : "../imgs/icons/heart.svg"}"`;

    concat += `alt="${articoli["liked"] ? "Dislike post" : "Like post"}" />
                        </button>
                        <span>`;
    if (articoli["post"]["numLike"] > 0) {
        concat += `${articoli["post"]["numLike"]}`;
    }
    concat += `
                        </span>
                    </li>
                    <li class="nav-item mx-2"> <button type="button" value="${articoli["post"]["idPost"]}"
                            class="btn commentBtn"><img src="../imgs/icons/chat.svg" alt="${articoli["comment"]}"/></button>
                            <span>${articoli["post"]["numCommenti"] > 0 ? articoli["post"]["numCommenti"] : ""}</span></li>
                    <li class="nav-item mx-2"> <button type="button" value="${articoli["post"]["idPost"]}"
                            class="btn saveButton"><img src="${articoli["saved"] ? "../imgs/icons/star-fill.svg" : "../imgs/icons/star.svg"}" alt="${articoli["savedText"]}"/></button><span></span></li >
                    <li class="nav-item mx-2"> <button type="button" value="${articoli["post"]["idPost"]}"
                    class="btn sharePostButton"><img src="../imgs/icons/share.svg" alt="${articoli["shareText"]}"/></button><span></span></li >
                </ul>
            </div>
        </article></div>`;

    articolo += concat;
    return articolo;
}

function areThereDangerousChars(text) {
    const regExp = />|<|;|,|:|\\|\//;
    return regExp.test(text);
}