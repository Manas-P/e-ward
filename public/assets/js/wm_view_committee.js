// ============== Tab content toggle ==============
const tabBtn1=document.querySelector("#tabBtn1");
const tabBtn2=document.querySelector("#tabBtn2");
const tabBtn3=document.querySelector("#tabBtn3");

const tabCon1=document.querySelector("#tabCon1");
const tabCon2=document.querySelector("#tabCon2");
const tabCon3=document.querySelector("#tabCon3");

tabBtn1.addEventListener("click",()=>{
  tabBtn1.classList.add("tab-active");
  tabBtn2.classList.remove("tab-active");
  tabBtn3.classList.remove("tab-active");

  tabCon1.classList.add("tab-con-active");
  tabCon2.classList.remove("tab-con-active");
  tabCon3.classList.remove("tab-con-active");
});

tabBtn2.addEventListener("click",()=>{
  tabBtn2.classList.add("tab-active");
  tabBtn1.classList.remove("tab-active");
  tabBtn3.classList.remove("tab-active");

  tabCon2.classList.add("tab-con-active");
  tabCon1.classList.remove("tab-con-active");
  tabCon3.classList.remove("tab-con-active");
});

tabBtn3.addEventListener("click",()=>{
  tabBtn3.classList.add("tab-active");
  tabBtn1.classList.remove("tab-active");
  tabBtn2.classList.remove("tab-active");

  tabCon3.classList.add("tab-con-active");
  tabCon1.classList.remove("tab-con-active");
  tabCon2.classList.remove("tab-con-active");
});

// ========== End of Tab content toggle ==========

// Add committee task modal
const addTask=document.querySelector(".add-task");
const closeModal=document.querySelector(".modal-close-btn");
const overlay=document.querySelector(".overlay");
const memberBox=document.querySelector(".modal-box");

//Add task
addTask.addEventListener("click",()=>{
    overlay.classList.remove("modal-hidden");
    memberBox.classList.remove("modal-hidden");
})

//Close button 
closeModal.addEventListener("click",()=>{
    overlay.classList.add("modal-hidden");
    memberBox.classList.add("modal-hidden");
})

//===============Validate task====================
const addTaskForm=document.querySelector("#add-task");
const commAddBtn=document.querySelector("#add-comm");
const commName=document.querySelector("#comm-name");
const commDes=document.querySelector("#comm-des");


//Error Message Class
const commNameError=document.querySelector(".commName .error");
const commDesError=document.querySelector(".commDes .error");
var commNameSubmit=false;
var commDesSubmit=false;

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
    if(commDes.value.length<371 && commDes.value.length>0){
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


//Submit Button Visibility
const buttonCursor=document.querySelector(".hBtn");//To avoid poniterevent and cursor problem
addTaskForm.addEventListener("keyup",()=>{
    if(commNameSubmit==true && commDesSubmit==true){
        commAddBtn.classList.remove("disabled");
        buttonCursor.classList.remove("cursor-disabled");
    }else{
        commAddBtn.classList.add("disabled");
        buttonCursor.classList.add("cursor-disabled");
    }
});

//===============End of validate task=====================
