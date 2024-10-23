let logo = document.getElementById("logo");
let recherche = document.getElementById("recherche");
function agrandirBarre(){
    logo.style.display = "none";
}

function afficheLogo(){
    logo.style.display = "block";
}
recherche.addEventListener("click", agrandirBarre);
recherche.addEventListener("blur", afficheLogo);
