<div class="row my-5">
    <section class="col-8 border border-secondary mx-auto"
        style="background-color: rgb(153, 201, 255,0.5) ; backdrop-filter: blur(10px);">
        <div class="col-10 mx-auto " style="border:1px black;">
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
    <section class="col-8 border border-secondary mx-auto"
        style="background-color: rgb(153, 201, 255,0.5) ; backdrop-filter: blur(10px);">
        <div class="col-10 mx-auto" style="border:1px black;">
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