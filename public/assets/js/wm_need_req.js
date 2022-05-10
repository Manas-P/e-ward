// Add Approve Modal 
const approveRequest=document.querySelectorAll(".approve");
const closeModalApp=document.querySelector(".app-close");
const overlay=document.querySelector(".overlay");
const approveBox=document.querySelector(".modal-box-app");

//Approve reg
for (eachRej of approveRequest){
    eachRej.addEventListener("click", () => {
        overlay.classList.remove("modal-hidden");
        approveBox.classList.remove("modal-hidden");
    });
}


//Close button ward member
closeModalApp.addEventListener("click",()=>{
    overlay.classList.add("modal-hidden");
    approveBox.classList.add("modal-hidden");
})

//===============Validation for textarea=====================
const approveForm=document.querySelector("#approve-form");
const reply=document.querySelector("#appreason");
const appBtn=document.querySelector("#app");
var replyflag=false;

reply.addEventListener("input",()=>{
    if(reply.value==""){
        replyflag=false;
    }else{
        replyflag=true;
    }
});

const buttonCursor=document.querySelector(".aBtn");//To avoid poniterevent and cursor problem
approveForm.addEventListener("keyup",()=>{
    if(replyflag==true){
        appBtn.classList.remove("disabled");
        buttonCursor.classList.remove("cursor-disabled");
    }else{
        appBtn.classList.add("disabled");
        buttonCursor.classList.add("cursor-disabled");
    }
});

//Reject need request
// Add Approve Modal 
const rejectRequest=document.querySelectorAll(".reject");
const closeModalRej=document.querySelector(".rej-close");
const rejectBox=document.querySelector(".modal-box-rej");

//Approve reg
for (eachRej of rejectRequest){
    eachRej.addEventListener("click", () => {
        overlay.classList.remove("modal-hidden");
        rejectBox.classList.remove("modal-hidden");
    });
}


//Close button ward member
closeModalRej.addEventListener("click",()=>{
    overlay.classList.add("modal-hidden");
    rejectBox.classList.add("modal-hidden");
})

//===============Validation for textarea=====================
const rejectForm=document.querySelector("#reject-form");
const rejReply=document.querySelector("#rejreason");
const rejBtn=document.querySelector("#rejB");
var rejReplyflag=false;

rejReply.addEventListener("input",()=>{
    if(rejReply.value==""){
        rejReplyflag=false;
    }else{
        rejReplyflag=true;
    }
});

const rejBtnCursor=document.querySelector(".rBtn");//To avoid poniterevent and cursor problem
rejectForm.addEventListener("keyup",()=>{
    if(rejReplyflag==true){
        rejBtn.classList.remove("disabled");
        rejBtnCursor.classList.remove("cursor-disabled");
    }else{
        rejBtn.classList.add("disabled");
        rejBtnCursor.classList.add("cursor-disabled");
    }
});