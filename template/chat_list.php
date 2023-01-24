<div class="row col-12 col-md-8 mx-auto">
<label for="searchBox" class="invisibleLabel">Search chat</label>
<input id="searchBox" aria-label="search chat" type="search" placeholder="<?php echo $lang["Search"];?>..."/>
</div>

<div class="row col-12 col-md-8 mx-auto">
    <?php if(count($templateParams["chats"]) > 0): ?>
        <ul class="list-group chatbg p-0">
        <?php foreach($templateParams["chats"] as $chat):?>
        <li id="chat<?php echo $chat["idChat"];?>" class="list-group-item chatbg"> 
        <a href="chat.php?chatId=<?php echo $chat["idChat"];?>">
        <div class="row">
            <div class="col-4">
                <img class="img-fluid avatar" src="<?php echo $chat["fotoProfilo"];?>" alt="<?php echo $chat["username"];?>"/>
            </div>
            <div class="row col-8">
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