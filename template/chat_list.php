<div class="row col-12 col-md-8 mx-auto">
<input id="searchBox" type="text" placeholder="<?php echo $lang["Search"];?>..."/>
</div>

<div class="row row col-12 col-md-8 mx-auto">
    <?php if(count($templateParams["chats"]) > 0): ?>
        <ul class="list-group chatbg p-0">
        <?php foreach($templateParams["chats"] as $chat):?>
        <li class="list-group-item" style="border:none;"> 
        <a href="chat.php?chatId=<?php echo $chat["idChat"];?>">
        <div class="row">
            <div class="col-3">
                <img class="chatAvatar" src="<?php echo $chat["fotoProfilo"];?>" alt="<?php echo $chat["username"];?>"/>
            </div>
            <div class="row col-9">
                <h2><?php echo $chat["username"];?></h2>
                <div class="row mx-auto">
                    <p><?php echo $chat["anteprimaChat"] != "" ? $chat["anteprimaChat"] : $lang["chat_startNewConversation"];?></p><span style="<?php echo isset($chat['numNotif'])? '':'display:none;';?>" class="badge bg-secondary"><?php echo isset($chat['numNotif'])? $chat['numNotif']:'';?></span>
                </div>
            </div>
        </div>
        </a>
        </li>
        <?php endforeach;?>
        </ul>
    <?php else: ?>
        <p><?php echo $lang["chat_noFriends"];?></p>
    <?php endif; ?>
</div>