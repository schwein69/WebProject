<div class="row mt-5">
    <div class="col-12 col-md-8 mx-auto text-center shadow-lg bg-body" style="padding: 10% 0 10% 0; ">
        <div class="col-10 border mx-auto graphicForm">
            <h2>Login</h2>
            <form action="#" method="POST">
                <div class="form-floating my-3 col-6 mx-auto">
                    <input type="text" class="form-control" id="username" name="username" required/> <label
                        for="username" style="background-color:transparent; border:none;">Username:</label>
                </div>
                <div class="form-floating my-3 col-6 mx-auto">
                    <input type="password" class="form-control" id="password" name="password" required/><label
                        for="password" style="background-color:transparent; border:none;">Password:</label>
                </div>
                    <input type="checkbox" id="keepLogin" name="keepLogin"/><label class="p-1"
                        for="keepLogin"><?php echo $lang["login_keepLoggedIn"];?></label>
                <?php if(isset($templateParams["errormsg"])): ?>
                  <p><?php echo $templateParams["errormsg"]; ?></p>
                <?php endif; ?>
                <div class="form-floating my-3 col-6 mx-auto">
                    <button type="submit" class="btn mt-3" name="submit" value="<?php echo $lang["Send"];?>">Login</button>
                </div>
                <div class="mx-auto my-5">
                    <a class="btn mx-2" href="./recoverypassword.php"><?php echo $lang["login_pwdForgot"];?></a>
                    <a class="btn mx-2" href="./registration.php"><?php echo $lang["login_signUp"];?></a>
                </div>
            </form>
        </div>
    </div>
</div>