<div class="row" style=" display: flex; justify-content: center; align-items: center;">
    <div class="col-12 col-md-8 mx-auto text-center shadow-lg bg-body border border-dark" style="padding: 10% 0 10% 0; ">
        <div class="col-8 border border-secondary mx-auto"
            style="background-color: rgb(153, 201, 255,0.5) ; backdrop-filter: blur(10px);">
            <h2><?php echo $lang["recovery_title"] ?></h2>
            <?php if(isset($data)) :?>
            <h4><?php echo $lang["recoveryPage_welcome"] ?><?php echo $data["username"];?></h4>
            <?php endif;?>
            <p><?php echo $lang["recoveryPage_insertNewPass"]; ?></p>
            <form class="form-horizontal" name="myform" method="post" action="#">
                <div class="form-group my-2">
                    <label class="control-label col-2" for="pwd" style="font-weight:bold;">Password</label>
                    <input class="col-6" type="password" placeholder="Nuova Password" name="pwd" id="pwd"/>
                </div>
                <div class="form-group my-2">
                    <label class="control-label col-2" for="pwdrepeat" style="font-weight:bold;"><?php echo $lang["recoveryPage_confirmNewPass"];?></label>
                    <input class="col-6" type="password" placeholder="Ripeti Password" name="pwdrepeat" id="pwdrepeat"/>
                </div>
                <?php if (isset($templateParams["errormsg"])): ?>
                <p><?php echo $templateParams["errormsg"]; ?></p>
                <?php endif; ?>
                <hr/>
                <button id="newPswButton" type="submit" class="btn col-4" name="submit" value="Invia"><?php echo $lang["recoveryPage_confirmButton"];?></button>
            </form>
        </div>
    </div>
</div>