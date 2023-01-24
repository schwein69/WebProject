window.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('Button[data-bs-toggle="tab"]').forEach(el => el.addEventListener("click", function (el) {
        const source = el.target || event.srcElement;
        const triggeredButton = source.nodeName.toLowerCase() == 'button' ? source : source.parentNode;
        localStorage.setItem('activeTab', triggeredButton.getAttribute("data-bs-target"));
    }));
    let activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
        document.querySelector('#myTab Button[id="' + activeTab.substring(1) + '-tab"]').classList.add("active");
        document.querySelector('.tab-content div[id="' + activeTab.substring(1) + '"]').classList.add("show", "active");
    }
});

