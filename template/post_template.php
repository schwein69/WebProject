<div class="center-container" style="display:none;">
    <div role="dialog" class="confirmBox center">
        <h2><?php echo $lang["popup_deleteText"];?></h2>
        <button class="btn confirmButton" value="yes"><?php echo $lang["popup_confirmBoxYes"];?></button>
        <button class="btn confirmButton" value="no"><?php echo $lang["popup_confirmBoxNo"];?></button>
    </div>
</div>
<div class="center-container2" style="display:none;">
    <div role="dialog" class="confirmShareBox center" style="max-height:40%;max-width:50%;overflow-y:auto; overflow-x:hidden">
        <h2><?php echo $lang["popup_shareText"];?></h2>
        <div class="insertHereFriendList">
        </div>
        <div class="row mt-2">
        <p class="feedback-area my-2"></p>
        <button class="btn col-12 showMoreFriendButton mx-auto my-2" style="font-size:medium;"><?php echo $lang["popup_showMoreFriends"];?></button>
        <button class="btn col-6 confirmShareButton" value="yes"><?php echo $lang["popup_confirmBoxYes"];?></button>
        <button class="btn col-6 confirmShareButton" value="no"><?php echo $lang["popup_confirmBoxNo"];?></button>
        </div>
    </div>
</div>
<?php
/*
Function that print a post card. 

Parameters used from postParams:
-"idPost"           post id
-"testo"            contains post text
-"dataPost"         contains post publication date
-"numLike"          post number of likes
-"idUser"           contains the post author id
-"fotoProfilo"      contains the path to the post author profile picture
-"fotoProfiloAlt"   contains the alt for post author profile picture
-"username"         contains the post author username
-"isLoggedUserPost" true if it is the logged user post
-"followedByMe"     contains true if the current user is following the post author user
-"isFull"           true if it is not required post expansion
-"liked"            true if the user already likes the post
-"media"            array containing all post images and videos
    >"isImage"          true if a media is an image. false if it is a video
-"mediaPath"        path to the post media folder
-"tags"             array of tags associated to the post
*/foreach ($templateParams["posts"] as $postParams):

    ?>
    <div class="row">
        <article class="card p-0 col-12 col-md-8 mx-auto">
            <div class="card-header">
                <div class="row mt-2">
                    <div class="col-4"><a href="../src/profile.php?idUtente=<?php echo $postParams["idUser"]; ?>"> <img
                                class="img-fluid avatar" src="<?php echo $postParams["fotoProfilo"]; ?>"
                                alt="<?php echo $postParams["fotoProfiloAlt"]; ?>" /></a>
                    </div>
                    <div class="col-4">
                        <h2 style="font-size: x-large;">
                        <a href="profile.php?idUtente=<?php echo $postParams['idUser'] ?>">
                            <?php echo $postParams["username"]; ?>
                        </a>
                        </h2>
                    </div>
                    <div class="col-4">
                        <?php if (!$postParams["isLoggedUserPost"] && !isset($templateParams["dontShowFollowButton"] )): ?>
                            <button type="button" value="<?php echo $postParams["idUser"]; ?>" class="btn followButton<?php echo $postParams["idUser"]; ?>">
                                <?php echo $postParams["followedByMe"] ? $lang["userFollowed"] : $lang["userNotFollowed"]; ?>
                            </button>
                        <?php elseif ($postParams["isLoggedUserPost"]): ?>
                            <a href="edit_post.php?postid=<?php echo $postParams["idPost"];?>" class="btn"><?php echo $lang["post_editPost"];?></a>
                            <button type="button" value="<?php echo $postParams["idPost"]; ?>" class="btn removePostButton">
                                <img src="../imgs/icons/trash3.svg" alt="<?php echo $lang["post_remove"] ?>" /></button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <p class="card-text">
                    <?php echo $postParams["testo"]; ?>
                </p>
                <p class="card-text">
                    <?php echo $postParams["dataPost"]; ?>
                </p>


                <?php
                $active = true;
                if (count($postParams["media"]) > 1):
                    ?>

                    <div id="carousel<?php echo $postParams["idPost"] ?>" class="carousel slide" data-bs-interval="false">
                        <div class="carousel-inner">

                            <?php foreach ($postParams["media"] as $immagine):
                                $classes = 'carousel-item';
                                if ($active) {
                                    $classes .= ' active';
                                    $active = false;
                                }
                                ?>
                                <div class='<?php echo $classes ?>'>
                                    <?php if ($immagine["isImage"]): ?>
                                        <img class="card-img-bottom my-2 mx-auto"
                                            src="<?php echo $postParams["mediaPath"] . $immagine["nomeImmagine"] ?>"
                                            alt="<?php echo $immagine["descrizione"] ?>" />
                                    <?php else: ?>
                                        <video class="card-img-bottom my-2 mx-auto" controls loop>
                                            <source src="<?php echo $postParams["mediaPath"] . $immagine["nomeImmagine"]; ?>"
                                                type="video/<?php echo $immagine["formato"]; ?>" />
                                            <?php echo $immagine["descrizione"] != "" ? $immagine["descrizione"] : 'Video not supported'; ?>
                                        </video>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <a class="carousel-control-prev" type="button" data-bs-target="#carousel<?php echo $postParams["idPost"] ?>"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon bg-dark"></span>
                    </a>
                    <a class="carousel-control-next" type="button" data-bs-target="#carousel<?php echo $postParams["idPost"] ?>"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon bg-dark"></span>
                    </a>

                <?php elseif (count($postParams["media"]) == 1): ?>
                    <?php if ($postParams["media"][0]["isImage"]): ?>

                        <img class="card-img-bottom my-2 mx-auto"
                            src="<?php echo $postParams["mediaPath"] . $postParams["media"][0]["nomeImmagine"] ?>"
                            alt="<?php echo $postParams["media"][0]["descrizione"] ?>" />
                    <?php else: ?>
                        <video class="card-img-bottom my-2 mx-auto" controls loop>
                            <source src="<?php echo $postParams["mediaPath"] . $postParams['media'][0]["nomeImmagine"]; ?>"
                                type="video/<?php echo $postParams['media'][0]["formato"]; ?>" />
                            <?php echo $postParams['media'][0]["descrizione"] != "" ? $postParams['media'][0]["descrizione"] : 'Video not supported'; ?>
                        </video>
                    <?php endif; ?>
                <?php endif;
                if (!$postParams["isFull"]):
                    ?>

                    <a href="post.php?postid=<?php echo $postParams["idPost"]; ?>" value="<?php echo $postParams["idPost"] ?>"
                        class="btn ms-auto" style="display:block ; width: fit-content;">
                        <?php echo $lang["post_readMore"]; ?>
                    </a>
                <?php endif; ?>
            </div>

            <?php if (isset($postParams["tags"]) && count($postParams["tags"]) > 0): ?>
                <section>
                    <h2 class="text-start">Tags</h2>
                    <ul class="list-group list-group-horizontal">
                        <?php foreach ($postParams["tags"] as $tag): ?>
                            <li class="list-group-item badge rounded-pill mx-1 bg-primary text-light mt-1"><?php echo $tag["nomeTag"]; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </section>
            <?php endif; ?>

            <div class="card-footer">
                <ul class="nav nav-pills">
                    <li class="nav-item mx-2">
                        <button type="button" value="<?php echo $postParams["idPost"] ?>" class="btn likeButton">
                            <img src="<?php echo $postParams["liked"] ? "../imgs/icons/heart-fill.svg" : "../imgs/icons/heart.svg"; ?>"
                                alt="<?php echo $postParams["liked"] ? "Dislike post" : "Like post"; ?>" />
                        </button>
                        <span>
                            <?php if ($postParams['numLike'] > 0 && isset($postParams["allLikesClickable"])) : ?>
                                <a href="all_likes.php?idPost=<?php echo $postParams['idPost'];?>" alt=""><?php echo $postParams['numLike'];?></a>
                            <?php elseif($postParams['numLike'] > 0) : {
                                echo $postParams['numLike'];
                            }?>
                            <?php endif;?>
                        </span>
                    </li>
                    <li class="nav-item mx-2"> <button type="button" value="<?php echo $postParams["idPost"] ?>"
                            class="btn commentBtn">
                            <img src="../imgs/icons/chat.svg" alt="Commenta post" /></button>
                        <span>
                            <?php if ($postParams['numCommenti'] > 0) {
                                echo $postParams['numCommenti'];
                            } ?>
                        </span>
                    </li>
                    <li class="nav-item mx-2"> <button type="button" value="<?php echo $postParams["idPost"] ?>"
                            class="btn saveButton">
                            <img src="<?php echo $postParams["saved"] ? "../imgs/icons/star-fill.svg" : "../imgs/icons/star.svg"; ?>"
                                alt="<?php echo $postParams["saved"] ? $lang["post_saved"] : $lang["post_notSaved"]; ?>" /></button><span></span>
                    </li>
                    <li class="nav-item mx-2"> <button type="button" value="<?php echo $postParams["idPost"] ?>"
                            class="btn sharePostButton">
                            <img src="../imgs/icons/share.svg"
                                alt="<?php echo $lang["post_share"] ?>" /></button><span></span>
                    </li>
                </ul>
            </div>
        </article>
    </div>
    <?php
endforeach;

if (isset($templateParams["oldPostIds"])):
    ?>
    <script>
        const oldId = <?php echo json_encode($templateParams["oldPostIds"]); ?>;
    </script>
<?php endif; ?>