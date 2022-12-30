<div class="row">
    <div class="container-fluid col-12 col-md-8 mx-auto p-0">
        <section style="height: 100vh;">
            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                        type="button" role="tab" aria-controls="profile" aria-selected="true">Profile Settings</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="posts-tab" data-bs-toggle="tab" data-bs-target="#posts"
                        type="button" role="tab" aria-controls="posts" aria-selected="false">Saved posts</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="account-tab" data-bs-toggle="tab" data-bs-target="#account"
                        type="button" role="tab" aria-controls="account" aria-selected="false">Account</button>
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
        <div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="profile-tab"><?php if(isset($templateParams["profileSetting"])) require($templateParams["profileSetting"])?></div>
        <div class="tab-pane fade " id="posts" role="tabpanel" aria-labelledby="posts-tab"><?php if(isset($templateParams["savedposts"])) require($templateParams["savedposts"]) ?></div>
        <div class="tab-pane fade " id="account" role="tabpanel" aria-labelledby="account-tab"><?php if(isset($templateParams["accountSetting"])) require($templateParams["accountSetting"]) ?></div>
        <div class="tab-pane fade " id="privacy" role="tabpanel" aria-labelledby="privacy-tab"><?php if(isset($templateParams["privacy"])) require($templateParams["privacy"]) ?></div>
    </div>
        </section>
    </div>
</div>
<script>
  window.addEventListener("DOMContentLoaded",function(){
    document.querySelectorAll('Button[data-bs-toggle="tab"]').forEach(el => el.addEventListener("click", function(el) {
       const source = el.target || event.srcElement;
       const triggeredButton = source.nodeName.toLowerCase() == 'button' ? source : source.parentNode;
       localStorage.setItem('activeTab',triggeredButton.getAttribute("data-bs-target"));
    }));
    let activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        document.querySelector('#myTab Button[id="' + activeTab.substring(1) + '-tab"]').classList.add("active");
        document.querySelector('.tab-content div[id="' + activeTab.substring(1) + '"]').classList.add("show","active");
    }
});
</script>