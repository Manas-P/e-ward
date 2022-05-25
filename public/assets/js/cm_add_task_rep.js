// Add task report Modal 
const addMember=document.querySelector(".add-task-report");
const closeModal=document.querySelector(".modal-close-btn");
const overlay=document.querySelector(".overlay");
const memberBox=document.querySelector(".modal-box");

//Add Member
addMember.addEventListener("click",()=>{
    overlay.classList.remove("modal-hidden");
    memberBox.classList.remove("modal-hidden");
})

//Close button 
closeModal.addEventListener("click",()=>{
    overlay.classList.add("modal-hidden");
    memberBox.classList.add("modal-hidden");
})

//===============Validate task report====================
const addCommitteeForm=document.querySelector("#add-committe");
const commAddBtn=document.querySelector("#add-comm");
const commName=document.querySelector("#comm-name");
const commDes=document.querySelector("#comm-des");
const commPhoto=document.querySelector("#comm-photo1");


//Error Message Class
const commNameError=document.querySelector(".commName .error");
const commDesError=document.querySelector(".commDes .error");
const commPhotoError=document.querySelector(".commPhoto1 .error");
var commNameSubmit=false;
var commDesSubmit=false;
var commPhotoSubmit=false;

//Check name
var nameChk=/^[a-z A-Z]+$/;
commName.addEventListener("input",()=>{
    if(commName.value.match(nameChk)){
        commNameError.classList.add("error-hidden");
        commNameError.classList.remove("error-visible");
        commNameSubmit=true;
    }else if(commName.value==""){
        commNameError.classList.add("error-visible");
        commNameError.classList.remove("error-hidden");
        commNameError.innerText="Field cannot be blank";
        commNameSubmit=false;
    }else{
        commNameError.classList.add("error-visible");
        commNameError.classList.remove("error-hidden");
        commNameError.innerText="Name should not contain numbers";
        commNameSubmit=false;
    }
});

//Description validation
const limitText=document.querySelector("#count-char");
const counterror=document.querySelector(".count-limit");
const textarea=document.querySelector(".inputt textarea");
commDes.addEventListener("input",()=>{
    limitText.innerText=commDes.value.length;
    if(commDes.value.length<361 && commDes.value.length>0){
        commDesError.classList.add("error-hidden");
        commDesError.classList.remove("error-visible");
        counterror.style.color = "#1e1e1e";
        textarea.style.border = "1px solid #c1c1c1";
        commDesSubmit=true;
    }else if(commDes.value==""){
        commDesError.classList.add("error-visible");
        commDesError.classList.remove("error-hidden");
        commDesError.innerText="Field cannot be blank";
        counterror.style.color = "#1e1e1e";
        textarea.style.border = "1px solid #c1c1c1";
        commDesSubmit=false;
    }else{
        commDesError.classList.add("error-visible");
        commDesError.classList.remove("error-hidden");
        commDesError.innerText="Character limit exeeded";
        counterror.style.color = "red";
        textarea.style.border = "1px solid red";
        commDesSubmit=false;
     }
})

//Photo Validation
commPhoto.addEventListener("input",()=>{
    if(commPhoto.value == null){
        commPhotoError.classList.add("error-visible");
        commPhotoError.classList.remove("error-hidden");
        commPhotoError.innerText="Upload a file";
        commPhotoSubmit=false;
    }else{
        commPhotoSubmit=true;
    }
});


//Submit Button Visibility
const buttonCursor=document.querySelector(".hBtn");//To avoid poniterevent and cursor problem
addCommitteeForm.addEventListener("change",() => {
    console.log(commNameSubmit, commDesSubmit, commPhotoSubmit);
    if(commNameSubmit==true && commDesSubmit==true && commPhotoSubmit==true){
        commAddBtn.classList.remove("disabled");
        buttonCursor.classList.remove("cursor-disabled");
    }else{
        commAddBtn.classList.add("disabled");
        buttonCursor.classList.add("cursor-disabled");
    }
});

//===============End of Committe=====================




