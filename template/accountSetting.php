<div class="row mt-5">
    <div class="col-8 border mx-auto"
        style="background-color: rgb(153, 201, 255,0.5) ; backdrop-filter: blur(10px);">
        <h2><?php echo $lang["accountSetting_H2"];?></h2>
        <form class="form-horizontal" enctype="multipart/form-data" method="post" action="#">
            <div class="form-group my-2">
                <label class="control-label col-3" for="image"><?php echo $lang["accountSetting_pplabel"];?>
                    <img id="thumb" class="figure-img img-fluid avatar mx-auto" style="display: block;"
                        src="<?php echo $templateParams["user"]["profilePic"]; ?>"
                        alt="<?php echo getProfilePicAlt($templateParams["user"]["username"]); ?>" />
                    <input type="file" id="image" name="newImage" accept="image/png, image/jpeg, image/jpg"
                        style="display: none;"/>
                </label>
            </div>
            <div class="form-group my-2">
<<<<<<< HEAD
                <label class="control-label col-2" for="name"><?php echo $lang["accountSetting_namelabel"];?></label>
                <input class="col-6" type="text" value="<?php echo $templateParams["user"]["username"]; ?>" name="name" id="name" required/>
=======
                <label class="control-label col-3" for="name"><?php echo $lang["accountSetting_namelabel"];?></label>
                <input class="col-6" type="text" value="<?php echo $templateParams["user"]["username"]; ?>" name="name" id="name" required>
>>>>>>> 0fb0dd5cac43910339cd3370494ad614e50d0c4e
            </div>
            <div class="form-group my-2">
                <label class="control-label col-3" for="email">Email</label>
                <input class="col-6" type="text" value="<?php echo $templateParams["user"]["email"]; ?>" name="email" id='email'
                    required/>
            </div>
            <div class="form-group my-2">
                <label class="control-label col-3" for="date"><?php echo $lang["accountSetting_bdaylabel"];?></label>
                <input class="col-6" type="text" value="<?php echo $templateParams["user"]["dataDiNascita"]; ?>" name='date' id='date'
                    required/>
            </div>
            <?php if (isset($templateParams["errormsg"])): ?>
            <p><?php echo $templateParams["errormsg"]; ?></p>
            <?php endif; ?>
            <hr/>
            <input type="hidden" name="form" value="dataForm" >
            <button id="updateDataButton" type="submit" class="btn col-4 mb-3" name="submit" value="Invia">
            <?php echo $lang["accountSetting_submitlabel"];?></button>
        </form> 
    </div>
</div>

<div class="row my-5">
    <div class="col-8 border mx-auto"
        style="background-color: rgb(153, 201, 255,0.5) ; backdrop-filter: blur(10px);">
        <h2>Aggiorna Password</h2>
        <form class="form-horizontal" method="post" action="#">
            <div class="form-group my-2">
                    <label class="control-label col-3" for="oldpwd" style="font-weight:bold;">Password originale</label>
                    <input class="col-6" type="password" placeholder="Vecchia Password" name="oldpwd" id="oldpwd" required/>
            </div>
            <?php if (isset($templateParams["errormsgPsw"])): ?>
            <p><?php echo $templateParams["errormsgPsw"]; ?></p>
            <?php endif; ?>
            <div class="form-group my-2">
<<<<<<< HEAD
                    <label class="control-label col-2" for="pwd" style="font-weight:bold;">Password</label>
                    <input class="col-6" type="password" placeholder="Nuova Password" name="pwd" id="pwd"/>
            </div>
            <div class="form-group my-2">
                <label class="control-label col-2" for="pwdrepeat" style="font-weight:bold;">Conferma Password</label>
                <input class="col-6" type="password" placeholder="Ripeti Password" name="pwdrepeat" id="pwdrepeat"/>
=======
                    <label class="control-label col-3" for="pwd"><b>Password</b></label>
                    <input class="col-6" type="password" placeholder="Nuova Password" name="pwd" id="pwd">
            </div>
            <div class="form-group my-2">
                <label class="control-label col-3" for="pwdrepeat"><b>Conferma Password</b></label>
                <input class="col-6" type="password" placeholder="Ripeti Password" name="pwdrepeat" id="pwdrepeat">
>>>>>>> 0fb0dd5cac43910339cd3370494ad614e50d0c4e
            </div>    
            <hr/>
            <input type="hidden" name="form" value="passwordForm" >
            <button id="updatePswButton" type="submit" class="btn col-4 mb-3" name="submit" value="Invia">
            <?php echo $lang["accountSetting_submitlabel"]; ?></button>
        </form>
    </div>
</div>

