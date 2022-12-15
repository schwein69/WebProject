<div class="row">
    <div class="col-md-2"></div>
    <div class="col-12 col-md-8">
        <section class="bg-white border border-primary" style="height: 100vh;">
            <div class="col-10 col-md-8 mx-auto">
                <nav class="navbar my-5">
                    <ul class="navbar-nav w-100" id="settings-ul">
                        <li class="nav-item ">
                            <a class="nav-link" href="#">
                                <h2>Profile Settings</h2>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <h2>Liked Posts</h2>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <h2>Account Management</h2>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <h2>Privacy & Policy</h2>
                            </a>
                        </li>
                        <li class="nav-item">
                            <button name="logout_btn" id="logout" class="col-12">
                                <h2>Logout</h2>
                            </button>
                        </li>
                    </ul>
                </nav>
            </div>
        </section>
        <div class="col-md-2"></div>
        <script>
            document.getElementById("logout")
                .addEventListener("click", function (e) {
                    if (!confirm("Do you want logout?")) {
                        e.preventDefault();
                    } else {
                        logout();
                    }
                });
        </script>