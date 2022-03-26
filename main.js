'use strict'

const db = [
    {
        id: 1, 
        nome: 'Cappcucino', 
        descricao: "Café com um pouco de leite e chantilly",   
        preco: "8,99", 
        pagar: 'Comprar',
        imagem: './IMG/aroma-g75f55fd62_640-removebg-preview (2).png'
    },
    {
        id: 2, 
        nome: 'Mocha', 
        descricao: "Café com chocolate, leite e chantilly",  
        preco: "8,99", 
        pagar: 'Comprar',
        imagem: './IMG/4180387404_d8b37e0d8f_b-removebg-preview.png'
    },
    {
        id: 3, 
        nome: 'Latte', 
        descricao: "Café com muito leite e pouco chantilly", 
        preco: "8,99", 
        pagar: 'Comprar',
        imagem: './IMG/flat-removebg-preview.png'
    },
    {
        id: 4, 
        nome: 'Dupllo', 
        descricao: "Café preto",  
        preco: "8,99", 
        pagar: 'Comprar',
        imagem: './IMG/coffee-g833b1f2bb_640-removebg-preview.png'
    },
    {
        id: 5, 
        nome: 'Machiatto', 
        descricao: "Café com Chantilly",   
        preco: "8,99",
        pagar: 'Comprar',
        imagem: 'IMG/macchiato-2033544_1280-removebg-preview.png'
    },
    {
        id: 6, 
        nome: 'Café Expresso', 
        descricao: "Café com dose dupla",  
        preco: "8,99",
        pagar: 'Comprar',
        imagem: 'IMG/2017-08-06-08-58-31-removebg-preview.png'
    }
]

const criarCard = (produto) => {
    const card = document.createElement('div');
    card.classList.add('card')
    card.innerHTML = `
    <div class="card-image-container">
                    <img src="${produto.imagem}" alt="monitor" class="card-image">
                </div>
                <span class="card-produto">
                    ${produto.descricao}
                </span>
                <span class="card-preco">
                    R$ ${produto.preco}
                </span>
                <button class="card-pagar">
                    ${produto.pagar}
                </button>
    `

    return card;
}

const carregarProdutos = (produtos) => {
    const container = document.querySelector('.card-container')
    const cards = produtos.map(criarCard)

    container.replaceChildren(...cards)
}

carregarProdutos(db)