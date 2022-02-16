//===============Validation House Details=====================
const updateForm=document.querySelector("#reg-form");
const houseName=document.querySelector("#house-name");
const locality=document.querySelector("#locality-id");
const postOffice=document.querySelector("#por");
const rationNo=document.querySelector("#ration-number");


//Error Message Class
const houseNameError=document.querySelector(".housename .error");
const localityError=document.querySelector(".locality .error");
const postOfficeError=document.querySelector(".po .error");
const rationnoError=document.querySelector(".rationno .error");
var houseNameSubmit=false;
var localitySubmit=false;
var postOfficeSubmit=false;
var ranoSubmit=false;

//Check house name
houseName.addEventListener("input",()=>{
    if(houseName.value==""){
        houseNameError.classList.add("error-visible");
        houseNameError.classList.remove("error-hidden");
        houseNameError.innerText="Field cannot be blank";
        houseNameSubmit=false;
    }else{
        houseNameError.classList.add("error-hidden");
        houseNameError.classList.remove("error-visible");
        houseNameSubmit=true;
    }
});

//Check locality
locality.addEventListener("input",()=>{
    if(locality.value==""){
        localityError.classList.add("error-visible");
        localityError.classList.remove("error-hidden");
        localityError.innerText="Field cannot be blank";
        localitySubmit=false;
    }else{
        localityError.classList.add("error-hidden");
        localityError.classList.remove("error-visible");
        localitySubmit=true;
    }
});

//Check Post office
postOffice.addEventListener("input",()=>{
    if(postOffice.value==""){
        postOfficeError.classList.add("error-visible");
        postOfficeError.classList.remove("error-hidden");
        postOfficeError.innerText="Field cannot be blank";
        postOfficeSubmit=false;
    }else{
        postOfficeError.classList.add("error-hidden");
        postOfficeError.classList.remove("error-visible");
        postOfficeSubmit=true;
    }
});

//Ration Number Validation
var rationnoChk=/^[1-9]{10}$/;
rationNo.addEventListener("input",()=>{
    if(rationNo.value.match(rationnoChk)){
        rationnoError.classList.add("error-hidden");
        rationnoError.classList.remove("error-visible");
        ranoSubmit=true;
    }else if(rationNo.value==""){
        rationnoError.classList.add("error-visible");
        rationnoError.classList.remove("error-hidden");
        rationnoError.innerText="Field cannot be blank";
        ranoSubmit=false;
    }else{
        rationnoError.classList.add("error-visible");
        rationnoError.classList.remove("error-hidden");
        rationnoError.innerText="Invalid ration number";
        ranoSubmit=false;
    }
});

//Submit Button Visibility
const upBtn=document.querySelector("#up-btn");
const buttonCursor=document.querySelector(".ubn");//To avoid poniterevent and cursor problem
updateForm.addEventListener("keyup",()=>{
    if(houseNameSubmit==true && localitySubmit==true && postOfficeSubmit==true && ranoSubmit){
        upBtn.classList.remove("disabled");
        buttonCursor.classList.remove("cursor-disabled");
    }else{
        upBtn.classList.add("disabled");
        buttonCursor.classList.add("cursor-disabled");
    }
});