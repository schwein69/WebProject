//add tags
let numTag = 8 - tagOffset;
const tagSelector = document.querySelector("fieldset div.row");
const tagButton = document.querySelector("fieldset div.row:last-child button");

tagButton.addEventListener('click',event => {
    event.preventDefault();
    if(numTag > 0) {
        const elem = document.createElement('input');
        elem.ariaLabel = "Tag "+ (10-numTag);
        elem.type = "text";
        elem.id="tag"+ (10 - numTag);
        elem.name="tag"+ (10 - numTag);
        elem.classList.add('col-12');
        elem.classList.add('col-md-2');
        elem.classList.add('m-1');
        tagSelector.appendChild(elem);
        const labelEl = document.createElement('label');
        labelEl.setAttribute('for','tag'+(10-numTag))
        labelEl.classList.add('invisibleLabel');
        labelEl.innerHTML = "Tag " + (10-numTag);
        tagSelector.appendChild(labelEl);
        numTag--;
    }
    if(numTag <= 0) {
        tagButton.style.display='none';
    }

});

//add images
let numImg=2;
const imgSelector = document.querySelectorAll("fieldset > div > div.row:last-child")[1];
const imgButton = document.querySelectorAll("fieldset div.row:last-child button")[1];

imgButton.addEventListener('click',event => {
    event.preventDefault();
    if(numImg < 10) {

        const newNode = document.createElement('div');
        const elem = 
                      '<label for="f' + numImg + '" class="invisibleLabel">File' + numImg + '</label>'
                    +  '<input aria-label="File ' + numImg + '" class="col-6" type="file" id="f' + numImg
                    + '" name="f' + numImg + '" accept="video/*,image/*"/>'
                    + '<div class="row my-2">'
                    + '<label class="col-3" for="alt' + numImg + '">Testo alternativo:</label>'
                    + '<input aria-label="Testo alternativo per immagine ' + numImg + '" class="col-12 col-6" type="text" id="alt' + numImg
                    + '" name="alt' + numImg + '"/>'
                    + '</div>';

        newNode.innerHTML = elem;
        newNode.classList.add('row');
        newNode.classList.add('my-2');
        newNode.classList.add('p-3');
        
        imgSelector.parentNode.insertBefore(newNode, imgSelector);
        numImg++;
        window.scrollTo(0, document.body.scrollHeight);
    } else {
        imgButton.setAttribute('style', 'display:none !important;');
    }
});


function isTextEmpty() {
    return document.getElementById('testo').value.length == 0;
}

function areThereImages() {
    for(let i = 1; i<10; i++){
        const imgTag = document.getElementById('f' + i);
        if(imgTag != null && imgTag.value.length != 0){
               return true;
        }
    }
    return false;
}

const submitButton = document.querySelector('form input[type="submit"]');
const errMsgTags = document.querySelector('fieldset .errmsg');
const errMsgAltText = document.querySelectorAll('fieldset .errmsg')[1];
const errManyMedia = document.querySelectorAll('fieldset .errmsg')[2];
submitButton.addEventListener('click', event => {
    event.preventDefault();
    let canSub = true;
    //minimal data to create post check
    if(isTextEmpty() && !areThereImages()) {
        document.querySelector('.errmsg').setAttribute('style','display:block');
        canSub = false;
    } else {
        document.querySelector('.errmsg').removeAttribute('style');
    }

    //tags check
    let showTagMsg = false;
    for(let i=1; i < (10-numTag); i++){
        if(areThereDangerousChars(document.getElementById('tag' + i).value)){
            canSub = false;
            showTagMsg = true;
        }
    }
    if(showTagMsg){
        errMsgTags.setAttribute('style', 'display:block');
    } else {
        errMsgTags.removeAttribute('style');
    }

    let showAltMsg = false;
    for(let i=1; i < numImg; i++){
        if(areThereDangerousChars(document.getElementById('alt' + i).value)){
            canSub = false;
            showAltMsg = true;
        }
    }
    if(showAltMsg){
        errMsgAltText.setAttribute('style', 'display:block');
    } else {
        errMsgAltText.removeAttribute('style');
    }
    
    //check medias < 10
    const checkBoxElements = document.querySelectorAll('input[type="checkbox"]');
    let numMedia = 0;
    for(let i=0;i<checkBoxElements.length;i++){
        if(!checkBoxElements[i].checked){
            numMedia++;
        }
    }
    for(let i=1; i < numImg; i++){
        if(document.getElementById('f'+i).files[0] != null){
            numMedia++;
        }
    }
    if(numMedia >= 10){
        canSub = false;
        errManyMedia.setAttribute('style','display:block');
    } else{
        errManyMedia.removeAttribute('style');
    }

    if(canSub){
        document.querySelector('form').submit();
    }
});

