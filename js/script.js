const hamburger = document.querySelector('.hamburger');
const overlay = document.querySelector('.overlay');
const sidebar = document.querySelector('.sidebar');
const closebtn = document.querySelector('.close-btn');

const aramamobileayar = document.querySelector('.aramamobileayar');
const aramaover = document.querySelector('.aramaover');
const sagkapsayici = document.querySelector('.sagkapsayici');
const sidebararama = document.querySelector('.sidebararama');
const aramakapat = document.querySelector('.aramakapat');



hamburger.addEventListener('click', () => {
    sidebar.classList.add('sidebar-anim');
    overlay.classList.add('overlay-anim');
})

closebtn.addEventListener('click', () => {
    sidebar.classList.remove('sidebar-anim');
    overlay.classList.remove('overlay-anim');
})

overlay.addEventListener('click', () => {
    sidebar.classList.remove('sidebar-anim');
    overlay.classList.remove('overlay-anim');
});

aramamobileayar.addEventListener('click', () => {
    aramaover.classList.add('arama-siyah');
    sidebararama.classList.add('arama-goster');
})

aramakapat.addEventListener('click', () => {
    aramaover.classList.remove('arama-siyah');
    sidebararama.classList.remove('arama-goster');
})

sagkapsayici.addEventListener('click', () => {
    aramaover.classList.remove('arama-siyah');
    sidebararama.classList.remove('arama-goster');
})






