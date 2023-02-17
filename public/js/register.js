const form = document.querySelector("form");
const emailInput = form.querySelector('input[name="email"]');
const passwordInput = form.querySelector('input[name="password"]')
const nickInput = form.querySelector('input[name="nick"]');

function isEmail(email){
    return /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(email);
}

function isPassword(password){
    return /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/.test(password);
}

function isNick(nick){
    return /[A-Za-z\d]{5,64}$/.test(nick);
}

function markValidation(element, condition) {
    !condition ? element.classList.add("no-valid") : element.classList.remove("no-valid");
}

function validateEmail (){
    setTimeout(
        function(){
            markValidation(emailInput, isEmail(emailInput.value));
        },
        1500);
}

emailInput.addEventListener('keyup', validateEmail);

function validatePassword(){
    setTimeout(
        function(){
            markValidation(passwordInput, isPassword(passwordInput.value));
        },
        1500);
}

passwordInput.addEventListener('keyup', validatePassword);

function validateNick(){
    setTimeout(
        function(){
            markValidation(nickInput, isNick(nickInput.value));
        },
        1500);
}

nickInput.addEventListener('keyup', validateNick);