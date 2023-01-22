<?php require 'post_template.php';?>
<div class="row">
<section id='comments' class="container-fluid p-0 overflow-hidden mx-auto col-12 col-md-8 mt-1">
    <div class="row text-start">
    <h2><?php echo $lang["comments"];?></h2>
    </div>
    <?php
    foreach($templateParams["comments"] as $comment):
    ?>
    <div class="row">
        <div class="col-4 my-auto">
            <img class="img-fluid avatar my-auto" src="<?php echo UPLOAD_DIR.$comment['idUtente'].'/profile.'.$comment['formatoFotoProfilo']?>" alt="<?php echo getProfilePicAlt($comment['username']);?>"/>
        </div>
        <div class="row col-8 m-0 text-start">
            <h3><?php echo $comment['username'];?></h3>
            <p><?php echo $comment['testo'];?></p>
            <p class="text-end small"><?php echo $comment['dataCommento'];?></p>
        </div>
    </div>
    <?php endforeach; ?>
    <div class="row py-3">
    <form action="#" method="GET">
    <label class="col-3 mx-1 text-end" for="userComment"><?php echo $lang["post_writeComment"];?></label>
    <input class="col-7 mx-1" type="text" id="userComment" placeholder="<?php echo $lang["post_writeComment"];?>..."/> 
    <button class="col-1 mx-1" id="commentsend<?php echo $_GET["postid"];?>" type="submit" class="btn btn-light">
        <img src="../imgs/icons/send.svg" alt="<?php echo $lang["Send"];?>"/>
    </button>
    </form>
    </div>
</section>
</div>
<script src="../js/functions.js"></script>
<script src="../js/like.js"></script>
<script src="../js/comment.js"></script>
<script src="../js/sharePost.js"></script>
<script src="../js/follow-event.js"></script>
<script src="../js/savePost.js"></script>

<script>
    const user = {username: "<?php echo $templateParams["user"]["username"];?>", fotoProfilo: "<?php echo UPLOAD_DIR.$templateParams['user']['idUtente'].'/profile.'.$templateParams["user"]["formatoFotoProfilo"];?>"};
    document.getElementById("commentsend<?php echo $_GET["postid"];?>").addEventListener('click', comment);
</script>
    