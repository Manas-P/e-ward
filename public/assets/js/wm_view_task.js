// Add Ward Member Modal 
const addmember=document.querySelector(".add-member");
const closeModalmember=document.querySelector(".pre-cls-btn");
const overlay=document.querySelector(".overlay");
const memberBox=document.querySelector(".modal-box2");

//Add member
addmember.addEventListener("click",()=>{
    overlay.classList.remove("modal-hidden");
    memberBox.classList.remove("modal-hidden");
})

//Close button member
closeModalmember.addEventListener("click",()=>{
    overlay.classList.add("modal-hidden");
    memberBox.classList.add("modal-hidden");
})