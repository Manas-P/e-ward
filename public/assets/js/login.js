//=============Login & Register Switch=================
const regBtn=document.querySelector("#register");
const logBtn=document.querySelector(".box2 a");
const box1=document.querySelector(".box");
const box2=document.querySelector(".box2");

regBtn.addEventListener("click",()=>{
    console.log("Worked");
    box1.classList.add("box-hide");
    box2.classList.add("box2-visible");
    box2.classList.remove("box2-hide");
});

logBtn.addEventListener("click",()=>{
    console.log("Worked");
    box2.classList.add("box2-hide");
    box1.classList.add("box-visible");
    box1.classList.remove("box-hide");
});
//========================End============================

//=============Registeration Form Validation==============

const regForm=document.querySelector("#reg-form");
const fullName=document.querySelector("#full-name");
const email=document.querySelector("#email-id");
const phno=document.querySelector("#phn-number");
const wardNo=document.querySelector("#ward-number");
const houseNo=document.querySelector("#house-number");
const taxRep=document.querySelector("#tax-report");
const regSubBtn=document.querySelector("#reg-btn");

//Error Message Class
const fullNameError=document.querySelector(".fullname .error");
const emailError=document.querySelector(".email .error");
const phnoError=document.querySelector(".phno .error");
const wardnoError=document.querySelector(".wrdno .error");
const housenoError=document.querySelector(".houseno .error");
const taxrepError=document.querySelector(".taxreport .error");
var fullNameSubmit=false;
var emailSubmit=false;
var phnoSubmit=false;
var wrdnoSubmit=false;
var hosnoSubmit=false;
var taxrepSubmit=false;

//Fullname Validation
var nameChk=/^[a-z A-Z]+$/;
fullName.addEventListener("input",()=>{
    if(fullName.value.match(nameChk)){
        fullNameError.classList.add("error-hidden");
        fullNameError.classList.remove("error-visible");
        fullNameSubmit=true;
    }else if(fullName.value==""){
        fullNameError.classList.add("error-visible");
        fullNameError.classList.remove("error-hidden");
        fullNameError.innerText="Field cannot be blank";
        fullNameSubmit=false;
    }else{
        fullNameError.classList.add("error-visible");
        fullNameError.classList.remove("error-hidden");
        fullNameError.innerText="Name should not contain numbers";
        fullNameSubmit=false;
    }
});

//Email Validation
var emailChk=/^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$/;
email.addEventListener("input",()=>{
    if(email.value.match(emailChk)){
        emailError.classList.add("error-hidden");
        emailError.classList.remove("error-visible");
        emailSubmit=true;
    }else if(email.value==""){
        emailError.classList.add("error-visible");
        emailError.classList.remove("error-hidden");
        emailError.innerText="Field cannot be blank";
        emailSubmit=false;
    }else{
        emailError.classList.add("error-visible");
        emailError.classList.remove("error-hidden");
        emailError.innerText="Invalid mail id";
        emailSubmit=false;
    }
});

//Phno Validation
var phnoChk=/^(\+\d{1,3}[- ]?)?\d{10}$/;
phno.addEventListener("input",()=>{
    if(phno.value.match(phnoChk)){
        phnoError.classList.add("error-hidden");
        phnoError.classList.remove("error-visible");
        phnoSubmit=true;
    }else if(phno.value==""){
        phnoError.classList.add("error-visible");
        phnoError.classList.remove("error-hidden");
        phnoError.innerText="Field cannot be blank";
        phnoSubmit=false;
    }else{
        phnoError.classList.add("error-visible");
        phnoError.classList.remove("error-hidden");
        phnoError.innerText="Invalid phone number";
        phnoSubmit=false;
    }
});

//Ward Number Validation
var wrdnoChk=/^[1-9]{1,2}$/;
wardNo.addEventListener("input",()=>{
    if(wardNo.value.match(wrdnoChk)){
        wardnoError.classList.add("error-hidden");
        wardnoError.classList.remove("error-visible");
        wrdnoSubmit=true;
    }else if(wardNo.value==""){
        wardnoError.classList.add("error-visible");
        wardnoError.classList.remove("error-hidden");
        wardnoError.innerText="Field cannot be blank";
        wrdnoSubmit=false;
    }else{
        wardnoError.classList.add("error-visible");
        wardnoError.classList.remove("error-hidden");
        wardnoError.innerText="Invalid ward number";
        wrdnoSubmit=false;
    }
});

//House Number Validation
var housenoChk=/^[1-9]{1,3}$/;
houseNo.addEventListener("input",()=>{
    if(houseNo.value.match(housenoChk)){
        housenoError.classList.add("error-hidden");
        housenoError.classList.remove("error-visible");
        hosnoSubmit=true;
    }else if(houseNo.value==""){
        housenoError.classList.add("error-visible");
        housenoError.classList.remove("error-hidden");
        housenoError.innerText="Field cannot be blank";
        hosnoSubmit=false;
    }else{
        housenoError.classList.add("error-visible");
        housenoError.classList.remove("error-hidden");
        housenoError.innerText="Invalid house number";
        hosnoSubmit=false;
    }
});

//Ration Number Validation
// var rationnoChk=/^[1-9]{10}$/;
// rationNo.addEventListener("input",()=>{
//     if(rationNo.value.match(rationnoChk)){
//         rationnoError.classList.add("error-hidden");
//         rationnoError.classList.remove("error-visible");
//         ranoSubmit=true;
//     }else if(rationNo.value==""){
//         rationnoError.classList.add("error-visible");
//         rationnoError.classList.remove("error-hidden");
//         rationnoError.innerText="Field cannot be blank";
//         ranoSubmit=false;
//     }else{
//         rationnoError.classList.add("error-visible");
//         rationnoError.classList.remove("error-hidden");
//         rationnoError.innerText="Invalid ration number";
//         ranoSubmit=false;
//     }
// });

taxRep.addEventListener("change",()=>{
    if(taxRep.value == null){
        taxrepSubmit=false;
    }else{
        taxrepSubmit=true;
    }
});

//Submit Button Visibility
const buttonCursor=document.querySelector(".button");//To avoid poniterevent and cursor problem
regForm.addEventListener("change",()=>{
    //console.log(fullNameSubmit,emailSubmit,phnoSubmit,wrdnoSubmit,hosnoSubmit,taxrepSubmit);
    if(fullNameSubmit==true && emailSubmit==true && phnoSubmit==true && wrdnoSubmit==true && hosnoSubmit==true && taxrepSubmit){
        regSubBtn.classList.remove("disabled");
        buttonCursor.classList.remove("cursor-disabled");
    }else{
        regSubBtn.classList.add("disabled");
        buttonCursor.classList.add("cursor-disabled");
    }
});

//========================End============================


//===================Alert Box Close====================
const alertt=document.querySelector(".alertt");
const alertClose=document.querySelector(".alert-close");
console.log(alertClose);
console.log(alertt);

// regSubBtn.addEventListener("click",()=>{
//     alertt.classList.remove("alert-hidden");
//     alertt.classList.add("alert-visible");
//     console.log("submit");
// });

alertClose.addEventListener("click",()=>{
    alertt.classList.remove("alert-visible");
    alertt.classList.add("alert-hidden");
});

