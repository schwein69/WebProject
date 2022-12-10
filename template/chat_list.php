<div class="row col-12 col-md-8 mx-auto">
<input id="searchBox" type="text" placeholder="Cerca..."/>
</div>

<div class="row row col-12 col-md-8 mx-auto">
    <?php if(count($templateParams["chats"]) > 0): ?>
        <ul class="list-group">
        <?php foreach($templateParams["chats"] as $chat):?>
        <li class="list-group-item"> 
        <a href="chat.php?chatId=<?php echo $chat["idChat"];?>">
        <img src="<?php echo $chat["profilePicture"];?>" alt="<?php echo $chat["username"];?>"/>
        <h2><?php echo $chat["username"];?></h2>
        <p><?php echo $chat["anteprimaChat"];?></p>
        </a>
        </li>
        <?php endforeach;?>
        </ul>
    <?php else: ?>
        <p>Trovati degli amici</p>
    <?php endif; ?>
</div>