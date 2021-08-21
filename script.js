let icon =document.querySelector('#menu'),
    menu =document.querySelector('#menu-pop'),
    navbar = document.querySelector('.navbar');


icon.addEventListener('click', ()=>{
    console.log("clicked");
    if(menu.style.display=='none'){
        menu.style.display='flex';
        navbar.style.background='#000';
        icon.style.transform='rotate(90deg)';
    }else{
        menu.style.display='none';
        navbar.style.background='rgba(0, 0, 0, 0)';
        icon.style.transform='rotate(0deg)';
    }
})


