<div class="row">
    <div class="errmsg" class="col-12 col-md-8 mx-auto">
    <p><?php echo $lang["createPost_errNoMsgVidsTxt"];?></p>
    </div>
</div>

<div class="row">
<form action="<?php echo $templateParams["formTarget"];?>" method="POST" enctype="multipart/form-data" class="col-12 col-md-8 mx-auto minForm">
    <label for="testo" class="text-start col-12 fs-4"><?php echo $lang["createPost_Txt"];?></label>
    <textarea id="testo" name="testo" rows="4" class="text-start col-10 mx-auto" placeholder="<?php echo $lang["writeHere"];?>..."><?php echo isset($templateParams["post"]["testo"]) ? $templateParams["post"]["testo"] : "";?></textarea>
    <fieldset>
    <legend class="text-start">Tags</legend>
    <div class="container-fluid p-2 overflow-hidden">
        
        <div class="row">
        <?php if(!isset($templateParams["post"]["tags"]) || count($templateParams["post"]["tags"]) == 0): ?>
            <input type="text" aria-label="tag1" id="tag1" name="tag1" class="col-12 col-md-2 m-1"/>
        <?php else: 
            for ($i=1; $i <= count($templateParams["post"]["tags"]); $i++):
        ?>
            <input type="text" aria-label="tag<?php echo $i;?>" id="tag<?php echo $i;?>" name="tag<?php echo $i;?>" class="col-12 col-md-2 m-1" value="<?php echo $templateParams["post"]["tags"][$i-1]["nomeTag"];?>"/>
        <?php endfor;
            endif;?>
        </div>

        <div class="row">
        <button type="button" class="m-1"><?php echo $lang["createPost_addTag"];?></button>
        </div> 
    </div>
    <p class="errmsg">I tag non possono contenere caratteri come: > < ; , :  \  / </p>
    </fieldset>

    <?php if(isset($templateParams["post"]["media"]) && count($templateParams["post"]["media"]) > 0):?>
        <fieldset class="text-start">
            <legend>Scegli quale immagine o video rimuovere</legend>
            <?php foreach($templateParams["post"]["media"] as $media):?>
                <input type="checkbox" name="delMedia<?php echo $media["idContenuto"];?>" id="delMedia<?php echo $media["idContenuto"];?>" value="<?php echo $media["idContenuto"];?>"/>
                <label for="delMedia<?php echo $media["idContenuto"];?>"><img src="<?php echo $media["percorsoImmagine"];?>" alt="<?php echo $media["descrizione"];?>" style="height:100px"></label>
            <?php endforeach;?>
        </fieldset>
    <?php endif;?>
    <fieldset>
    <legend class="text-start"><?php echo $lang["createPost_ImgsVids"];?></legend>
    <div class="container-fluid p-3 overflow-hidden">
        <div class="row my-3 p-2">
        <input class="col-6" aria-label="<?php echo $lang["image"];?> 1" type="file" id="f1" name="f1" accept="video/*,image/*"/> 
        <div class="row my-2">
        <label class="col-3" for="alt1"><?php echo $lang["altText"];?></label>
        <input class="col-12 col-md-6" aria-label="<?php echo $lang["altText"].$lang["for"].$lang["image"];?> 1" type="text" id="alt1" name="alt1"/>
        </div>    
        </div> 
        <div class="row">
        <button class="mt-2 d-flex mx-auto"><?php echo $lang["createPost_addImgVid"];?></button>
        </div>
    </div>
    <p class="errmsg">I testi alternativi non possono contenere caratteri come: > < ; , :  \  / </p>
    <p class="errmsg"><?php echo "Il post non può contenere più di 9 immagini o video.";?></p>
    </fieldset>
    <?php if (isset($_GET["postid"])):?>
        <input type="hidden" name="postid" value="<?php echo $_GET["postid"];?>"/>
    <?php endif;?>

    <input class="d-flex ms-auto mt-2" type="submit" value="<?php echo $templateParams["submitButtonText"];?>"/>
</form>
</div>

<script>
    const tagOffset = <?php echo isset($templateParams["post"]["tags"]) && count($templateParams["post"]["tags"]) >0
                                ? count($templateParams["post"]["tags"]) - 1
                                : 0;?>;
</script>