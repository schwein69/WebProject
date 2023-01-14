<div class="row">
    <div class="errmsg" class="col-12 col-md-8 mx-auto">
    <p><?php echo $lang["createPost_errNoMsgVidsTxt"];?></p>
    </div>
</div>

<div class="row">
<form action="post_creation.php" method="POST" enctype="multipart/form-data" class="col-12 col-md-8 mx-auto">
    <label for="testo" class="text-start col-12 fs-4"><?php echo $lang["createPost_Txt"];?></label>
    <textarea id="testo" name="testo" rows="4" class="text-start col-10 mx-auto" placeholder="<?php echo $lang["writeHere"];?>..."></textarea>
    <fieldset>
    <legend class="text-start">Tags</legend>
    <div class="container-fluid p-2 overflow-hidden">
        <div class="row">
        <input type="text" aria-label="tag1" id="tag1" name="tag1" class="col-2 m-1"/>
        </div>
        <div class="row">
        <button type="button" class="m-1"><?php echo $lang["createPost_addTag"];?></button>
        </div> 
    </div>
    <p class="errmsg">I tag non possono contenere caratteri come: > < ; , :  \  / </p>
    </fieldset>
    <fieldset>
    <legend class="text-start"><?php echo $lang["createPost_ImgsVids"];?></legend>
    <div class="container-fluid p-3 overflow-hidden">
        <div class="row my-1">
        <input class="col-6" aria-label="<?php echo $lang["image"];?> 1" type="file" id="f1" name="f1" accept="video/*,image/*"/> 
        <label class="col-3" for="alt1"><?php echo $lang["altText"];?></label>
        <input class="col-3" aria-label="<?php echo $lang["altText"].$lang["for"].$lang["image"];?> 1" type="text" id="alt1" name="alt1"/>
        </div> 
        <div class="row">
        <button class="mt-2 d-flex mx-auto"><?php echo $lang["createPost_addImgVid"];?></button>
        </div>
    </div>
    <p class="errmsg">I testi alternativi non possono contenere caratteri come: > < ; , :  \  / </p>
    </fieldset>
    <input class="d-flex ms-auto mt-2" type="submit" value="<?php echo $lang["postCreation"];?>"/>
</form>
</div>