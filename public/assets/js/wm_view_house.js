// Update house
const updateHouse = document.querySelector("#up-house");
const closeModal=document.querySelector(".modal-close-btn");
const overlay=document.querySelector(".overlay");
const upHouseModal = document.querySelector(".modal-box1");
console.log(overlay);
console.log(upHouseModal);

//Add Member
updateHouse.addEventListener("click",()=>{
    overlay.classList.remove("modal-hidden");
    upHouseModal.classList.remove("modal-hidden");
    console.log("hi");
})

//Close button ward member
closeModal.addEventListener("click",()=>{
    overlay.classList.add("modal-hidden");
    upHouseModal.classList.add("modal-hidden");
})


