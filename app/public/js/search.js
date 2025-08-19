const formulaire = document.getElementById('formulaire');
const articles = document.querySelectorAll('article[data-nom]');
const inputCategories = document.querySelectorAll('input[name=categories]');
const inputTemps = document.querySelectorAll('input[name=tempsDePreparation]');
const inputDifficulte = document.querySelectorAll('input[name=difficulte]');

function filtreAppliquer() {
    const categoriesSelectionnees = Array.from(inputCategories)
        .filter(input => input.checked)
        .map(input => input.value);
    const tempsSelectionnes = Array.from(inputTemps)
        .filter(input => input.checked)
        .map(input => input.value);
    const difficultesSelectionnees = Array.from(inputDifficulte)
        .filter(input => input.checked)
        .map(input => input.value);

    // Parcourir tous les articles
    for (const article of articles) {
        let doitEtreAffiche = true;

        // Vérifier les catégories si des filtres sont sélectionnés
        if (categoriesSelectionnees.length > 0) {
            const categorieArticle = article.dataset.categorie || article.getAttribute('data-categorie');
            doitEtreAffiche = doitEtreAffiche && categoriesSelectionnees.includes(categorieArticle);
        }

        // Vérifier le temps de préparation si des filtres sont sélectionnés
        if (tempsSelectionnes.length > 0 && doitEtreAffiche) {
            const tempsArticle = article.dataset.temps || article.getAttribute('data-temps');
            doitEtreAffiche = doitEtreAffiche && tempsSelectionnes.includes(tempsArticle);
        }

        // Vérifier la difficulté si des filtres sont sélectionnés
        if (difficultesSelectionnees.length > 0 && doitEtreAffiche) {
            const difficulteArticle = article.dataset.difficulte || article.getAttribute('data-difficulte');
            doitEtreAffiche = doitEtreAffiche && difficultesSelectionnees.includes(difficulteArticle);
        }

        // Afficher ou cacher l'article
        if (doitEtreAffiche) {
            article.style.setProperty("display", "block", "important");
        } else {
            article.style.setProperty("display", "none", "important");
        }
    }
}

// Fonction pour réinitialiser les filtres
function reinitialiserFiltres() {
    // Décocher tous les checkboxes
    [...inputCategories, ...inputTemps, ...inputDifficulte].forEach(input => {
        input.checked = false;
    });

    // Afficher tous les articles
    articles.forEach(article => {
        article.style.setProperty("display", "block", "important");
    });
}

// Écouter les changements sur les checkboxes pour un filtrage en temps réel
[...inputCategories, ...inputTemps, ...inputDifficulte].forEach(input => {
    input.addEventListener('change', filtreAppliquer);
});

formulaire.addEventListener('submit', (event) => {
    event.preventDefault();
    filtreAppliquer();
});

// Optionnel : ajouter un bouton de réinitialisation
const boutonReset = document.getElementById('reinitialiserFiltres'); // Si vous avez un bouton reset
if (boutonReset) {
    boutonReset.addEventListener('click', reinitialiserFiltres);
}
