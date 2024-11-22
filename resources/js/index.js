var menuBtn = document.getElementById('menuBtn');
var navbar = document.getElementById('side-nav');
var menu = document.getElementById('menu');

menuBtn.addEventListener('click', () => {
    if (navbar.style.right == '-100%') {
        navbar.style.right = '0';
        menu.src = 'src/close.png';
    } else {
        navbar.style.right = '-100%';
        menu.src = 'src/menu.png';
    }
});

document.addEventListener("DOMContentLoaded", function() {
    navbar.style.right = '-100%';
});

// smooth scroll code
var scroll = new SmoothScroll('a[href*="#"]', {
    speed: 1000,
    speedAsDuration: true
});

const openbtn = document.getElementById("banner-btn");
const skipbtn = document.getElementById("Skipbtn");
const popup = document.getElementById("popup");

openbtn.addEventListener("click", () => {
    popup.classList.add("open");
});

skipbtn.addEventListener("click", () => {
    popup.classList.remove("open");
});