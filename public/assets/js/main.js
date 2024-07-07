// A. navbar che cambia colore
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

// B. bottone 'reset' che ripristina la ricerca dei libri
function resetForm() {
    //otteniamo l'url tramite l'oggetto URL di js
    const url = new URL(window.location.href);
    //svuotiamo il parametro dell'url
    url.search = "";
    //ripristina l'url iniziale
    window.location.href = url.toString();
}

// C. 'x' all'interno della barra di ricerca in books.index
const clearIcon = document.querySelector(".clear-icon");
const searchInput = document.getElementById("search");

clearIcon.addEventListener("click", function () {
    searchInput.value = "";
});

// D: form invio recensioni con stelle dinamiche
document.addEventListener("DOMContentLoaded", (event) => {
    const stars = document.querySelectorAll(".rating label");

    stars.forEach((star) => {
        star.addEventListener("click", function () {
            const ratingValue = this.getAttribute("data-value");
            document.querySelector('input[name="rating"]').value = ratingValue;

            // Rimuovi la classe 'selected' da tutte le stelle
            stars.forEach((s) => s.classList.remove("selected"));

            // Aggiungi la classe 'selected' alla stella cliccata e a tutte le stelle precedenti
            this.classList.add("selected");
            const previousSiblings = getPreviousSiblings(this);
            previousSiblings.forEach((sibling) =>
                sibling.classList.add("selected")
            );
        });
    });

    function getPreviousSiblings(element) {
        const siblings = [];
        let prev = element.previousElementSibling;
        while (prev) {
            siblings.unshift(prev);
            prev = prev.previousElementSibling;
        }
        return siblings;
    }
});
