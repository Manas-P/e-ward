// Add Ward Member Modal 
const rejectReq=document.querySelectorAll(".reject");
const closeModal=document.querySelector(".modal-close-btn");
const overlay=document.querySelector(".overlay");
const rejectBox=document.querySelector(".modal-box");

//Reject reg
for (eachRej of rejectReq){
    eachRej.addEventListener("click", () => {
        overlay.classList.remove("modal-hidden");
        rejectBox.classList.remove("modal-hidden");
    });
}


//Close button ward member
closeModal.addEventListener("click",()=>{
    overlay.classList.add("modal-hidden");
    rejectBox.classList.add("modal-hidden");
})

//===============Validation for textarea=====================
const rejectForm=document.querySelector("#reject-form");
const text=document.querySelector("#rejreason");
const wAddBtn=document.querySelector("#rej");
var textflag=false;

text.addEventListener("input",()=>{
    if(text.value==""){
        textflag=false;
    }else{
        textflag=true;
    }
});

const buttonCursor=document.querySelector(".wBtn");//To avoid poniterevent and cursor problem
rejectForm.addEventListener("keyup",()=>{
    if(textflag==true){
        wAddBtn.classList.remove("disabled");
        buttonCursor.classList.remove("cursor-disabled");
    }else{
        wAddBtn.classList.add("disabled");
        buttonCursor.classList.add("cursor-disabled");
    }
});