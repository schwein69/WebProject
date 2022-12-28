
document.getElementById("thumb").addEventListener("dblclick", function (e) {
    document.getElementById("image").click();
});

document.querySelector("input[type='file']").addEventListener("change", function (event) {
    document.getElementById("thumb").src = URL.createObjectURL(event.target.files[0]);
});

