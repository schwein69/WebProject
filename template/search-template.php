<div class="row" id="searchbar">
    <div class="col-12 col-md-8 my-2 mx-auto">
        <form action="" method="GET">
            <input type="radio" id="user" name="searchOption" value="User" required>
            <label for="user">USERNAME</label>
            <input type="radio" id="tag" name="searchOption" value="Tag">
            <label for="tag">TAG</label>
            <input class="col-6" type="text" list="search keyword" id="searchTextArea" name="searchValue"
                placeholder="Search" required />
            <datalist id="search keyword" style="background-color: white;">
            </datalist>
            <input class="col-2" type="submit"></input>

        </form>
    </div>
</div>
<?php
if($templateParams["selector"] == true):
    require 'post_template.php';
    
?>
        
<?php else :?>
<div class="row">
    <div class="col-12 col-md-8 mx-auto">
        <?php $oldUserId = array();?>
        <?php foreach ($userData as $user): ?>
        <div class="card col-12 mx-auto">
            <div class="row g-0">
                <div class="col-4 my-auto">
                    <img src="<?php echo UPLOAD_DIR.$user["idUtente"]."/profile.".$user["formatoFotoProfilo"] ?>"
                        class="img-fluid rounded searchAvatar" alt="<?php echo getProfilePicAlt($user["username"]); ?>">
                </div>
                <div class="col-8 my-auto">
                    <div class="card-body">
                        <h2 class="card-title">
                            <?php echo $user["username"] ?>
                        </h2>
                        <p class="card-text">
                            <?php echo $user["descrizione"] ?>
                        </p>
                        <p class="card-text">
                            <a href="../src/profile.php?idUtente=<?php echo $user["idUtente"]?>"
                                class="btn"><?php echo $lang["VisitPage"];?></a>
                            <?php $user["followedByMe"] = $dbh->getUserFunctionHandler()->isFollowedByMe($_SESSION["idUtente"],$user["idUtente"]); ?>
                            <button type="button" class="btn followButton<?php echo $user["idUtente"];?>" value="<?php echo $user["idUtente"];?>">
                                <?php echo $user["followedByMe"]  ? $lang["userFollowed"] :  $lang["userNotFollowed"]; ?>
                            </button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php array_push($oldUserId,$user["idUtente"])?>
        <?php endforeach; ?>
    </div>
    <?php endif ;?>
<script>
const tagName = <?php if (isset($templateParams["tagName"])) { echo json_encode($templateParams['tagName']); } else echo json_encode("") ?>;
const isTag = <?php echo $templateParams["isTag"];?>;
</script>