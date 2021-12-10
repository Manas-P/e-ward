//===================Alert Box Close====================
const alertt=document.querySelector(".alertt");
const alertClose=document.querySelector(".alert-close");

// regSubBtn.addEventListener("click",()=>{
//     alertt.classList.remove("alert-hidden");
//     alertt.classList.add("alert-visible");
//     console.log("submit");
// });

alertClose.addEventListener("click",()=>{
    alertt.classList.remove("alert-visible");
    alertt.classList.add("alert-hidden");
});