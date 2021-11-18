// Add Ward Member Modal 
const addMember=document.querySelector(".add-member");
const closeModal=document.querySelector(".modal-close-btn");
const overlay=document.querySelector(".overlay");
const modalBox=document.querySelector(".modal-box");

addMember.addEventListener("click",()=>{
    overlay.classList.remove("modal-hidden");
    modalBox.classList.remove("modal-hidden");
})

closeModal.addEventListener("click",()=>{
    overlay.classList.add("modal-hidden");
    modalBox.classList.add("modal-hidden");
})