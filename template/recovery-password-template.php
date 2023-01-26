<div class="row mt-5">
    <div class="col-12 col-md-8 mx-auto text-center shadow-lg bg-body" style="padding: 10% 0 10% 0; ">
        <div class="col-10 border mx-auto graphicForm">
            <h2><?php echo $lang["recovery_title"] ?></h2>
            <?php if(isset($data)) :?>
            <h4><?php echo $lang["recoveryPage_welcome"] ?><?php echo $data["username"];?></h4>
            <?php endif;?>
            <p><?php echo $lang["recoveryPage_insertNewPass"]; ?></p>
            <form class="form-horizontal" name="myform" method="post" action="#">
                <div class="form-group my-2">
                    <label class="control-label col-2 fw-bold" for="pwd">Password</label>
                    <input class="col-6" type="password" placeholder="<?php echo $lang["accountSetting_newPasswordText"];?>" name="pwd" id="pwd"/>
                </div>
                <div class="form-group my-2">
                    <label class="control-label col-2 fw-bold" for="pwdrepeat"><?php echo $lang["recoveryPage_confirmNewPass"];?></label>
                    <input class="col-6" type="password" placeholder="<?php echo $lang["accountSetting_rptPasswordText"];?>" name="pwdrepeat" id="pwdrepeat"/>
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