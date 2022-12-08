function randomPosts(posts){
    let result = "";

    for(let i=0; i < posts.length; i++){
        let postimages;
        
        let post = `
        <div class="row">
        <div class="col-md-2"></div>
        <div class="col-12 col-md-8">
            <article class="bg-white border border-primary py-3">
                <div class="card col-10 col-md-8 mx-auto">
                    <div class="card-header">
                        <div class="row mt-2">
                            <div class="col-4"> <img class="img-fluid rounded" src="${post[i]["fotoProfilo"]}" alt="foto profilo di ${post[i]["username"]}"
                                    style="width: auto; max-width: 25%;" /></div>
                            <div class="col-4">
                                <h2 style="font-size: 2vw">${post[i]["username"]}</h2>
                            </div>
                            <div class="col-4"> <button value="${post[i]["idUtente"]}" type="button" class="btn btn-light btn-md border border-dark"
                                    style="box-shadow: none;">Segui</button></div>                                                                                
                        </div>
                    </div>
    
                    <div class="card-body">
                        <p class="card-text">${post[i]["testo"]}</p>`
                        `


                        <p class="card-text"><small class="text-muted">${post[i]["dataPost"]}</small></p>
                        <img class="card-img-bottom my-3 mx-auto" src="${post[i]["percorso"]}" alt=""
                            style="width: 50%; display: block;" /> `



                            `  
                        <a href="#" class="btn btn-primary ms-auto" style="display:block ; width: fit-content;">Espandi</a>
                    </div>
                    <div class="card-footer">
                        <ul class="nav nav-pills">
                            <li class="nav-item mx-2"> <button type="button" class="btn btn-light"><span
                                        class="bi bi-heart"></span></button></li>
                            <li class="nav-item mx-2"> <button type="button" class="btn btn-light"><span
                                        class="bi bi-chat"></span></button></li>
                            <li class="nav-item mx-2"> <button type="button" class="btn btn-light"><span
                                        class="bi bi-star"></span></button></li>
                        </ul>
                    </div>
                </div>
            </article>
        </div>
        <div class="col-md-2"></div>
    </div> `;

    result += post;
    }
    return result;
}

axios.get('search-template.php').then(response => {
    let posts = randomPosts(response.data);
    const main = document.querySelector("main");
    main.innerHTML = posts;
});
