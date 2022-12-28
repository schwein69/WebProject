const settingsBtn = document.getElementById('settingsButton');
if(settingsBtn != null){
    settingsBtn.addEventListener('click', event => window.location.href='../src/settings.php');
}

const newpostBtn = document.getElementById('newpostButton');
if(newpostBtn != null){
        newpostBtn.addEventListener('click', event => window.location.href='../src/new_post.php');
}

const notifBtn = document.getElementById('notifButton');
if(notifBtn != null){
        notifBtn.addEventListener('click', event => window.location.href='../src/notifications.php');
}

