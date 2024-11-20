const menuButton = document.getElementById('menuButton');
const menu = document.getElementById('menu');
const closeButton = document.getElementById('closeButton');
const filters = document.getElementById('filters');

menuButton.addEventListener('click', () => {
    menu.style.left = '0';
    filters.classList.toggle('hide');

});

closeButton.addEventListener('click', () => {
    menu.style.left = '-273px';
});
