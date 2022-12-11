<article class="bg-white border border-primary py-3 card col-12 col-md-8 mx-auto">
<div class="card-header">
    <div class="row mt-2">
    <div class="col-4">
        <img class="img-fluid rounded" src="<?php echo UPLOAD_DIR.$user['idUtente'].'/'.$user['fotoProfilo']?>" alt="<?php echo "foto profilo di ".$user['username'];?>" style="width: auto; max-width: 25%;"/>
    </div>
    <div class="col-4"> <h2 style="font-size: 2vw"><?php echo $user['username'];?></h2></div>
    <div class="col-4"> <button type="button" class="btn btn-light btn-md border border-dark" style="box-shadow: none;">Segui</button></div>
    </div>                                                     
</div>     

<div class="card-body">
    <p class="card-text"><?php echo $post_data['testo'];?></p>
    <p class="card-text"><small class="text-muted"><?php echo $post_data['dataPost'];?></small></p>
    <img class="card-img-bottom my-3 mx-auto" src="../imgs/uploads/childe.jpg" alt=""
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
<section id='comments'>
    <h2>Commenti</h2>
    <?php
    foreach($comments as $comment):
    ?>
    <img class="img-fluid rounded" src="<?php echo UPLOAD_DIR.$comment['idUtente'].'/'.$comment['fotoProfilo']?>" alt="<?php echo "foto profilo di ".$comment['username'];?>" style="width: auto; max-width: 25%;"/>
    <h3><?php echo $comment['username'];?></h3>
    <p><?php echo $comment['testo'];?></p>
    <p><?php echo $comment['dataCommento'];?></p>
    <?php endforeach; ?>
    <label for="userComment">Scrivi il tuo commento</label>
    <input type="text" id="userComment" placeholder="Scrivi il tuo commento..."/> 
    <button type="button" class="btn btn-light">
        <img src="../imgs/icons/send.svg" alt="Invia commento"/>
    </button>
</section>

<script src="../js/like.js"></script>

<script>
    document.getElementById("like<?php echo $_GET["postid"];?>").addEventListener('click', like);
</script>
    