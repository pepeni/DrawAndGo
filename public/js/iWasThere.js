
function iWasThere(e, loceve) {

    e.preventDefault();

    fetch('/iWasThere', {
        method: 'post',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({loceve: loceve})
    })
        .then(response => response.text());

    const button = e.target;
    if(button.id === "i-was-not-there"){
        button.id = "i-was-there"
    }
    else{
        button.id = "i-was-not-there"
    }

}