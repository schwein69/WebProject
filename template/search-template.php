<script src="../js/search.js"></script>
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
<?php if($templateParams["selector"] == true):?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-12 col-md-8">
        <?php foreach ($posts as $post): ?>
        <article class="bg-white border border-primary py-3">
            <div class="card col-10 col-md-8 mx-auto">
                <div class="card-header">
                    <div class="row mt-2">
                        <div class="col-4"> <img class="img-fluid rounded" src="<?php echo $post["fotoProfilo"] ?>"
                                alt="foto profilo di <?php echo $post["username"] ?>"
                                style="width: auto; max-width: 25%;" /></div>
                        <div class="col-4">
                            <h2 style="font-size: 2vw">
                                <?php echo $post["username"] ?>
                            </h2>
                        </div>
                        <div class="col-4"> <button value="<?php echo $post["idUtente"] ?>" type="button"
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

                    <?php if (count($immaginiPost) != 1): ?>

                    <div id="carousel" class="carousel slide" data-bs-interval="false">
                        <div class="carousel-inner">

                            <?php foreach ($immaginiPost as $immagine): ?>
                            <?php if ($active) {
                        echo "<div class='carousel-item active'>";
                        $active = false;
                    } else {
                        echo "<div class='carousel-item'>";
                    } ?>
                            <img class="card-img-bottom my-3 mx-auto" src="<?php echo $immagine["percorso"] ?>"
                                alt="<?php echo $immagine["descrizione"] ?>" style="width: 50%; display: block;" />
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <a class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                        <span>Previous</span>
                    </a>
                    <a class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                        <span>Next</span>
                    </a>
                </div>
                <?php else: ?>

                <img class="card-img-bottom my-3 mx-auto" src="<?php echo $immaginiPost[0]["percorso"] ?>"
                    alt="<?php echo $immaginiPost[0]["descrizione"] ?>" style="width: 50%; display: block;" />
                <?php endif; ?>


                <a href="#" value="<?php echo $post["idPost"] ?>" class="btn btn-primary ms-auto"
                    style="display:block ; width: fit-content;">Espandi</a>
            </div>
            <div class="card-footer">
                <ul class="nav nav-pills">
                    <li class="nav-item mx-2"> <button type="button" class="btn btn-light"
                            id="like<?php echo $post["idPost"]?>"><span class="bi bi-heart"></span></button></li>
                    <li class="nav-item mx-2"> <button type="button" class="btn btn-light"
                            id="chat<?php echo $post["idPost"]?>"><span class="bi bi-chat"></span></button></li>
                    <li class="nav-item mx-2"> <button type="button" class="btn btn-light"
                            id="star<?php echo $post["idPost"]?>"><span class="bi bi-star"></span></button></li>
                </ul>
            </div>
    </div>
    </article>
    <?php endforeach; ?>
</div>
<div class="col-md-2"></div>
</div>
<?php else :?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-12 col-md-8">
        <?php foreach ($userData as $user): ?>
        <div class="card col-12 mx-auto">
            <div class="row g-0">
                <div class="col-4">
                    <img src="<?php echo $user["fotoProfilo"] ?>" class="img-fluid rounded-start" alt="foto profilo di <?php echo $user["username"] ?>">
                </div>
                <div class="col-8">
                    <div class="card-body">
                        <h2 class="card-title"><?php echo $user["username"] ?></h2>
                        <p class="card-text"><?php echo $user["descrizione"] ?></p>
                        <p class="card-text">
                            <a href="../src/profile.php?idUtente=<?php echo $user["idUtente"]?>" class="btn btn-primary">Visit page</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="col-md-2"></div>
    <?php endif ;?>