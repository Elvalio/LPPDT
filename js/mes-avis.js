let bouton_supp = document.getElementById("bouton-supp");

bouton_supp.addEventListener("click", supp_avis);

function supp_avis(event){
    let form = document.getElementById("form-supp");
    let confirmation = confirm("Voulez vous supprimer votre avis ?");
    if (confirmation){
        form.submit();
    }
}