<div class="row mt-5">
    <div class="col-12 col-md-8 mx-auto text-center shadow-lg bg-body" style="padding: 10% 0 10% 0; ">
        <div class="col-10 border mx-auto"
            style="background-color: rgb(153, 201, 255,0.5) ; backdrop-filter: blur(10px);">
            <h2><?php echo $lang["recovery_title"] ?></h2>
            <h4><?php echo $lang["recovery_text"] ?></h4>
            <form  class="form-horizontal" name="myform" method="post" action="#">
                <div class="form-group my-2">
                    <label class="control-label col-2" for="email" style="font-weight:bold;">Email</label>
                    <input class="col-6" type="text" placeholder="Email" name="email" id='email'/>
                </div>
                <hr/>
                <?php if (isset($templateParams["errormsg"])): ?>
                <p><?php echo $templateParams["errormsg"]; ?></p>
                <?php endif; ?>
                <button type="submit" class="btn col-4" name="submit" value="Invia">Invia</button>
            </form>
        </div>
    </div>
</div>

