const updateForm=document.querySelector("#reg-form");
const fullName=document.querySelector("#hm-full-name");
const bloodGrp=document.querySelector("#hm-blood");
const email=document.querySelector("#hm-email-id");
const phno=document.querySelector("#hm-phn-number");

//Error Message Class
const fullNameError=document.querySelector(".hm-fullname .error");
const bloodGrpError=document.querySelector(".hm-blood .error");
const emailError=document.querySelector(".hm-email .error");
const phnoError=document.querySelector(".hm-phno .error");
var fullNameSubmit=true;
var bloodGrpSubmit=true;
var emailSubmit=true;
var phnoSubmit=true;

//Check name
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

//Blood Group Validation
var bloodChk=/^(A|B|AB|O|a|b|ab|o)[+-]$/;
bloodGrp.addEventListener("input",()=>{
    if(bloodGrp.value.match(bloodChk)){
        bloodGrpError.classList.add("error-hidden");
        bloodGrpError.classList.remove("error-visible");
        bloodGrpSubmit=true;
    }else if(bloodGrp.value==""){
        bloodGrpError.classList.add("error-hidden");
        bloodGrpError.classList.remove("error-visible");
        bloodGrpSubmit=true;
    }else{
        bloodGrpError.classList.add("error-visible");
        bloodGrpError.classList.remove("error-hidden");
        bloodGrpError.innerText="Invalid blood group";
        bloodGrpSubmit=false;
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
        emailError.classList.add("error-hidden");
        emailError.classList.remove("error-visible");
        emailSubmit=true;
    }else{
        emailError.classList.add("error-visible");
        emailError.classList.remove("error-hidden");
        emailError.innerText="Invalid mail id";
        emailSubmit=false;
    }
});

//Phno Validation
var phnoChk=/^([0-9_\-]{10,13})+$/;
phno.addEventListener("input",()=>{
    if(phno.value.match(phnoChk)){
       phnoError.classList.add("error-hidden");
       phnoError.classList.remove("error-visible");
       phnoSubmit=true;
    }else if(phno.value==""){
        phnoError.classList.add("error-hidden");
        phnoError.classList.remove("error-visible");
        phnoSubmit=true;
    }else{
       phnoError.classList.add("error-visible");
       phnoError.classList.remove("error-hidden");
       phnoError.innerText="Invalid phone number";
       phnoSubmit=false;
    }
});

//Submit Button Visibility
const upBtn=document.querySelector("#hm-up-btn");
const buttonCursor=document.querySelector(".ubn");//To avoid poniterevent and cursor problem
updateForm.addEventListener("keyup",()=>{
    if(fullNameSubmit===true && bloodGrpSubmit==true && emailSubmit==true && phnoSubmit==true){
        upBtn.classList.remove("disabled");
        buttonCursor.classList.remove("cursor-disabled");
    }else{
        upBtn.classList.add("disabled");
        buttonCursor.classList.add("cursor-disabled");
    }
});