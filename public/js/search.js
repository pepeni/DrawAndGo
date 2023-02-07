const search = document.querySelector('input[placeholder="search loceve"]');
const loceveContainer = document.querySelector("#records");

search.addEventListener("keyup", function (event) {
    if(event.key === "Enter"){
        event.preventDefault();

        const data = {search: this.value};

        fetch("/search", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response){
            return response.json();
        }).then(function (loceves) {
            loceveContainer.innerHTML = "";
            loadLoceves(loceves);
        })
    }
});

function loadLoceves(loceves) {
    loceves.forEach(loceve => {
        console.log(loceve);
        createLoceve(loceve);
    })
}

function createLoceve(loceve) {

    const template = document.querySelector("#loceve-template");

    const clone = template.content.cloneNode(true);

    const image = clone.querySelector("img");
    image.src = 'public/uploads/' + loceve.image;

    const name = clone.querySelector("#record-name");
    name.innerHTML = loceve.name;

    const price = clone.querySelector("#price-div");
    priceHtml = '';
    for (let i = 0; i < loceve.price; i++){
        priceHtml = priceHtml + '<img src="public/img/coin.svg" id="price-img">';
    }
    price.innerHTML = priceHtml;

    const link = clone.querySelector("a");
    link.href = "/drawn?loceve=" + loceve.name;

    const iWasThere = clone.querySelector("#i-was-there");
    if (loceve.id_user !== null){
        iWasThere.id = 'i-was-there'
    }
    else{
        iWasThere.id = 'i-was-not-there'
    }

    const communityRating = clone.querySelector("#community-rating");
    ratingHtml = '';
    let i = 0;
    for (i = 0; i < +(loceve.rating); i++){
        ratingHtml = ratingHtml + '<div><img class="star-selected" src="public/img/star_selected.svg"></div>';
    }
    for(;i < 5; i++){
        ratingHtml = ratingHtml + '<div><img class="star-unselected" src="public/img/star_unselected.svg"></div>';
    }
    communityRating.innerHTML = ratingHtml;


    loceveContainer.appendChild(clone);

}