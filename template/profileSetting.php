<div class="row my-5">
    <section class="col-8 mx-auto"
        style="background-color: rgb(153, 201, 255,0.5) ; backdrop-filter: blur(10px);">
        <div class="col-10 mx-auto">
            <h2>
                <?php echo $lang["accountSetting_changeThemeText"]; ?>
            </h2>
            <label for="themes" class="p-1">
                <?php echo $lang["accountSetting_chooseThemeText"]; ?>
            </label>
            <select id="themes">
                <option value="l">Light</option>
                <option value="d">Dark</option>
            </select>
            <button type="button" class="btn mx-auto my-3" id="changeThemeButton" style="display: block;">
                <?php echo $lang["accountSetting_submitlabel"]; ?>
            </button>
        </div>
    </section>
</div>
<div class="row my-5">
    <section class="col-8 mx-auto"
        style="background-color: rgb(153, 201, 255,0.5) ; backdrop-filter: blur(10px);">
        <div class="col-10 mx-auto">
            <form action="" method="POST">
                <h2>
                    <?php echo $lang["accountSetting_changeLanguageText"]; ?>
                </h2>
                <label for="languages" class="p-1"><?php echo $lang["accountSetting_chooseLanguageText"]; ?></label>
                <select name="languages" id="languages">
                    <option value="it">Italiano</option>
                    <option value="en">English</option>
                </select>
                <input type="hidden" name="form" value="languageFormSubmission">
                <input type="submit" name="submit" class="btn mx-auto my-3" value="<?php echo $lang["accountSetting_submitlabel"]; ?>"
                    style="display: block;" />
            </form>
        </div>
    </section>
</div>
<div class="row my-5">
    <section class="col-8 mx-auto"
        style="background-color: rgb(153, 201, 255,0.5) ; backdrop-filter: blur(10px);">
        <div class="col-10 mx-auto">
            <form action="" method="POST">
                <h2><?php echo $lang["accountSetting_modifyStoryText"]; ?></h2>
                <label for="textArea" class="p-1 my-2"><?php echo $lang["accountSetting_storyText"]; ?></label>
                <textarea class="col-12" rows="6" maxlength="512" name="textArea" id="textArea"><?php echo $templateParams["user"]["descrizione"]; ?></textarea>
                <span id="count" style="float:right; font-size: medium;"><?php echo strlen($templateParams["user"]["descrizione"])."/512" ?></span>
                <input type="hidden" name="form" value="descriptionFormSubmission">
                <input type="submit" name="submit" class="btn mx-auto my-3" value="<?php echo $lang["accountSetting_submitlabel"]; ?>"
                    style="display: block;" />
            </form>
        </div>
    </section>
</div>
<script>
const textArea = document.getElementById('textArea');
const maxLength = textArea.getAttribute("maxlength");
let actualLength = document.getElementById('count');
textArea.onkeyup = function () {
  document.getElementById('count').innerHTML = this.value.length + "/" +maxLength;
};
</script>