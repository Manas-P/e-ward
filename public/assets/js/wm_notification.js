// Add notification task modal
const addNot=document.querySelector(".add-not");
const closeModal=document.querySelector(".modal-close-btn");
const overlay=document.querySelector(".overlay");
const addNotBox=document.querySelector(".modal-box");

//Add task
addNot.addEventListener("click",()=>{
    overlay.classList.remove("modal-hidden");
    addNotBox.classList.remove("modal-hidden");
})

//Close button 
closeModal.addEventListener("click",()=>{
    overlay.classList.add("modal-hidden");
    addNotBox.classList.add("modal-hidden");
})

//===============Validate task====================
const addNotForm=document.querySelector("#add-not");
const addNotBtn=document.querySelector("#add-not-btn");
const notName = document.querySelector("#not-name");
const notDes=document.querySelector("#not-des");


//Error Message Class
const notNameError = document.querySelector(".notName .error");
const edocError = document.querySelector(".edoc .error");
const notDesError=document.querySelector(".notDes .error");
var notNameSubmit = false;
var notDesSubmit=false;

//Check name
notName.addEventListener("input",()=>{
    if(notName.value==""){
        notNameError.classList.add("error-visible");
        notNameError.classList.remove("error-hidden");
        notNameError.innerText="Field cannot be blank";
        notNameSubmit=false;
    }else{
        notNameError.classList.add("error-hidden");
        notNameError.classList.remove("error-visible");
        notNameSubmit=true;
    }
});

//Description validation
notDes.addEventListener("input",()=>{
    if(notDes.value==""){
        notDesError.classList.add("error-visible");
        notDesError.classList.remove("error-hidden");
        notDesError.innerText="Field cannot be blank";
        notDesSubmit=false;
    }else{
        notDesError.classList.add("error-visible");
        notDesError.classList.remove("error-hidden");
        notDesSubmit=true;
     }
})

//checkbox validation
const chk1 = document.querySelector("#hm");
const chk2 = document.querySelector("#os");
let chkSubmit = false;

chk1.addEventListener("click",() => {
    if (chk1.checked == true || chk2.checked == true) {
        chkSubmit = true;
    } else {
        chkSubmit = false;
    }
})

chk2.addEventListener("click",() => {
    if (chk1.checked == true || chk2.checked == true) {
        chkSubmit = true;
    } else {
        chkSubmit = false;
    }
})



//Submit Button Visibility
const buttonCursor=document.querySelector(".dBtn");//To avoid poniterevent and cursor problem
addNotForm.addEventListener("change",() => {
    if(notNameSubmit==true && notDesSubmit==true && chkSubmit==true){
        addNotBtn.classList.remove("disabled");
        buttonCursor.classList.remove("cursor-disabled");
    }else{
        addNotBtn.classList.add("disabled");
        buttonCursor.classList.add("cursor-disabled");
    }
});

//===============End of validate task=====================