const settingsBtn = document.getElementById('settingsButton');
if (settingsBtn != null) {
        settingsBtn.addEventListener('click', event => window.location.href = '../src/settings.php');
}

const newpostBtn = document.getElementById('newpostButton');
if (newpostBtn != null) {
        newpostBtn.addEventListener('click', event => window.location.href = '../src/new_post.php');
}

const notifBtn = document.getElementById('notifButton');
if (notifBtn != null) {
        notifBtn.addEventListener('click', event => window.location.href = '../src/notifications.php');
}

const cookieBar = document.getElementById('cookiebar');
if (cookieBar != null) {
        cookieBar.querySelector('button').addEventListener('click', event => {
                cookieBar.setAttribute('style', 'display:none;');
                document.cookie = "Lynkzone_firstVisit=firstVisit";
        });
}

const cookieHref = document.querySelector("#cookiebar p a");
if (cookieHref != null) {
        cookieHref.addEventListener('click', event => { 
                localStorage.setItem('activeTab', "#privacy");
                localStorage.setItem('firstTime', "false");
        });
       /* if(document.querySelector('#myTab Button[id="privacy-tab"]') != null && localStorage.getItem("activeTab") != null && localStorage.getItem('firstTime') == null){
                document.querySelector('#myTab Button[id="privacy-tab"]').classList.add("active");
                document.querySelector('.tab-content div[id="privacy"]').classList.add("show", "active");
               
        }*/
}
//default first time
if(document.querySelector('#myTab Button[id="profile-tab"]')!=null){
        if(localStorage.getItem('firstTime') == null){
                localStorage.setItem('activeTab', "#profile");
                document.querySelector('#myTab Button[id="profile-tab"]').classList.add("active");
                document.querySelector('.tab-content div[id="profile"]').classList.add("show", "active");
                localStorage.setItem('firstTime', "false");
        }
}


