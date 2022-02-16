//Toggle active menu
const links = document.querySelectorAll(".menu .links a");
links.forEach((eachLink)=>{
    eachLink.addEventListener("click",()=>{
        document.querySelector(".menu .links a.active").classList.remove("active");
        eachLink.classList.add("active");
    })
})
