'use strict'

window.addEventListener('scroll', function(){
        var nav = document.querySelector('.menu')
        nav.classList.toggle('sticky', window.scrollY > 0);
})
