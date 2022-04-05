// var balls = document.querySelector('.balls')
// var qntd = document.querySelectorAll('.slides .image, .image-2')
// var atual = 0
// var imagem = document.getElementById('atual')
// var proximo = document.getElementById('proximo')
// var voltar = document.getElementById('voltar')
// var rolar = true

// for(let i = 0; i < qntd.length; i++){
//     var div = document.createElement('div')
//     div.id = i
//     balls.appendChild(div)
// }
// document.getElementById('0').classList.add('imgAtual')

// var posicao = document.querySelectorAll('.balls div')

// for(let i = 0; i < posicao.length; i++){
//     posicao[i].addEventListener('click', function(){
//         atual = posicao[i].id
//         rolar = false
//         slide()
//     })
// }

// voltar.addEventListener('click', () => {
//     atual--
//     rolar = false
//     slide()
// })
// proximo.addEventListener('click', () => {
//     atual++
//     rolar = false
//     slide()
// })

// function slide() {
//     if(atual >= qntd.length){
//         atual = 0
//     }
//     else if(atual < 0){
//         atual = qntd.length-1
//     }
//     document.querySelector('.imgAtual').classList.remove('.imgAtual')
//     imagem.style.marginLeft = -1024*atual+'px'
//     document.getElementById(atual).classList.add('imgAtual')
// }
// setInterval(() => {
//     if(rolar){
//         atual++
//         slide()
//     }else
//         rolar=true
    
// },4000)
