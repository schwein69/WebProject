<div class="row">
<div class="col-12 col-md-8 mx-auto">
<?php for ($i=count($templateParams["messages"])-1;  $i>=0; $i--):?>
   <p class="<?php echo $templateParams["currentUser"] == $templateParams["messages"][$i]["idMittente"]? "text-start" : "text-end";?>">
    <?php echo $templateParams["messages"][$i]["testoMsg"];?>
    </p>
<?php endfor;?>
</div>
</div>
<div class="row sticky-top">
    <div class="col-12 col-md-8 mx-auto">
    <input type="text" placeholder="Scrivi qui il tuo messaggio"/>
    <input type="submit" value="Invia"/>
    </div>
</div>