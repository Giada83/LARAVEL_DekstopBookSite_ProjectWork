// navbar che cambia colore
document.addEventListener("DOMContentLoaded", function () {
    var navbar = document.querySelector(".custom-navbar");

    window.addEventListener("scroll", function () {
        if (window.scrollY > 0) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    });
});

// bottone 'reset' che ripristina la ricerca dei libri
function resetForm() {
    //otteniamo l'url tramite l'oggetto URL di js
    const url = new URL(window.location.href);
    //svuotiamo il parametro dell'url
    url.search = "";
    //ripristina l'url iniziale
    window.location.href = url.toString();
}
