<div class="row">
    <div class="col-12 col-md-8 mx-auto text-center shadow-lg bg-body border border-dark" style="padding: 10% 0 10% 0; ">
        <div class="col-8 border border-secondary mx-auto"
            style="background-color: rgb(153, 201, 255,0.5) ; backdrop-filter: blur(10px);">
            <h2>Ripristino</h2>
            <p>Compila l'email per ricevere il link</p>
            <form  class="form-horizontal" name="myform" method="post" action="">
                <div class="form-group my-2">
                    <label class="control-label col-2" for="email"><b>Email</b></label>
                    <input class="col-6" type="text" placeholder="Email" name="email" id='email'>
                </div>
                <hr>
                <?php if (isset($templateParams["errormsg"])): ?>
                <p><?php echo $templateParams["errormsg"]; ?></p>
                <?php endif; ?>
                <button type="submit" class="btn col-4" name="submit" value="Invia">Invia</button>
            </form>
        </div>
    </div>
</div>

