// ============== Tab content toggle ==============
const tabBtn1=document.querySelector("#tabBtn1");
const tabBtn2=document.querySelector("#tabBtn2");

const tabCon1=document.querySelector("#tabCon1");
const tabCon2=document.querySelector("#tabCon2");

tabBtn1.addEventListener("click",()=>{
  tabBtn1.classList.add("tab-active");
  tabBtn2.classList.remove("tab-active");

  tabCon1.classList.add("tab-con-active");
  tabCon2.classList.remove("tab-con-active");
});

tabBtn2.addEventListener("click",()=>{
  tabBtn2.classList.add("tab-active");
  tabBtn1.classList.remove("tab-active");

  tabCon2.classList.add("tab-con-active");
  tabCon1.classList.remove("tab-con-active");
});


// ========== End of Tab content toggle ==========

// Add committee task modal
const addSl=document.querySelector(".add-sl");
const closeModal=document.querySelector(".modal-close-btn");
const overlay=document.querySelector(".overlay");
const addSlBox=document.querySelector(".modal-box");

//Add task
addSl.addEventListener("click",()=>{
    overlay.classList.remove("modal-hidden");
    addSlBox.classList.remove("modal-hidden");
})

//Close button 
closeModal.addEventListener("click",()=>{
    overlay.classList.add("modal-hidden");
    addSlBox.classList.add("modal-hidden");
})

//===============Validate task====================
const addSlForm=document.querySelector("#add-task");
const commAddBtn=document.querySelector("#add-comm");
const commName=document.querySelector("#comm-name");
const commloca = document.querySelector("#comm-locality");
// const chkboxes = document.querySelectorAll(".hm-checkbox");


//Error Message Class
const commNameError=document.querySelector(".commName .error");
const commlocaError=document.querySelector(".commlocality .error");
var commNameSubmit=false;
var commlocaSubmit = false;
// var chkboxSubmit = false;

//Check name
commName.addEventListener("input",()=>{
    if(commName.value==""){
        commNameError.classList.add("error-visible");
        commNameError.classList.remove("error-hidden");
        commNameError.innerText="Field cannot be blank";
        commNameSubmit=false;
    }else{
        commNameError.classList.add("error-hidden");
        commNameError.classList.remove("error-visible");
        commNameSubmit=true;
    }
});

//Description validation
commloca.addEventListener("input",()=>{
    if(commloca.value==""){
        commlocaError.classList.add("error-visible");
        commlocaError.classList.remove("error-hidden");
        commlocaError.innerText="Field cannot be blank";
        commlocaSubmit=false;
    }else{
        commlocaError.classList.add("error-hidden");
        commlocaError.classList.remove("error-visible");
        commlocaSubmit=true;
     }
})

//Chekbox validation
// for (eachChkbox of chkboxes) {
//     eachChkbox.addEventListener("click",() => {
//         console.log(eachChkbox);
        // if (eachChkbox.checked == true) {
        //     chkboxSubmit = true;
        // } else {
        //     chkboxSubmit = false;
        // }
//     })
// }

//Submit Button Visibility
const buttonCursor=document.querySelector(".hBtn");//To avoid poniterevent and cursor problem
addSlForm.addEventListener("change",()=>{
    if(commNameSubmit==true && commlocaSubmit==true){
        commAddBtn.classList.remove("disabled");
        buttonCursor.classList.remove("cursor-disabled");
    }else{
        commAddBtn.classList.add("disabled");
        buttonCursor.classList.add("cursor-disabled");
    }
});

//===============End of validate task=====================