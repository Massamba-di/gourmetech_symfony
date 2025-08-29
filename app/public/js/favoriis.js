// Récupération des favoris depuis localStorage
let favoris = JSON.parse(localStorage.getItem('favoriData')) || [];


function getFavori() {


const container = document.querySelector('#liste-favoris');

// Sélection du template
const template = document.querySelector('#favoris-template');
 container.innerHTML = '';
    if (favoris.length === 0) {
        container.innerHTML = "<p>Votre panier est vide.</p>";

        return;
    }


// Parcours des favoris
for (let favori of favoris) {
    // Clone du template
    const clone = template.content.cloneNode(true);

    // Remplissage des données
    clone.querySelector('.img-recette').src = favori.image;
    clone.querySelector('.img-recette').alt = favori.nom;
    clone.querySelector('.nom-recette').textContent = favori.nom;
    clone.querySelector('.prix-recette').textContent = favori.prix;
    clone.querySelector('.categories').textContent = favori.categorie;
    clone.querySelector('.temps').textContent = favori.temps;
    clone.querySelector('.difficulte').textContent = favori.difficulte;



    // Ajout dans le container
    container.appendChild(clone);
}
}
getFavori()
