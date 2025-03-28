
const copyButton = document.getElementById("copy_secret");
const copyDiv = document.getElementById("copyDiv");

function copyToClipboard(item) {
    navigator.clipboard.writeText(item);
}

copyButton.addEventListener("click", function (e){
    var text = e.target.value;
    console.log(text);
    copyToClipboard(text);
})

function showCopyPopup() {
    var popup = document.getElementById("copyPopup");
    popup.classList.toggle("showSmallPopup");
}

copyButton.addEventListener("click", async () =>{
    showCopyPopup();
    setTimeout(showCopyPopup, 2000);
})



