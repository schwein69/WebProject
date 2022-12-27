<?php require 'post_template.php';?>
<div class="row">
<section id='comments' class="container-fluid p-0 overflow-hidden mx-auto col-12 col-md-8 bg-white mt-1 border border-primary py-3">
    <div class="row text-start">
    <h2>Commenti</h2>
    </div>
    <?php
    foreach($comments as $comment):
    ?>
    <div class="row">
    <img class="img-fluid rounded" src="<?php echo UPLOAD_DIR.$comment['idUtente'].'/profile.'.$comment['formatoFotoProfilo']?>" alt="<?php echo "foto profilo di ".$comment['username'];?>" style="width: auto; max-width: 25%;"/>
    <h3><?php echo $comment['username'];?></h3>
    <p><?php echo $comment['testo'];?></p>
    <p><?php echo $comment['dataCommento'];?></p>
    </div>
    <?php endforeach; ?>
    <div class="row">
    <label class="col-3 mx-1 text-end" for="userComment">Scrivi il tuo commento</label>
    <input class="col-7 mx-1" type="text" id="userComment" placeholder="Scrivi il tuo commento..."/> 
    <button class="col-1 mx-1" id="comment<?php echo $_GET["postid"];?>" type="button" class="btn btn-light">
        <img src="../imgs/icons/send.svg" alt="Invia commento"/>
    </button>
    </div>
</section>
</div>
<script src="../js/functions.js"></script>
<script src="../js/like.js"></script>
<script src="../js/comment.js"></script>

<script>
    const user = {username: "<?php echo $templateParams["user"]["username"];?>", fotoProfilo: "<?php echo UPLOAD_DIR.$templateParams['user']['idUtente'].'/profile.'.$templateParams["user"]["formatoFotoProfilo"];?>"};
    document.getElementById("comment<?php echo $_GET["postid"];?>").addEventListener('click', comment);
</script>
    