<?php 
/*
Function that print a post card. 

Parameters used from postParams:
-"fotoProfilo"      contains the path to the post author profile picture
-"fotoProfiloAlt"   contains the alt for post author profile picture
-"username"         contains the post author username
-"idUser"           contains the post author id
-"isLoggedUserPost" true if it is the logged user post
-"followedByMe"     contains true if the current user is following the post author user
-"testo"            contains post text
-"dataPost"         contains post publication date
-"isFull"           true if it is not required post expansion
-"liked"            true if the user already likes the post
-"numLike"          post number of likes
-"idPost"           post id
-"media"            array containing all post images and videos
-"mediaPath"        path to the post media folder
*/
function writePost($postParams){
    ?>
    <article class="bg-white border border-primary col-10 col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <div class="row mt-2">
                    <div class="col-4"><a href="../src/profile.php?idUtente=<?php echo $postParams["idUser"]?>"> <img class="img-fluid avatar" src="<?php echo $postParams["fotoProfilo"]; ?>"
                            alt="<?php echo $postParams["fotoProfiloAlt"];?>" /></a>
                    </div>
                    <div class="col-4">
                        <h2 style="font-size: 2vw">
                            <?php echo $postParams["username"] ?>
                        </h2>
                    </div>
                    <div class="col-4"> 
                        <?php if(!$postParams["isLoggedUserPost"]): ?>
                        <button type="button" id="follower<?php echo $postParams["idUser"] ?>" class="btn btn-primary" style="box-shadow: none;">
                            <?php echo $postParams["followedByMe"]  ? "seguito" :  "segui" ?>
                        </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <p class="card-text">
                    <?php echo $postParams["testo"] ?>
                </p>
                <p class="card-text"><small class="text-muted">
                        <?php echo $postParams["dataPost"] ?>
                    </small></p>

                
                <?php $active = true; ?>

                <?php if (count($postParams["media"]) > 1): ?>

                <div id="carousel" class="carousel slide" data-bs-interval="false">
                    <div class="carousel-inner">

                    <?php
                    foreach ($postParams["media"] as $immagine):
                        $classes='carousel-item';
                        if ($active) {
                            $classes .= ' active';
                            $active = false;
                        }
                    ?>
                        <div class='<?php echo $classes?>'>
                        <img class="card-img-bottom my-2 mx-auto" src="<?php echo $postParams["mediaPath"].$immagine["nomeImmagine"] ?>"
                            alt="<?php echo $immagine["descrizione"] ?>" />
                    </div>
                    <?php endforeach; ?>
                </div>
                <a class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark"></span>
                </a>
                <a class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark"></span>
                </a>
            </div>
            <?php elseif(count($postParams["media"]) == 1): ?>
            <img class="card-img-bottom my-2 mx-auto" src="<?php echo $postParams["mediaPath"].$postParams["media"][0]["nomeImmagine"] ?>"
                alt="<?php echo $postParams["media"][0]["descrizione"] ?>" />
            <?php endif; 
            if(!$postParams["isFull"]):
            ?>
            
            <a href="#" value="<?php echo $postParams["idPost"] ?>" class="btn btn-primary ms-auto"
                style="display:block ; width: fit-content;">Espandi</a>
            <?php endif; ?>
        </div>
        <div class="card-footer">
            <ul class="nav nav-pills">
                <li class="nav-item mx-2">
                    <button type="button" id="like<?php echo $postParams["idPost"] ?>" class="btn btn-light">
                        <img src="<?php echo $postParams["liked"] ? "../imgs/icons/heart-fill.svg" : "../imgs/icons/heart.svg" ?>"
                            alt="<?php echo $postParams["liked"] ? "Dislike post" : "Like post" ?>" />
                    </button>
                    <span>
                    <?php if ($postParams['numLike'] > 0) {
                        echo $postParams['numLike'];
                    } ?>
                    </span>
                </li>
                <li class="nav-item mx-2"> <button type="button" id="chat<?php echo $postParams["idPost"] ?>"
                        class="btn btn-light">
                        <img src="../imgs/icons/chat.svg" alt="Commenta post" /></button></li>
                <li class="nav-item mx-2"> <button type="button" id="save<?php echo $postParams["idPost"] ?>"
                        class="btn btn-light">
                        <img src="../imgs/icons/star.svg" alt="Salva post" /></button></li>
            </ul>
        </div>
</div>
</article>
<?php
}
?>