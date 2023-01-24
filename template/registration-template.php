<div class="row" style=" display: flex; justify-content: center; align-items: center;">
    <div class="col-12 col-md-8 text-centershadow-lg bg-body border border-dark" style="padding: 10% 0 10% 0; ">
        <div class="col-8 border border-secondary mx-auto"
            style="background-color: rgb(153, 201, 255,0.5) ; backdrop-filter: blur(10px);">
            <h2><?php echo $lang["login_signUp"];?></h2>
            <p></p>
            <form class="form-horizontal" enctype="multipart/form-data" name="myform" method="post" action="#">
                <div class="form-group my-2">
                    <label class="control-label col-2" for="name">Username</label>
                    <input class="col-6" id="name" type="text" placeholder="username" name="name" required/>
                    <p class="errmsg"><?php echo $lang["denied_characters"]?></p>
                    <p class="errmsg"><?php echo $lang["denied_whiteSpace"]?></p>
                </div>
                <div class="form-group my-2">
                    <label class="control-label col-2" for="email">Email</label>
                    <input class="col-6" type="text" placeholder="email" name="email" id='email' required/>
                    <p class="errmsg"><?php echo $lang["denied_wrongEmail"]?></p>
                </div>
                <div class="form-group my-2">
                    <label class="control-label col-2" for="date"><?php echo $lang["Birthday"];?></label>
                    <input class="col-6" type="text" placeholder="dd-mm-yyyy" name='date' id='date' required/>
                    <p class="errmsg"><?php echo $lang["denied_wrongDate"]?></p>
                </div>
                <div class="form-group my-2">
                    <label class="control-label col-2" for="image"><?php echo $lang["ProfilePicture"];?></label>
                    <input class="col-6" type="file" id="image" name="image" accept="image/png, image/jpeg" required/>
                </div>
                <div class="form-group my-2">
                    <label class="control-label col-2" for="pwd">Password</label>
                    <input class="col-6" type="password" placeholder="password" name="pwd" id="pwd"/>
                    <p class="errmsg"><?php echo $lang["denied_wrongPassword"]?></p>
                </div>
                <div class="form-group my-2">
                    <label class="control-label col-2" for="pwdrepeat"><?php echo $lang["Repeat"];?> Password</label>
                    <input class="col-6" type="password" placeholder="password" name="pwdrepeat" id="pwdrepeat"/>
                    <p class="errmsg"><?php echo $lang["denied_wrongReapeatedPassword"]?></p>
                </div>
                <?php if(isset($templateParams["errormsg"])): ?>
                  <p><?php echo $templateParams["errormsg"]; ?></p>
                <?php endif; ?>
                <hr/>
                <button type="submit" class="btn col-4" name="submit" value="Invia"><?php echo $lang["login_signUp"];?></button>
            </form>
        </div>
    </div>
</div>

