//===============Validation House Details=====================
const updateForm=document.querySelector("#reg-form");
const houseName=document.querySelector("#house-name");
const locality=document.querySelector("#locality-id");
const postOffice=document.querySelector("#por");


//Error Message Class
const houseNameError=document.querySelector(".housename .error");
const localityError=document.querySelector(".locality .error");
const postOfficeError=document.querySelector(".po .error");
var houseNameSubmit=true;
var localitySubmit=true;
var postOfficeSubmit=true;

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

//Submit Button Visibility
const upBtn=document.querySelector("#up-btn");
const buttonCursor=document.querySelector(".ubn");//To avoid poniterevent and cursor problem
updateForm.addEventListener("keyup",()=>{
    if(houseNameSubmit==true && localitySubmit==true && postOfficeSubmit==true){
        upBtn.classList.remove("disabled");
        buttonCursor.classList.remove("cursor-disabled");
    }else{
        upBtn.classList.add("disabled");
        buttonCursor.classList.add("cursor-disabled");
    }
});