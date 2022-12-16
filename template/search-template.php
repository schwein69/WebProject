<div class="row" id="searchbar">
    <div class="col-md-2"></div>
    <div class="col-12 col-md-8 my-2">
        <form action="" method="GET">
            <input type="radio" id="user" name="searchOption" value="User" required>
            <label for="user">USER</label>
            <input type="radio" id="tag" name="searchOption" value="Tag">
            <label for="tag">TAG</label>
            <input class="col-6" type="text" name="searchValue" placeholder="Search" style="" required />
            <input class="col-2" type="submit"></input>
        </form>
    </div>
    <div class="col-md-2"></div>
</div>
<?php $oldPostId = array();?>
<?php if($templateParams["selector"] == true):?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-12 col-md-8">
        <?php foreach ($posts as $post): ?>
        <article class="bg-white border border-primary py-3">
            <div class="card col-10 col-md-8 mx-auto">
                <div class="card-header">
                    <div class="row mt-2">
                        <div class="col-4"><a href="../src/profile.php?idUtente=<?php echo $post["idUtente"]?>"><img class="img-fluid avatar" src="<?php echo $post["fotoProfilo"] ?>"
                                alt="foto profilo di <?php echo $post["username"] ?>"/></a></div>
                        <div class="col-4">
                            <h2 style="font-size: 2vw">
                                <?php echo $post["username"] ?>
                            </h2>
                        </div>
                        <div class="col-4"> <button id="follow<?php echo $post["idUtente"] ?>" type="button"
                                class="btn btn-light btn-md border border-dark" style="box-shadow: none;">Segui</button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <p class="card-text">
                        <?php echo $post["testo"] ?>
                    </p>
                    <p class="card-text"><small class="text-muted">
                            <?php echo $post["dataPost"] ?>
                        </small></p>

                    <?php $immaginiPost = $dbh->getPostContents($post["idPost"]) ?>
                    <?php $active = true; ?>

                    <?php if (count($immaginiPost) > 1): ?>

                    <div id="carousel" class="carousel slide" data-bs-interval="false">
                        <div class="carousel-inner">

                            <?php foreach ($immaginiPost as $immagine): ?>
                            <?php if ($active) {
                        echo "<div class='carousel-item active'>";
                        $active = false;
                    } else {
                        echo "<div class='carousel-item'>";
                    } ?>
                            <img class="card-img-bottom img-fluid my-2 mx-auto" src="<?php echo $immagine["percorso"] ?>"
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
                <?php else: ?>

                <img class="card-img-bottom img-fluid my-2 mx-auto" src="<?php echo $immaginiPost[0]["percorso"] ?>"
                    alt="<?php echo $immaginiPost[0]["descrizione"] ?>" />
                <?php endif; ?>


                <a href="#" value="<?php echo $post["idPost"] ?>" class="btn btn-primary ms-auto"
                    style="display:block ; width: fit-content;">Espandi</a>
            </div>
            <?php $post_data = $dbh->getPostData($post["idPost"]);
                  $post_data["liked"] = $dbh->isPostLiked($_SESSION["idUtente"],$post["idPost"]);         
            ?>
            <div class="card-footer">
                <ul class="nav nav-pills">
                    <li class="nav-item mx-2">
                        <button type="button" id="like<?php echo $post["idPost"] ?>" class="btn btn-light">
                            <img src="<?php echo $post_data["liked"] ? "../imgs/icons/heart-fill.svg" : "../imgs/icons/heart.svg" ?>"
                                alt="Like post" />
                        </button>
                        <span>
                            <?php if($post_data['numLike']>0){echo $post_data['numLike'];}?>
                        </span>
                    </li>
                    <li class="nav-item mx-2"> <button type="button" id="chat<?php echo $post["idPost"] ?>"
                            class="btn btn-light"><img src="../imgs/icons/chat.svg" alt="Commenta post"/></button></li>
                    <li class="nav-item mx-2"> <button type="button" id="save<?php echo $post["idPost"] ?>"
                            class="btn btn-light"><img src="../imgs/icons/star.svg" alt="Salva post"/></button></li>
                </ul>
            </div>
    </div>
    </article>
    <?php array_push($oldPostId,$post["idPost"]);?>
    <?php endforeach; ?>
</div>
<div class="col-md-2"></div>
</div>
<script>
const tagName = <?php if(isset($templateParams["tagName"])) { echo json_encode($templateParams['tagName']); } else echo json_encode("") ?>;
const isTag = <?php echo $templateParams["isTag"]?>;
const oldId = <?php echo json_encode($oldPostId)?>;
</script>
<?php else :?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-12 col-md-8">
        <?php $oldUserId = array();?>
        <?php foreach ($userData as $user): ?>
        <div class="card col-12 mx-auto">
            <div class="row g-0">
                <div class="col-4 my-auto">
                    <img src="<?php echo $user["fotoProfilo"] ?>" class="img-fluid rounded searchAvatar"
                        alt="foto profilo di <?php echo $user["username"] ?>">
                </div>
                <div class="col-8 my-auto">
                    <div class="card-body">
                        <h2 class="card-title">
                            <?php echo $user["username"] ?>
                        </h2>
                        <p class="card-text">
                            <?php echo $user["descrizione"] ?>
                        </p>
                        <p class="card-text">
                            <a href="../src/profile.php?idUtente=<?php echo $user["idUtente"]?>"
                                class="btn btn-primary">Visit page</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php array_push($oldUserId,$user["idUtente"])?>
        <?php endforeach; ?>
    </div>
    <div class="col-md-2"></div>
    <?php endif ;?>