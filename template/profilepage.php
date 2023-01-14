<div class="row">
    <div class="container-fluid col-12 col-md-8 mx-auto p-0">
        <section class="py-3">
            <div class="card col-10 col-md-8 mx-auto">
                <div class="card-body">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item mx-2">               
                                <img class="img-fluid avatar"
                                    src="<?php echo $templateParams["user"]["profilePic"]; ?>"
                                    alt="<?php echo getProfilePicAlt($templateParams["user"]["username"]); ?>" />
                                <h2 style="font-size: 2vw"> 
                                    <?php echo $templateParams["user"]["username"] ?>
                                </h2>
                                 
                        </li>
                        <li class="nav-item mt-2">
                            <span class="bi bi-folder-fill"></span>
                            <div>Posts</div>
                            <?php echo $templateParams["user"]["numPosts"]; ?>
                        </li>
                        <li class="nav-item mt-2"><span class="bi bi-person-heart"></span>
                            <a href="followerList.php<?php echo $templateParams["user"]["idUtente"] != $_SESSION["idUtente"] ? "?idUtente=" . $templateParams["user"]["idUtente"] : "" ?>"
                                class="profileLink"><br><?php echo $lang["Followed"];?><br></a>
                            <?php echo $templateParams["user"]["numFollower"]; ?>
                        </li>
                        <li class="nav-item mt-2"><span class="bi bi-people-fill"></span>
                            <a href="followedList.php<?php echo $templateParams["user"]["idUtente"] != $_SESSION["idUtente"] ? "?idUtente=" . $templateParams["user"]["idUtente"] : "" ?>"
                                class="profileLink"><br><?php echo $lang["Follower"];?><br></a>
                            <?php echo $templateParams["user"]["numFollowed"]; ?>
                        </li>
                    </ul>
                    <p class="card-text">
                        <?php echo $templateParams["user"]["descrizione"] ?>
                    </p>
                    <?php if(isset($_GET["idUtente"]) && $_GET["idUtente"] != $_SESSION["idUtente"]) : ?>
                    <p class="card-text">
                        <button type="button" id="follower<?php echo $templateParams["user"]["idUtente"] ?>" class="btn"
                            style="box-shadow: none;">
                            <?php echo $templateParams["user"]["followedByMe"] ? $lang["userFollowed"] : $lang["userNotFollowed"]; ?>
                        </button>
                    </p>
                    <?php endif ;?>
                </div>
            </div>
        </section>

    </div>
</div>
<?php require 'post_template.php'; ?>
