<!DOCTYPE html>
<html lang="<?php echo $_SESSION["lang"]; ?>">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        <?php echo $templateParams["title"]; ?>
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../css/style.css" />
</head>

<body data-theme="<?php if (isset($_SESSION["theme"]))
    echo $_SESSION["theme"];
else
    echo "l" ?>">
        <div class="container-fluid p-0 overflow-hidden">
            <header>
                <div class="row">
                    <div class="col-12 col-md-8 mx-auto pt-3">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-6 col-md-7 my-auto text-start">
                                    <h1><a href="./index.php">Lynkzone</a></h1>
                                </div>
                                <div class="col-6 col-md-5">
                                <?php if (!isset($templateParams["loginTopNav"])): ?>
                                    <nav class="navbar navbar-expand-md navbar-light">
                                        <ul class="nav nav-pills ms-auto">
                                            <?php if (isset($templateParams["profileTopNav"])): ?>
                                                <li class="mx-1"> <button role="link" type="button" id="settingsButton"
                                                        class="btn">
                                                        <img src="../imgs/icons/gear-fill.svg"
                                                            alt="<?php echo $lang["settings"]; ?>" />
                                                    </button></li>
                                            <?php else: ?>
                                                <li class="mx-1">
                                                    <button role="link" type="button" id="newpostButton" class="btn">
                                                        <img src="../imgs/icons/plus-circle.svg"
                                                            alt="<?php echo $lang["postCreation"]; ?>" />
                                                    </button>
                                                </li>
                                                <li class="mx-1">
                                                    <button role="link" type="button" id="notifButton" class="btn">
                                                        <img src="../imgs/icons/bell.svg"
                                                            alt="<?php echo $lang["notifications"]; ?>" />
                                                        <span
                                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-none">
                                                            <span></span>
                                                        </span>
                                                    </button>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </nav>
                                <?php else: ?>
                                    <div class="text-end">
                                        <label for="notLoggedLanguages" class="invisibleLabel">
                                            <?php echo $lang["accountSetting_chooseLanguageText"]; ?>
                                        </label>
                                        <span class="bi bi-translate"></span>
                                        <select aria-label="<?php echo $lang["accountSetting_chooseLanguageText"]; ?>"
                                            name="notLoggedLanguages" id="notLoggedLanguages">
                                            <?php if ($_SESSION["lang"] == "it"): ?>
                                                <option value="it" selected="selected">Italiano</option>
                                                <option value="en">English</option>
                                            <?php else: ?>
                                                <option value="it">Italiano</option>
                                                <option value="en" selected="selected">English</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
        </header>
        <main class="text-center mb-5 mt-2">
            <?php
            if (isset($templateParams["content"])) {
                require($templateParams["content"]);
            }
            ?>
        </main>
        <?php if (!isset($templateParams["loginBottomNav"])): ?>
            <footer class="pb-5">
                <div class="fixed-bottom row">
                    <nav class="col-12 col-md-8 mx-auto p-0">
                        <ul class="nav nav-pills nav-justified">
                            <li class="nav-item col-3">
                                <a href="index.php" class="btn bottom-nav-button"><span class="bi bi-house-fill"></span>
                                    <h2>Home</h2>
                                </a>
                            </li>
                            <li class="nav-item col-3">
                                <a href="search.php" class="btn bottom-nav-button"><span class="bi bi-search"></span>
                                    <h2>
                                        <?php echo $lang["Search"]; ?>
                                    </h2>
                                </a>
                            </li>
                            <li class="nav-item col-3" id='menuChatButton'>
                                <a href="all_chats.php" class="btn bottom-nav-button"><span
                                        class="bi bi-chat-dots-fill"></span>
                                    <h2>Chat</h2>
                                </a>
                                <span style="display:none"
                                    class="position-absolute translate-middle badge rounded-pill bg-danger">
                                    <span></span>
                                </span>
                            </li>
                            <li class="nav-item col-3">
                                <a href="../src/profile.php" class="btn bottom-nav-button"><span
                                        class="bi bi-person-fill"></span>
                                    <h2>
                                        <?php echo $lang["Profile"]; ?>
                                    </h2>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </footer>
            <script src="../js/messages_notification.js"></script>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <?php
    if (isset($templateParams["js"])):
        foreach ($templateParams["js"] as $script):
            ?>
            <script src="<?php echo $script; ?>"></script>
            <?php
        endforeach;
    endif;
    ?>
    <?php if (!isset($_COOKIE["Lynkzone_firstVisit"])): ?>
        <div id="cookiebar" class="row col-12 col-md-8 mx-auto fixed-bottom py-1">
            <p class="col-11">
                <?php echo $lang["cookie_1"]; ?>
                <a href="privacy_policy.php">Privacy & Policy</a>
                <?php echo $lang["cookie_2"]; ?>
            </p>
            <button class="col-1 mt-auto btn">OK</button>
        </div>
    <?php endif; ?>
    <script src="../js/base.js"></script>
</body>

</html>