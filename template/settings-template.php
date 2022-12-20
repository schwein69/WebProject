<div class="row">
    <div class="col-md-2"></div>
    <div class="col-12 col-md-8">
        <section class="bg-white border border-primary" style="height: 100vh;">
            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                        type="button" role="tab" aria-controls="profile" aria-selected="true">Profile Settings</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="likedposts-tab" data-bs-toggle="tab" data-bs-target="#likedposts"
                        type="button" role="tab" aria-controls="likedposts" aria-selected="false">Liked posts</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="account-tab" data-bs-toggle="tab" data-bs-target="#account"
                        type="button" role="tab" aria-controls="account" aria-selected="false">Account management</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="privacy-tab" data-bs-toggle="tab" data-bs-target="#privacy"
                        type="button" role="tab" aria-controls="privacy" aria-selected="false">Privacy & policy</button>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout-event.php">
                        Logout
                    </a>
                </li>
            </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="profile" role="tabpanel" aria-labelledby="profile-tab"><?php require("profileSetting.php") ?></div>
        <div class="tab-pane" id="likedposts" role="tabpanel" aria-labelledby="likedposts-tab"></div>
        <div class="tab-pane" id="account" role="tabpanel" aria-labelledby="account-tab"></div>
        <div class="tab-pane" id="privacy" role="tabpanel" aria-labelledby="privacy-tab"></div>
    </div>
        </section>
    </div>
    <div class="col-md-2"></div>
</div>