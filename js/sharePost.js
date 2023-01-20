delegate_event('click', document, 'button.sharePostButton', sharePost);
delegate_event('click', document, 'button.confirmShareButton', check);
delegate_event('click', document, 'button.showMoreFriendButton', showMoreFriends);

let selectedFriends = null;
let postIdToShare = null;
let actualCountOfFriendList = 0;//contatore lista amici da zero ogni volta che compare pop up

function getCheckboxesValues() {//get array of user id to share
    return [].slice.apply(document.querySelectorAll("div.center-container2 input[type=checkbox]"))
        .filter(function (c) { return c.checked; })
        .map(function (c) { return c.value; });
}

function showMoreFriends() {
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        const friends = JSON.parse(this.responseText);
        let list = [];
        friends.forEach(element => {
            const singleElement = document.createElement("div");
            singleElement.classList.add("row");
            singleElement.classList.add("mt-2");
            singleElement.innerHTML = `<div class="col-4">
            <img class="img-fluid friendListAvatar" src="../imgs/uploads/`+ element["idUtente"] + `/profile.` + element["formatoFotoProfilo"] + `" alt="` + element["profilePicAlt"] + `">
            </div>
            <div class="col-4">
               <h2 style="font-size: medium">`+ element["username"] + `</h2>
            </div>
            <div class="col-4">     
                 <input class="col-6" type="checkbox" name="chb" value="`+element["idUtente"]+`" />
            </div>`;
            list.push(singleElement);
        });
        const insertArea = document.querySelector("div.insertHereFriendList");
        list.forEach(element => {
            insertArea.insertAdjacentElement("beforeend", element);
        });
        actualCountOfFriendList += list.length;//update length.
        if(list.length == 0){
            document.querySelector("button.showMoreFriendButton").disabled = true;  
        }
    };
    xhttp.open("POST", "event_showMoreFriends.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("actualCountOfFriendList=" + actualCountOfFriendList);
}

function check(event) {
    event.preventDefault();
    const source = event.target || event.srcElement;
    const selectButton = source.nodeName.toLowerCase() == 'button' ? source : source.parentNode;
    const selected = selectButton.value;//si o no
    if (selected === "yes" && getCheckboxesValues().length > 0) {//se seleziono si e la lista non è nullo allora condivido
        selectedFriends = getCheckboxesValues();
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            selectedFriends = null; //pulisco la lista
        };
        xhttp.open("POST", "event_sharepost.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("friendList=" + selectedFriends + "&postIdToShare=" + postIdToShare);//invio lista amici

    } else if (selected === "yes" && getCheckboxesValues().length <= 0) {
        document.querySelector(".feedback-area").innerHTML = document.documentElement.lang == "en" ? "You must select at least one friend!" : "Devi scegliere almeno un amico!";
        return;
    }
    document.querySelector(".feedback-area").innerHTML = "";
    hideBoxAndReactivateScroll("center-container2");
    actualCountOfFriendList = 0;
    document.querySelector("div.insertHereFriendList").innerHTML="";
}

function sharePost(event) {
    event.preventDefault();
    const source = event.target || event.srcElement;
    const sharePostButton = source.nodeName.toLowerCase() == 'button' ? source : source.parentNode;
    postIdToShare = sharePostButton.value;//id del post
    showMoreFriends();//mostra 5 amici la prima volta
    document.querySelector("button.showMoreFriendButton").disabled = false;  
    showBoxAndDeactivateScroll("center-container2");
}
