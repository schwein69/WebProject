<!--TODO check: a file or a text must be uploaded-->
<form action="" method="POST" class="col-12 col-md-8 mx-auto">
    <label for="testo" class="text-start col-12 fs-4">Testo</label>
    <textarea id="testo" name="testo" rows="4" class="text-start col-10 mx-auto" placeholder="Scrivi qui il testo...">
    </textarea>
    <fieldset>
    <div class="container-fluid p-0 overflow-hidden">
        <div class="row">
        <legend class="text-start">Tags</legend>
        </div>
        <div class="row">
        <input type="text" id="tag9" name="tag9" class="col-2 m-1"/>
        </div>
        <div class="row">
        <button type="button" class="m-1" style="width:fit-content;">Aggiungi tag</button>
        </div> 
    </div>
    </fieldset>
    <fieldset>
    <div class="container-fluid p-0 overflow-hidden">
        <div class="row">
        <legend class="text-start" for="tag1">Immagini</legend>
        </div>
        <div class="row">
        <input class="col-6" type="file" id="f1" name="f1" accept="video/*,image/*"/> 
        <label class="col-3" for="alt1">Testo alternativo:</label>
        <input class="col-3" type="text" id="alt1" name="alt1"/>
        </div> 
        <div class="row">
        <button class="mt-2 d-flex mx-auto" style="width:fit-content;">Aggiungi immagine/video</button>
        </div>
    </div>
    </fieldset>
    <input class="d-flex ms-auto mt-2" type="submit" value="Crea post"/>
</form>
<script src="../js/post_creation_buttons.js"></script>