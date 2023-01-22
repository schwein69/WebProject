<div class="row">
    <div class="col-12 col-md-8 mx-auto text-center shadow-lg bg-body border border-dark" style="padding: 10% 0 10% 0; ">
        <div class="col-8 border border-secondary mx-auto" style="background-color: rgb(153, 201, 255,0.5) ; backdrop-filter: blur(10px);">
            <h2>Login</h2>
            <form action="" method="POST">
                <div class="form-floating my-3 col-6 mx-auto">
                    <input type="text" class="form-control" id="username" name="username" required/> <label
                        for="username" style="background-color:transparent; border:none;">Username:</label>
                </div>
                <div class="form-floating my-3 col-6 mx-auto">
                    <input type="password" class="form-control" id="password" name="password" required/><label
                        for="password" style="background-color:transparent; border:none;">Password:</label>
                </div>
                    <input type="checkbox" id="keepLogin" name="keepLogin"/><label
                        for="keepLogin"><?php echo $lang["login_keepLoggedIn"];?></label>
                <?php if(isset($templateParams["errormsg"])): ?>
                  <p><?php echo $templateParams["errormsg"]; ?></p>
                <?php endif; ?>
                <div class="form-floating mb-3 mt-3 col-6 mx-auto">
                    <button type="submit" class="btn col-6 mt-3" name="submit" value="<?php echo $lang["Send"];?>">Login</button>
                </div>
                <div class="btn-toolbar my-5" style="justify-content: center; display: flex;">
                    <a class="btn btn-outline-primary mx-2" href="./recoverypassword.php"><?php echo $lang["login_pwdForgot"];?></a>
                    <a class="btn btn-outline-primary mx-2" href="./registration.php"><?php echo $lang["login_signUp"];?></a>
                </div>
            </form>
        </div>
    </div>
</div>