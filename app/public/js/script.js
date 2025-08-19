const button = document.querySelector('#btn');
button.addEventListener('click', function (event) {
    event.preventDefault();
    const search = document.getElementById('inputsearch').value.toLowerCase().trim();
    const articles = document.querySelectorAll('article[data-nom]');



    for (let article of articles) {
        const articleNom = article.getAttribute('data-nom').toLowerCase().trim();


        if (articleNom.includes(search) || search === '') {
            article.style.setProperty('display', 'flex', 'important');

        } else {
            article.style.setProperty('display', 'none', 'important');

        }
    }
});


