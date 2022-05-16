'use strict'

const form = document.getElementById('form')
const nome = document.getElementById('nome')
const sobrenome = document.getElementById('sobrenome')
const email = document.getElementById('email')
const senha = document.getElementById('senha')

form.addEventListener("submit", (event) => {
    event.preventDefault();

    checkInputs()
});

function checkInputs() {
    const usernameValue = nome.value;
    const sobrenomeValue = sobrenome.value;
    const emailValue = email.value;
    const senhaValue = senha.value;

    if(usernameValue == ""){
        setErrorFor(nome)
    }
}

function setSucessFor(input) {
    const entradaDados = input.parentElement

    entradaDados.className = "cadastroEntradaDeDados sucesso";
}

function setErrorFor(input) {
    const entradaDados = input.parentElement

    entradaDados.className = "cadastroEntradaDeDados error";
}

