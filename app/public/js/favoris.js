const favoris = document.querySelectorAll('svg');

for (const favori of favoris) {
    favori.addEventListener('click', function () {
        // Toggle la couleur
        if (favori.getAttribute("data-active") === "true") {
            favori.setAttribute("data-active", "false");
            favori.style.fill = "gray";
        } else {
            favori.setAttribute("data-active", "true");
            favori.style.fill = "red";

            // On remonte jusqu'à l'article parent du SVG
            const article = favori.closest("article");

            if (article) {
                const articleId = article.getAttribute("data-id"); // mets un data-id dans ton twig
                const articleNom = article.getAttribute("data-nom");

                // On crée un objet favori
                const favoriData = { id: articleId, nom: articleNom };

                // On récupère les favoris déjà dans le localStorage
                let favorisStockes = JSON.parse(localStorage.getItem("favoris")) || [];

                // On ajoute le nouveau favori
                favorisStockes.push(favoriData);

                // On sauvegarde
                localStorage.setItem("favoris", JSON.stringify(favorisStockes));

                alert("Recette ajouté aux favoris !");
            }
        }
    });
}

