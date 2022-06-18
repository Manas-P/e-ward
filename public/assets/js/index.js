const contForm=document.querySelector("#cont-us");
const fullName=document.querySelector("#full-name");
const email = document.querySelector("#email");
const text = document.querySelector("#msg");
const sendBtn=document.querySelector("#sendBtn");

//Error Message Class
const fullNameError=document.querySelector(".fullname .error");
const emailError = document.querySelector(".email .error");
const msgError = document.querySelector(".msg .error");

var fullNameSubmit=false;
var emailSubmit = false;
var textflag=false;

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

text.addEventListener("input",()=>{
    if (text.value == "") {
        msgError.classList.add("error-visible");
        msgError.classList.remove("error-hidden");
        msgError.innerText="Field cannot be blank";
        textflag=false;
    } else {
        msgError.classList.add("error-hidden");
        msgError.classList.remove("error-visible");
        textflag=true;
    }
});

//Submit Button Visibility
const buttonCursor=document.querySelector(".button");//To avoid poniterevent and cursor problem
contForm.addEventListener("input",()=>{
    if(fullNameSubmit==true && emailSubmit==true && textflag==true){
        sendBtn.classList.remove("disabled");
        buttonCursor.classList.remove("cursor-disabled");
    }else{
        sendBtn.classList.add("disabled");
        buttonCursor.classList.add("cursor-disabled");
    }
});