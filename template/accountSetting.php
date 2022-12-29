<div class="row mt-5">
    <div class="col-8 border border-secondary mx-auto"
        style="background-color: rgb(153, 201, 255,0.5) ; backdrop-filter: blur(10px);">
        <h2>Impostazione Account</h2>
        <form class="form-horizontal" enctype="multipart/form-data" name="myform" method="post" action="">
            <div class="form-group my-2">
                <label class="control-label col-2" for="image"><b>Foto Profilo</b>
                    <img id="thumb" class="figure-img img-fluid avatar"
                        src="<?php echo $templateParams["user"]["profilePic"]; ?>"
                        alt="foto profilo di <?php echo $templateParams["user"]["username"]; ?>" />
                    <input type="file" id="image" name="newImage" accept="image/png, image/jpeg, image/jpg"
                        style="display: none;">
                </label>
            </div>
            <div class="form-group my-2">
                <label class="control-label col-2" for="name"><b>Nome</b></label>
                <input class="col-6" type="text" value="<?php echo $templateParams["user"]["username"]; ?>" name="name" id="name" required>
            </div>
            <div class="form-group my-2">
                <label class="control-label col-2" for="email"><b>Email</b></label>
                <input class="col-6" type="text" value="<?php echo $templateParams["user"]["email"]; ?>" name="email" id='email'
                    required>
            </div>
            <div class="form-group my-2">
                <label class="control-label col-2" for="date"><b>Data Di Nascita</b></label>
                <input class="col-6" type="text" value="<?php echo $templateParams["user"]["dataDiNascita"]; ?>" name='date' id='date'
                    required>
            </div>
            <?php if (isset($templateParams["errormsg"])): ?>
            <p><?php echo $templateParams["errormsg"]; ?></p>
            <?php endif; ?>
            <hr>
            <input type="hidden" name="form1submission" value="yes" >
            <button id="updateDataButton" type="submit" class="btn btn-primary col-4 mb-3" name="submit" value="Invia"
                style="box-shadow: none;">Aggiorna</button>
        </form> 
    </div>
</div>

<div class="row mt-5">
    <div class="col-8 border border-secondary mx-auto"
        style="background-color: rgb(153, 201, 255,0.5) ; backdrop-filter: blur(10px);">
        <h2>Aggiorna Password</h2>
        <form class="form-horizontal" name="myform2" method="post" action="">
            <div class="form-group my-2">
                    <label class="control-label col-2" for="oldpwd"><b>Password originale</b></label>
                    <input class="col-6" type="password" placeholder="Vecchia Password" name="oldpwd" id="oldpwd" required>
            </div>
            <?php if (isset($templateParams["errormsgPsw"])): ?>
            <p><?php echo $templateParams["errormsgPsw"]; ?></p>
            <?php endif; ?>
            <div class="form-group my-2">
                    <label class="control-label col-2" for="pwd"><b>Password</b></label>
                    <input class="col-6" type="password" placeholder="Nuova Password" name="pwd" id="pwd">
            </div>
            <div class="form-group my-2">
                <label class="control-label col-2" for="pwdrepeat"><b>Conferma Password</b></label>
                <input class="col-6" type="password" placeholder="Ripeti Password" name="pwdrepeat" id="pwdrepeat">
            </div>    
            <hr>
            <input type="hidden" name="form2submission" value="yes" >
            <button id="updatePswButton" type="submit" class="btn btn-primary col-4 mb-3" name="submit" value="Invia"
                style="box-shadow: none;">Aggiorna</button>
        </form>
    </div>
</div>

