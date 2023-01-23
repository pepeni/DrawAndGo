const search = document.querySelector('input[placeholder="search lockeve"]');
const lockeveContainer = document.querySelector("#records");

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
        }).then(function (lockeves) {
            lockeveContainer.innerHTML = "";
            loadLockeves(lockeves);
        })
    }
});

function loadLockeves(lockeves) {
    lockeves.forEach(lockeve => {
        console.log(lockeve);
        createLockeve(lockeve);
    })
}

function createLockeve(lockeve) {
    const template = document.querySelector("#lockeve-template");

    const clone = template.content.cloneNode(true);

    const image = clone.querySelector("img");
    image.src = 'public/uploads/' + lockeve.image;

    const name = clone.querySelector("#record-name");
    name.innerHTML = lockeve.name;

    const price = clone.querySelector("#price-div");
    priceHtml = '';
    for (let i = 0; i < lockeve.price; i++){
        priceHtml = priceHtml + '<img src="public/img/coin.svg" id="price-img">';
    }
    price.innerHTML = priceHtml;

    const link = clone.querySelector("a");
    link.href = "/drawn?lockeve=" + lockeve.name;


    lockeveContainer.appendChild(clone);

}