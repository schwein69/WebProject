<div class="row mt-5" style=" display: flex; justify-content: center; align-items: center;">
    <div class="col-8 border border-secondary mx-auto"
        style="background-color: rgb(153, 201, 255,0.5) ; backdrop-filter: blur(10px);">
        <h2><?php echo $lang["accountSetting_H2"];?></h2>
        <form class="form-horizontal" enctype="multipart/form-data" name="myform" method="post" action="">
            <div class="form-group my-2">
                <label class="control-label col-2" for="image"><?php echo $lang["accountSetting_pplabel"];?>
                    <img id="thumb" class="figure-img img-fluid avatar"
                        src="<?php echo $templateParams["user"]["profilePic"]; ?>"
                        alt="<?php echo getProfilePicAlt($templateParams["user"]["username"]); ?>" />
                    <input type="file" id="image" name="newImage" accept="image/png, image/jpeg, image/jpg"
                        style="display: none;">
                </label>
            </div>
            <div class="form-group my-2">
                <label class="control-label col-2" for="name"><?php echo $lang["accountSetting_namelabel"];?></label>
                <input class="col-6" type="text" value="<?php echo $templateParams["user"]["username"]; ?>" name="name" id="name" required>
            </div>
            <div class="form-group my-2">
                <label class="control-label col-2" for="email">Email</label>
                <input class="col-6" type="text" value="<?php echo $templateParams["user"]["email"]; ?>" name="email" id='email'
                    required>
            </div>
            <div class="form-group my-2">
                <label class="control-label col-2" for="date"><?php echo $lang["accountSetting_bdaylabel"];?></label>
                <input class="col-6" type="text" value="<?php echo $templateParams["user"]["dataDiNascita"]; ?>" name='date' id='date'
                    required>
            </div>
            <?php if (isset($templateParams["errormsg"])): ?>
            <p><?php echo $templateParams["errormsg"]; ?></p>
            <?php endif; ?>
            <hr>
            <button id="updateDataButton" type="submit" class="btn btn-primary col-4 mb-3" name="submit" value="Invia"
                style="box-shadow: none;"><?php echo $lang["accountSetting_submitlabel"];?></button>
        </form>
    </div>
</div>
