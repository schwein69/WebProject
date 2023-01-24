//se vengono aggiunte prima di fare login, nel momento di log vengono rimosse
if(localStorage.getItem("activeTab") == "#privacy"){
    localStorage.removeItem("activeTab");
    localStorage.removeItem("firstTime");
}