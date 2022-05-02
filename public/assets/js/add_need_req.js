// Add need request Modal 
const addNeedReqBtn=document.querySelector(".add-req");
const closeModal=document.querySelector(".modal-close-btn");
const overlay=document.querySelector(".overlay");
const requestBox=document.querySelector(".modal-box");

//Add need request
addNeedReqBtn.addEventListener("click",()=>{
    overlay.classList.remove("modal-hidden");
    requestBox.classList.remove("modal-hidden");
})

//Close button
closeModal.addEventListener("click",()=>{
    overlay.classList.add("modal-hidden");
    requestBox.classList.add("modal-hidden");
})

//Validation
const reqDes=document.querySelector("#req-des");
const file = document.querySelector("#reqFile");
const addNeedReqForm = document.querySelector("#add-need-req");
const addReq=document.querySelector("#add-req");

//Error Message Class
const reqDesError=document.querySelector(".reqDes .error");
const fileError = document.querySelector(".reqFile .error");
var reqDesSubmit=false;
var fileSubmit = false;

//Textarea validation
reqDes.addEventListener("input",()=>{
    if (reqDes.value == "") {
        reqDesError.classList.add("error-visible");
        reqDesError.classList.remove("error-hidden");
        reqDesError.innerText="Field cannot be blank";
        reqDesSubmit=false;
    } else {
        reqDesError.classList.remove("error-visible");
        reqDesError.classList.add("error-hidden");
        reqDesSubmit=true;
    }
});

//File Validation
file.addEventListener("input",()=>{
    if(file.value == null){
        fileError.classList.add("error-visible");
        fileError.classList.remove("error-hidden");
        fileError.innerText="Upload a file";
        fileSubmit=false;
    }else{
        fileSubmit=true;
    }
});

//Submit Button Visibility
const buttonCursor=document.querySelector(".hBtn");//To avoid poniterevent and cursor problem
addNeedReqForm.addEventListener("change",()=>{
    if(reqDesSubmit==true && fileSubmit==true){
        addReq.classList.remove("disabled");
        buttonCursor.classList.remove("cursor-disabled");
    }else{
        addReq.classList.add("disabled");
        buttonCursor.classList.add("cursor-disabled");
    }
});