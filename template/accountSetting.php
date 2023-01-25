<div class="row mt-5">
    <div class="col-8 border mx-auto graphicForm">
        <h2><?php echo $lang["accountSetting_H2"];?></h2>
        <form class="form-horizontal" enctype="multipart/form-data" method="post" action="#">
            <div class="form-group my-2">
                <label class="control-label col-3 fw-bold" for="image"><?php echo $lang["accountSetting_pplabel"];?>
                    <img id="thumb" class="figure-img img-fluid avatar mx-auto" style="display: block;"
                        src="<?php echo $templateParams["user"]["profilePic"]; ?>"
                        alt="<?php echo getProfilePicAlt($templateParams["user"]["username"]); ?>" />
                    <input type="file" id="image" name="newImage" accept="image/png, image/jpeg, image/jpg"
                        style="display: none;"/>
                </label>
            </div>
            <div class="form-group my-2">
                <label class="control-label col-3 fw-bold" for="name"><?php echo $lang["accountSetting_namelabel"];?></label>
                <input class="col-6" type="text" value="<?php echo $templateParams["user"]["username"]; ?>" name="name" id="name" required/>
            </div>
            <div class="form-group my-2">
                <label class="control-label col-3 fw-bold" for="email">Email</label>
                <input class="col-6" type="text" value="<?php echo $templateParams["user"]["email"]; ?>" name="email" id='email'
                    required/>
            </div>
            <div class="form-group my-2">
                <label class="control-label col-3 fw-bold" for="date"><?php echo $lang["accountSetting_bdaylabel"];?></label>
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
    <div class="col-8 border mx-auto graphicForm">
        <h2>Aggiorna Password</h2>
        <form class="form-horizontal" method="post" action="#">
            <div class="form-group my-2">
                    <label class="control-label col-3 fw-bold" for="oldpwd">Password originale</label>
                    <input class="col-6" type="password" placeholder="Vecchia Password" name="oldpwd" id="oldpwd" required/>
            </div>
            <?php if (isset($templateParams["errormsgPsw"])): ?>
            <p><?php echo $templateParams["errormsgPsw"]; ?></p>
            <?php endif; ?>
            <div class="form-group my-2">
                    <label class="control-label col-3 fw-bold" for="pwd">Password</label>
                    <input class="col-6" type="password" placeholder="Nuova Password" name="pwd" id="pwd"/>
            </div>
            <div class="form-group my-2">
                <label class="control-label col-3 fw-bold" for="pwdrepeat">Conferma Password</label>
                <input class="col-6" type="password" placeholder="Ripeti Password" name="pwdrepeat" id="pwdrepeat"/>
            </div>    
            <hr/>
            <input type="hidden" name="form" value="passwordForm" >
            <button id="updatePswButton" type="submit" class="btn col-4 mb-3" name="submit" value="Invia">
            <?php echo $lang["accountSetting_submitlabel"]; ?></button>
        </form>
    </div>
</div>

