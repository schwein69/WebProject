<article class="row bg-white border border-primary py-3 card col-12 col-md-8 mx-auto">
<div class="card-header">
    <div class="row mt-2">
    <div class="col-4">
        <img class="img-fluid rounded" src="<?php echo $post_data['fotoProfilo']?>" alt="<?php echo "foto profilo di ".$user['username'];?>" style="width: auto; max-width: 25%;"/>
    </div>
    <div class="col-4"> <h2 style="font-size: 2vw"><?php echo $user['username'];?></h2></div>
    <div class="col-4"> <button type="button" class="btn btn-light btn-md border border-dark" style="box-shadow: none;">Segui</button></div>
    </div>                                                     
</div>     

<div class="card-body">
    <p class="card-text"><?php echo $post_data['testo'];?></p>
    <p class="card-text"><small class="text-muted"><?php echo $post_data['dataPost'];?></small></p>
    <img class="card-img-bottom my-3 mx-auto" src="../imgs/uploads/1/47/post1.png" alt=""
        style="width: 50%; display: block;" />
</div>
<div class="card-footer">
    <ul class="nav nav-pills">
        <li class="nav-item mx-2">
            <button type="button"  id="like<?php echo $_GET["postid"];?>" class="btn btn-light">
                <img src="<?php echo $post_data["liked"] ? "../imgs/icons/heart-fill.svg" : "../imgs/icons/heart.svg" ?>" alt="Like post"/>
            </button><span><?php if($post_data['numLike']>0){echo $post_data['numLike'];}?></span></li>
        <li class="nav-item mx-2">
            <button type="button" class="btn btn-light">
                <img src="../imgs/icons/chat.svg" alt="Commenta post"/>
            </button><?php if($post_data['numCommenti']>0){echo $post_data['numCommenti'];}?></li>
        <li class="nav-item mx-2">
            <button type="button" class="btn btn-light">
                <img src="../imgs/icons/star.svg" alt="Salva post"/></button>
        </li>
    </ul>
</div>
</article>
<section id='comments' class="container-fluid p-0 overflow-hidden mx-auto col-12 col-md-8 bg-white mt-1 border border-primary py-3">
    <div class="row text-start">
    <h2>Commenti</h2>
    </div>
    <?php
    foreach($comments as $comment):
    ?>
    <div class="row">
    <img class="img-fluid rounded" src="<?php echo UPLOAD_DIR.$comment['idUtente'].'/'.$comment['fotoProfilo']?>" alt="<?php echo "foto profilo di ".$comment['username'];?>" style="width: auto; max-width: 25%;"/>
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

<script src="../js/like.js"></script>
<script src="../js/comment.js"></script>
<script>
    const user = {username: "<?php echo $templateParams["user"]["username"];?>", fotoProfilo: "<?php echo UPLOAD_DIR.$templateParams['user']['idUtente'].'/'.$templateParams["user"]["fotoProfilo"];?>"};
    document.getElementById("like<?php echo $_GET["postid"];?>").addEventListener('click', like);
    document.getElementById("comment<?php echo $_GET["postid"];?>").addEventListener('click', comment);
</script>
    