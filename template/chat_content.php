<div class="row chat-body col-12 col-md-8 mx-auto">
    <div class="col-4">
    <a href="profile.php?idUtente=<?php echo $templateParams["user2"]["idUtente"];?>"><img class="img-fluid avatar" src="<?php echo $templateParams["user2"]["profilePic"];?>" alt="<?php echo $templateParams["user2"]["profilePicAlt"];?>"/></a>
    </div>
    <div class="col-8 text-start">
    <h2><a href="profile.php?idUtente=<?php echo $templateParams["user2"]["idUtente"];?>"><?php echo $templateParams["user2"]["username"];?></a></h2>
    </div>
</div>

<div class="col-12 col-md-8 mx-auto p-0 chat-body">
<?php for ($i=count($templateParams["messages"])-1;  $i>=0; $i--):?>
    <div class="row p-0 m-0" style="height:fit-content">
    <div class="my-1 <?php echo $templateParams["currentUser"] != $templateParams["messages"][$i]["idMittente"]? "text-start" : "text-end ms-auto";?>">
    <p>
    <?php echo $templateParams["messages"][$i]["testoMsg"];?>
    </p>
    <span class="small text-end">
    <?php echo date('d-m-Y H:i',strtotime($templateParams["messages"][$i]["msgTimestamp"]));?>
    </span>
    </div>
    </div>
<?php endfor;?>
</div>
<div style="display:none" class="row">
    <div class="col-12 col-md-8 mx-auto">
    <p id="errMsg"></p>
    </div>
</div>
<div class="row col-12 col-md-8 mx-auto" id="chat-bottom">
    <form class="chat-body p-2">
    <input type="hidden" name="chatid" value="<?php echo $_GET["chatId"];?>"/>
    <label for="inputMsg" class="invisibleLabel"><?php echo $lang["chat_textPlaceholder"];?></label>
    <input id="inputMsg" name="inputMsg" aria-label="<?php echo $lang["chat_textPlaceholder"];?>" type="text" placeholder="<?php echo $lang["chat_textPlaceholder"];?>"/>
    <input type="submit" value="<?php echo $lang["Send"];?>"/>
    </form>
</div>