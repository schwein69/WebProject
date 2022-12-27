<div class="row">
    <div class="container-fluid col-12 col-md-8 mx-auto p-0">
        <section class="bg-white border border-primary py-3">
            <div class="card col-10 col-md-8 mx-auto">
                <div class="card-body">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item mx-2">
                            <figure class="figure m-2">
                                <img class="figure-img img-fluid avatar"
                                    src="<?php echo $templateParams["user"]["profilePic"]; ?>"
                                    alt="foto profilo di <?php echo $templateParams["user"]["username"] ?>" />
                                <figcaption class="figure-caption">
                                    <?php echo $templateParams["user"]["username"] ?>
                                </figcaption>
                            </figure>
                        </li>
                        <li class="nav-item mt-2">
                            <span class="bi bi-folder-fill"></span>
                            <br>Posts<br>
                            <?php echo $$templateParams["user"]["numPosts"]; ?>
                        </li>
                        <li class="nav-item mt-2"><span class="bi bi-person-heart"></span>
                            <a href="followerList.php<?php echo $templateParams["user"]["idUtente"] != $_SESSION["idUtente"] ? "?idUtente=" . $templateParams["user"]["idUtente"] : "" ?>"
                                class="profileLink"><br>Seguiti<br></a>
                            <?php echo $templateParams["user"]["numFollower"]; ?>
                        </li>
                        <li class="nav-item mt-2"><span class="bi bi-people-fill"></span>
                            <a href="followedList.php<?php echo $templateParams["user"]["idUtente"] != $_SESSION["idUtente"] ? "?idUtente=" . $templateParams["user"]["idUtente"] : "" ?>"
                                class="profileLink"><br>Seguaci<br></a>
                            <?php echo $templateParams["user"]["numFollowed"]; ?>
                        </li>
                    </ul>
                    <p class="card-text">
                        <?php echo $templateParams["user"]["descrizione"] ?>
                    </p>
                    <?php if(isset($_GET["idUtente"])) : ?>
                    <p class="card-text">
                        <button type="button" id="follower<?php echo $templateParams["user"]["idUtente"] ?>" class="btn btn-primary"
                            style="box-shadow: none;">
                            <?php echo $templateParams["user"]["followedByMe"] ? "seguito" : "segui" ?>
                        </button>
                    </p>
                    <?php endif ;?>
                </div>
            </div>
        </section>

    </div>
</div>
<?php require 'post_template.php'; ?>
