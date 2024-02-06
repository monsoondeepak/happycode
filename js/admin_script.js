let user = document.querySelector('#user-btn');
let profile = document.querySelector('.header .flex .profile');

user.addEventListener('click', function(){
    profile.classList.toggle('active');
})

window.addEventListener('scroll', function(){
    profile.classList.remove('active');
})

let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .flex .navbar');

menu.addEventListener('click', function(){
    navbar.classList.toggle('active');
})


