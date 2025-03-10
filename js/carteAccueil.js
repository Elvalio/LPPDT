document.addEventListener('DOMContentLoaded', function () {

    const fleche = document.getElementById("arrow_carte")

    // fleche.addEventListener("click", function () {
    //     document.getElementById("map").scrollIntoView({ behavior: "smooth" })
    // });
    const mapContainer = document.getElementById("map");

    // mapContainer.style.transition = "max-height 0.5s ease-out";
    // mapContainer.style.overflow = "hidden";
    // mapContainer.style.maxHeight = "0";

    fleche.addEventListener("click", function () {
        mapContainer.classList.toggle("cache");
    });


    var map = L.map('map').setView([48.7321, -3.4591], 14);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

});

export default map;