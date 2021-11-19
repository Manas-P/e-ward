// Add Ward Member Modal 
const addMember=document.querySelector(".add-member");
const addpresident=document.querySelector(".add-president");
const closeModal=document.querySelector(".modal-close-btn");
const closeModalPresident=document.querySelector(".pre-cls-btn");
const overlay=document.querySelector(".overlay");
const memberBox=document.querySelector(".modal-box");
const presidentBox=document.querySelector(".modal-box2");

//Add Member
addMember.addEventListener("click",()=>{
    overlay.classList.remove("modal-hidden");
    memberBox.classList.remove("modal-hidden");
})

//Add president
addpresident.addEventListener("click",()=>{
    overlay.classList.remove("modal-hidden");
    presidentBox.classList.remove("modal-hidden");
})

//Close button ward member
closeModal.addEventListener("click",()=>{
    overlay.classList.add("modal-hidden");
    memberBox.classList.add("modal-hidden");
})

//Close button ward member
closeModalPresident.addEventListener("click",()=>{
    overlay.classList.add("modal-hidden");
    presidentBox.classList.add("modal-hidden");
})

//Validation