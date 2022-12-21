<div class="row" style=" display: flex; justify-content: center; align-items: center;">
    <div class="col-md-2"></div>
    <div class="col-12 col-md-8 text-centershadow-lg bg-body border border-dark" style="padding: 10% 0 10% 0; ">
        <div class="col-8 border border-secondary mx-auto"
            style="background-color: rgb(153, 201, 255,0.5) ; backdrop-filter: blur(10px);">
            <h1>Recovery</h1>
            <p>Compila l'email per ricevere il link</p>
            <form class="form-horizontal" name="myform" method="post" action="">
                <div class="form-group my-2">
                    <label class="control-label col-2" for="email"><b>Email</b></label>
                    <input class="col-6" type="text" placeholder="Email" name="email" id='email' required>
                </div>
                <div class="form-group my-2">
                    <label class="control-label col-2" for="psw"><b>Password</b></label>
                    <input class="col-6" type="password" placeholder="Nuova Password" name="pwd" id="pwd">
                </div>
                <div class="form-group my-2">
                    <label class="control-label col-2" for="psw-repeat"><b>Conferma Password</b></label>
                    <input class="col-6" type="password" placeholder="Ripeti Password" name="pwdrepeat" id="pwdrepeat">
                </div>
                <div class="form-group my-2">
                    <label class="control-label col-2" for="name"><b>Code</b></label>
                    <input class="col-6" type="text" placeholder="codice" name="code" required>
                </div>
                <?php if (isset($templateParams["errormsg"])): ?>
                <p><?php echo $templateParams["errormsg"]; ?></p>
                <?php endif; ?>
                <hr>
                <button type="submit" class="btn col-4" name="submit" value="Invia">Invia</button>
            </form>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>