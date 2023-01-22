<div class="row">
    <label class="mx-auto" style="width: fit-content;"><h2><a href="profile.php?idUtente=<?php echo $templateParams["user2"]["idUtente"];?>"><?php echo $templateParams["user2"]["username"];?></a></h2></label>
</div>

<div class="row">
<div class="col-12 col-md-8 mx-auto p-0">
<?php for ($i=count($templateParams["messages"])-1;  $i>=0; $i--):?>
    <div class="chat-msg my-1 <?php echo $templateParams["currentUser"] != $templateParams["messages"][$i]["idMittente"]? "text-start" : "text-end ms-auto";?>">
    <p>
    <?php echo $templateParams["messages"][$i]["testoMsg"];?>
    </p>
    <span class="text-end">
    <?php echo date('d-m-Y H:i',strtotime($templateParams["messages"][$i]["msgTimestamp"]));?>
    </span>
    </div>
<?php endfor;?>
</div>
</div>
<div style="display:none" class="row">
    <div class="col-12 col-md-8 mx-auto">
    <p id="errMsg"></p>
    </div>
</div>
<div class="row" id="chat-bottom">
    <form class="col-12 col-md-8 mx-auto">
    <input type="hidden" name="chatid" value="<?php echo $_GET["chatId"];?>"/>
    <input id="inputMsg" name="inputMsg" type="text" placeholder="<?php echo $lang["chat_textPlaceholder"];?>"/>
    <input type="submit" value="<?php echo $lang["Send"];?>"/>
    </form>
</div>