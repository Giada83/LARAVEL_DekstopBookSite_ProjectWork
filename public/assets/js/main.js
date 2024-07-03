// navbar che cambia colore con altezza calcolata automaticamente
document.addEventListener("DOMContentLoaded", function () {
    var navbar = document.querySelector(".custom-navbar");
    var body = document.querySelector("body");
    body.style.paddingTop = navbar.offsetHeight + "px";

    window.addEventListener("scroll", function () {
        if (window.scrollY > 0) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    });
});
