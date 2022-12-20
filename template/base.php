<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        <?php echo $templateParams["title"]; ?>
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body class="bg-primary bg-opacity-10 text-black">
    <div class="container-fluid p-0 overflow-hidden">
        <header>
            <div class="row">
                <div class="col-12 col-md-8 mx-auto pt-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-6 col-md-7 my-auto text-end">
                                <h1><a href="./index.php">Lynkzone</a></h1>
                            </div>
                            <div class="col-6 col-md-5">
                                <?php if (!isset($templateParams["loginTopNav"])): ?>
                                <nav class="navbar navbar-expand-md navbar-light">
                                    <ul class="nav nav-pills ms-auto">
                                        <?php if (isset($templateParams["profileTopNav"])): ?>
                                        <li class="mx-1"> <button role="link" type="button" id="settingsButton" class="btn btn-light">
                                                <img src="../imgs/icons/gear-fill.svg" alt="Impostazioni" />
                                            </button></li>
                                        <?php else: ?>
                                        <li class="mx-1">
                                            <button role="link" type="button" id="newpostButton" class="btn btn-light">
                                                <img src="../imgs/icons/plus-circle.svg" alt="Crea post" />
                                            </button>
                                        </li>
                                        <li class="mx-1">
                                            <button role="link" type="button" id="notifButton" class="btn btn-light">                                                
                                                <img src="../imgs/icons/bell.svg" alt="Notifiche" />
                                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-none">
                                                <span aria-label="new notifications"></span>
                                                </span>
                                            </button>
                                        </li>
                                        <?php endif; ?>
                                    </ul>
                                </nav>
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
                <nav class="col-12 col-md-8 mx-auto p-0" style="background-color: #49acf3;">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item col-3">
                            <a href="index.php" class="btn btn-primary"><span
                                    class="bi bi-house-fill"></span><br>
                                <h2>Home</h2>
                            </a>
                        </li>
                        <li class="nav-item col-3">
                            <a href="search.php" class="btn btn-primary"><span class="bi bi-search"></span>
                                <h2>Search</h2>
                            </a>
                        </li>
                        <li class="nav-item col-3" id='menuChatButton'>
                            <a href="all_chats.php" class="btn btn-primary"><span class="bi bi-chat-dots-fill"></span>
                                <h2>Chat</h2>
                            </a>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">                 
                                <span aria-label="unread messages"></span>
                            </span>
                        </li>
                        <li class="nav-item col-3">
                            <a href="../src/profile.php" class="btn btn-primary"><span
                                    class="bi bi-person-fill"></span><br>
                                <h2>Profile</h2>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </footer>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <script src="../js/messages_notification.js"></script>
    <script src="../js/base.js"></script>
    <?php
    if (isset($templateParams["js"])):
        foreach ($templateParams["js"] as $script):
    ?>
    <script src="<?php echo $script; ?>"></script>
    <?php
        endforeach;
    endif;
    ?>
</body>

</html>