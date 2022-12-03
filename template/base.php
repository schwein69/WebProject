<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lynkzone - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="bg-primary bg-opacity-10 text-black">
    <div class="container-fluid p-0 overflow-hidden">
        <header>
            <div class="row">
                <div class="col-12 col-md-8 mx-auto">
                    <div class="container-fluid" style="background-color: #49acf3;">
                    <div class="row">
                        <div class="col-6 col-md-7 my-auto text-end">
                        <h1><a href="#">Lynkzone</a></h1>
                        </div>
                        <div class="col-6 col-md-5">
                        <nav class="navbar navbar-expand-md navbar-light">
                            <ul class="nav nav-pills ms-auto">
                                <li class="mx-1"> <button type="button" class="btn btn-light"><span
                                            class="bi bi-plus-circle"></span></button></li>
                                <li class="mx-1"> <button type="button" class="btn btn-light"><span class="bi bi-bell"></span></button>
                                </li>
                            </ul>
                        </nav>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </header>
        <main class="text-center mb-5 mt-2">
            <?php
                if(isset($templateParams["content"])){
                    require($templateParams["content"]);
                }
             ?>
        </main>

        <footer class="pb-5">
            <div class="fixed-bottom row">
                <nav class="col-12 col-md-8 mx-auto">
                    <ul class="nav nav-pills nav-justified" style="background-color: #49acf3;">
                        <li class="nav-item col-3">
                            <a href="#" class="btn btn-primary"><span class="bi bi-house-fill"></span>
                                <div>Home</div>
                            </a>
                        </li>
                        <li class="nav-item col-3">
                            <a href="#" class="btn btn-primary"><span class="bi bi-search"></span>
                                <div>Search</div>
                            </a>
                        </li>
                        <li class="nav-item col-3">
                            <a href="#" class="btn btn-primary"><span class="bi bi-chat-dots-fill"></span>
                                <div>Chat</div>
                            </a>
                        </li>
                        <li class="nav-item col-3">
                            <a href="./profile.html" class="btn btn-primary"><span class="bi bi-person-fill"></span>
                                <div>Profile</div>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>

</html>