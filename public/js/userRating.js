
const stars = document.querySelectorAll('#user-rating div');
const loceveName = document.getElementById('drawn-text');
const loceve = loceveName.innerText || loceveName.textContent;
let rating = 0;

for (let i = 0; i < stars.length; i++) {
    stars[i].addEventListener('click', function() {
        rating = i + 1;

        fetch('/userRating', {
            method: 'post',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({loceve: loceve, rating: rating})
        })
            .then(function (response){
                console.log( response);
            });

        console.log(loceve);
        let j;
        for (j = 0; j < rating; j++) {
            stars[j].innerHTML = '<img class="star" src="public/img/star_selected.svg">';
        }
        for (; j < 5; j++) {
            stars[j].innerHTML = '<img class="star" src="public/img/star_unselected.svg">';
        }
    });
}