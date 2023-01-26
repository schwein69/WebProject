<div class="row mt-5">
    <div class="col-12 col-md-8 mx-auto text-center shadow-lg bg-body" style="padding: 10% 0 10% 0; ">
        <div class="col-10 border mx-auto graphicForm">
            <h2><?php echo $lang["login_signUp"];?></h2>
            <p></p>
            <form class="form-horizontal" enctype="multipart/form-data" name="myform" method="post" action="#">
                <div class="form-group my-2">
                    <label class="control-label col-3" for="name">Username</label>
                    <input class="col-6" id="name" type="text" placeholder="username" name="name" required/>
                    <p class="errmsg"><?php echo $lang["denied_characters"]?></p>
                    <p class="errmsg"><?php echo $lang["denied_whiteSpace"]?></p>
                </div>
                <div class="form-group my-2">
                    <label class="control-label col-3" for="email">Email</label>
                    <input class="col-6" type="text" placeholder="email" name="email" id='email' required/>
                    <p class="errmsg"><?php echo $lang["denied_wrongEmail"]?></p>
                </div>
                <div class="form-group my-2">
                    <label class="control-label col-3" for="date"><?php echo $lang["Birthday"];?></label>
                    <input class="col-6" type="text" placeholder="dd-mm-yyyy" name='date' id='date' required/>
                    <p class="errmsg"><?php echo $lang["denied_wrongDate"]?></p>
                </div>
                <div class="form-group my-2">
                    <label class="control-label col-3" for="image"><?php echo $lang["ProfilePicture"];?></label>
                    <input class="col-6" type="file" id="image" name="image" accept="image/png, image/jpeg" required/>
                </div>
                <div class="form-group my-2">
                    <label class="control-label col-3" for="pwd">Password</label>
                    <input class="col-6" type="password" placeholder="password" name="pwd" id="pwd"/>
                    <p class="errmsg"><?php echo $lang["denied_wrongPassword"]?></p>
                </div>
                <div class="form-group my-2">
                    <label class="control-label col-3" for="pwdrepeat"><?php echo $lang["Repeat"];?> Password</label>
                    <input class="col-6" type="password" placeholder="password" name="pwdrepeat" id="pwdrepeat"/>
                    <p class="errmsg"><?php echo $lang["denied_wrongReapeatedPassword"]?></p>
                </div>
                <?php if(isset($templateParams["errormsg"])): ?>
                  <p class="errmsg" style="display: block;"><?php echo $templateParams["errormsg"]; ?></p>
                <?php endif; ?>
                <hr/>
                <button type="submit" class="btn col-4" name="submit" value="Invia"><?php echo $lang["login_signUp"];?></button>
            </form>
        </div>
    </div>
</div>

