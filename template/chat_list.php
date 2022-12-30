<div class="row col-12 col-md-8 mx-auto">
<input id="searchBox" type="text" placeholder="Cerca..."/>
</div>

<div class="row row col-12 col-md-8 mx-auto">
    <?php if(count($templateParams["chats"]) > 0): ?>
        <ul class="list-group chatbg">
        <?php foreach($templateParams["chats"] as $chat):?>
        <li class="list-group-item chatbg"> 
        <a href="chat.php?chatId=<?php echo $chat["idChat"];?>">
        <img class="chatAvatar" src="<?php echo $chat["fotoProfilo"];?>" alt="<?php echo $chat["username"];?>"/>
        <h2><?php echo $chat["username"];?></h2><span style="<?php echo isset($chat['numNotif'])? 'style:display:none':'';?>" class="badge bg-secondary"><?php echo isset($chat['numNotif'])? $chat['numNotif']:'';?></span>
        <p><?php echo $chat["anteprimaChat"] != "" ? $chat["anteprimaChat"] : "Inizia la conversazione";?></p>
        </a>
        </li>
        <?php endforeach;?>
        </ul>
    <?php else: ?>
        <p>Trovati degli amici</p>
    <?php endif; ?>
</div>