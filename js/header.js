let boutonNouv = document.getElementsByClassName("bouton-nouv");

boutonNouv.addEventListener("click", function(){
    if (this.classList.contains('active')) {
        this.style.backgroundColor = '#9ED4E7';
        this.querySelector('p').style.color = '#F5F5F5';
        
    } else {
        this.style.backgroundColor = '#F5F5F5';
        this.querySelector('p').style.color = '#757575';
    }
});

/*let logo = document.getElementById("logo");
let recherche = document.getElementById("recherche");
function agrandirBarre(){
    logo.style.display = "none";
}

function afficheLogo(){
    logo.style.display = "block";
}
recherche.addEventListener("click", agrandirBarre);
recherche.addEventListener("blur", afficheLogo);*/
