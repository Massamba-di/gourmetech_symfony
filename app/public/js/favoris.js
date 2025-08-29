const favoris = document.querySelectorAll('svg');

for (const favori of favoris) {
    favori.addEventListener('click', function () {
        if (favori.getAttribute("data-active") === "true") {
            favori.setAttribute("data-active", "false");
            favori.style.fill = "gray";
        } else {
            favori.setAttribute("data-active", "true");
            favori.style.fill = "red";

            const article = favori.closest('article');

            if (article) {
                const favoriData = {
                    id: article.dataset.id,
                    nom: article.dataset.nom,
                    image: article.dataset.image,
                    prix: article.dataset.prix,
                    categorie: article.dataset.categorie,
                    temps: article.dataset.temps,
                    difficulte: article.dataset.difficulte
                };


                // LocalStorage
                let favorisStockes = JSON.parse(localStorage.getItem("favoriData")) || [];

                // Évite les doublons
                if (!favorisStockes.some(f => f.id === favoriData.id)) {
                    favorisStockes.push(favoriData);
                    localStorage.setItem("favoriData", JSON.stringify(favorisStockes));
                    alert("Recette ajoutée aux favoris !");
                } else {
                    alert("Cette recette est déjà dans vos favoris !");
                }
            }
        }
    });
}
