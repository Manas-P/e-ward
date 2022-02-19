//Toggle active menu

const sections = document.querySelectorAll(".section");
const navLinks = document.querySelectorAll(".menu .links a");

window.addEventListener('scroll', ()=>{
    let current = '';
    sections.forEach(section=>{
        const sectionTop = section.offsetTop;
        const sectionHeight = section.clientHeight;
        if(pageYOffset > sectionTop-260){
            current = section.getAttribute('id');
        }
    })
    console.log(current);
    navLinks.forEach(link=>{
        link.classList.remove('active');
        if(link.classList.contains(current)){
            link.classList.add('active');
        }
    })
})