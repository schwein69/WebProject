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
                                <h2 style="font-size: large;"> 
                                    <?php echo $templateParams["user"]["username"] ?>
                                </h2>
                                 
                        </li>
                        <li class="nav-item mt-2">
                            <span class="bi bi-folder-fill"></span>
                            <div>Posts</div>
                            <?php echo $templateParams["user"]["numPosts"]; ?>
                        </li>
                        <li class="nav-item mt-2"><span class="bi bi-person-heart"></span>
                            <a href="followedList.php<?php echo $templateParams["user"]["idUtente"] != $_SESSION["idUtente"] ? "?idUtente=" . $templateParams["user"]["idUtente"] : "" ?>"
                                class="profileLink"><?php echo $lang["Followed"];?></a>
                            <?php echo $templateParams["user"]["numFollowed"]; ?>
                        </li>
                        <li class="nav-item mt-2"><span class="bi bi-people-fill"></span>
                            <a href="followerList.php<?php echo $templateParams["user"]["idUtente"] != $_SESSION["idUtente"] ? "?idUtente=" . $templateParams["user"]["idUtente"] : "" ?>"
                                class="profileLink"><?php echo $lang["Follower"];?></a>
                            <?php echo $templateParams["user"]["numFollower"]; ?>
                        </li>
                    </ul>
                    <div class="row">
                    <p class="h5 mt-4" style="white-space: pre-wrap;"><?php echo htmlspecialchars($templateParams["user"]["descrizione"]); ?>
                    </p>
                    </div>
                    <?php if(isset($_GET["idUtente"]) && $_GET["idUtente"] != $_SESSION["idUtente"]) : ?>
                    <p class="card-text">
                        <button type="button" value="<?php echo $templateParams["user"]["idUtente"] ?>" class="btn followButton<?php echo $templateParams["user"]["idUtente"] ?>">
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
