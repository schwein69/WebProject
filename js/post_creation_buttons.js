//TODO try using classes for incapsulation
let numTag=8;
const tagSelector = document.querySelector("fieldset div.row");
const tagButton = document.querySelector("fieldset div.row:last-child button");

tagButton.addEventListener('click',event => {
    event.preventDefault();
    console.log('click');
    if(numTag > 0) {
        const elem = document.createElement('input');
        elem.ariaLabel = "Tag "+ (10-numTag);
        elem.type = "text";
        elem.id="tag"+ (10 - numTag);
        elem.name="tag"+ (10 - numTag);
        elem.classList.add('col-2');
        elem.classList.add('m-1');
        //tagSelector.innerHTML = tagSelector.innerHTML + elem;
        tagSelector.appendChild(elem);
        numTag--;
        console.log('added');
        console.log(elem);
    } else {
        tagButton.style.display='none';
    }
});

let numImg=2;
const imgSelector = document.querySelectorAll("fieldset div.row:last-child")[1];
const imgButton = document.querySelectorAll("fieldset div.row:last-child button")[1];

imgButton.addEventListener('click',event => {
    event.preventDefault();
    if(numImg < 10) {

        const newNode = document.createElement('div');
        const elem = '<input aria-label="Immagine ' + numImg + '" class="col-6" type="file" id="f' + numImg
                    + '" name="f' + numImg + '" accept="video/*,image/*"/>'
                    + '<label class="col-3" for="alt1">Testo alternativo:</label>'
                    + '<input aria-label="Testo alternativo per immagine ' + numImg + '" class="col-3" type="text" id="alt' + numImg
                    + '" name="alt' + numImg + '"/>';

        newNode.innerHTML = elem;
        newNode.classList.add('row');
        newNode.classList.add('my-1');
        
        imgSelector.parentNode.insertBefore(newNode, imgSelector);
        numImg++;
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
submitButton.addEventListener('click', event => {
    event.preventDefault();
    if(!isTextEmpty() || areThereImages()) {
        document.querySelector('form').submit();
    }else{
        document.getElementById('errMsg').setAttribute('style','');
    }
});