// Add Ward Member Modal 
const addMember=document.querySelector("#add-member");
const closeModal=document.querySelector(".modal-close-btn");
const closeModalPresident=document.querySelector(".pre-cls-btn");
const overlay=document.querySelector(".overlay");
const memberBox=document.querySelector(".modal-box");
const presidentBox=document.querySelector(".modal-box2");

//Add Member
addMember.addEventListener("click",()=>{
    overlay.classList.remove("modal-hidden");
    memberBox.classList.remove("modal-hidden");
})

//Close button ward member
closeModal.addEventListener("click",()=>{
    overlay.classList.add("modal-hidden");
    memberBox.classList.add("modal-hidden");
})


//===============Validation Ward Member=====================
const addMemberForm=document.querySelector("#add-ward-member");
const wFullname=document.querySelector("#w-full-name");
const wEmail=document.querySelector("#w-email-id");
const wPhno=document.querySelector("#w-phn-number");
const wWardno=document.querySelector("#w-ward-number");
const wAddBtn=document.querySelector("#add-wm");
const wDatePicker=document.querySelector("#w-date");
const wPhoto=document.querySelector("#w-photo");


//Error Message Class
const wFullnameError=document.querySelector(".w-fullname .error");
const wEmailError=document.querySelector(".w-email .error");
const wPhnoError=document.querySelector(".w-phno .error");
const wWardnoError=document.querySelector(".w-wrdno .error");
const wDateError=document.querySelector(".w-date .error");
const wPhotoError=document.querySelector(".w-photo .error");
var wFullnameSubmit=true;
var wEmailSubmit=true;
var wPhnoSubmit=true;
var wWrdnoSubmit=true;
var wDateSubmit=true;
var wPhotoSubmit=true;

//Check name
var nameChk=/^[a-z A-Z]+$/;
wFullname.addEventListener("input",()=>{
    if(wFullname.value.match(nameChk)){
        wFullnameError.classList.add("error-hidden");
        wFullnameError.classList.remove("error-visible");
        wFullnameSubmit=true;
    }else if(wFullname.value==""){
        wFullnameError.classList.add("error-hidden");
        wFullnameError.classList.remove("error-visible");
        wFullnameSubmit=true;
    }else{
        wFullnameError.classList.add("error-visible");
        wFullnameError.classList.remove("error-hidden");
        wFullnameError.innerText="Name should not contain numbers";
        wFullnameSubmit=false;
    }
});

//Email Validation
var emailChk=/^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$/;
wEmail.addEventListener("input",()=>{
    if(wEmail.value.match(emailChk)){
        wEmailError.classList.add("error-hidden");
        wEmailError.classList.remove("error-visible");
        wEmailSubmit=true;
    }else if(wEmail.value==""){
        wEmailError.classList.add("error-hidden");
        wEmailError.classList.remove("error-visible");
        wEmailSubmit=true;
    }else{
        wEmailError.classList.add("error-visible");
        wEmailError.classList.remove("error-hidden");
        wEmailError.innerText="Invalid mail id";
        wEmailSubmit=false;
    }
});

//Phno Validation
var phnoChk=/^([0-9_\-]{10,13})+$/;
wPhno.addEventListener("input",()=>{
    if(wPhno.value.match(phnoChk)){
       wPhnoError.classList.add("error-hidden");
       wPhnoError.classList.remove("error-visible");
       wPhnoSubmit=true;
    }else if(wPhno.value==""){
        wPhnoError.classList.add("error-hidden");
        wPhnoError.classList.remove("error-visible");
        wPhnoSubmit=true;
    }else{
       wPhnoError.classList.add("error-visible");
       wPhnoError.classList.remove("error-hidden");
       wPhnoError.innerText="Invalid phone number";
       wPhnoSubmit=false;
    }
});

//Ward Number Validation
var wrdnoChk=/^[1-9]{1,2}$/;
wWardno.addEventListener("input",()=>{
    if(wWardno.value.match(wrdnoChk)){
        wWardnoError.classList.add("error-hidden");
        wWardnoError.classList.remove("error-visible");
       wWrdnoSubmit=true;
    }else if(wWardno.value==""){
        wWardnoError.classList.add("error-hidden");
        wWardnoError.classList.remove("error-visible");
       wWrdnoSubmit=true;
    }else{
        wWardnoError.classList.add("error-visible");
        wWardnoError.classList.remove("error-hidden");
        wWardnoError.innerText="Invalid ward number";
        wWrdnoSubmit=false;
    }
});

//Datepicker Validation
var dateChk=/^(((19|20)([2468][048]|[13579][26]|0[48])|2000)[/-]02[/-]29|((19|20)[0-9]{2}[/-](0[4678]|1[02])[/-](0[1-9]|[12][0-9]|30)|(19|20)[0-9]{2}[/-](0[1359]|11)[/-](0[1-9]|[12][0-9]|3[01])|(19|20)[0-9]{2}[/-]02[/-](0[1-9]|1[0-9]|2[0-8])))$/;
wDatePicker.addEventListener("input",()=>{
    if(wDatePicker.value.match(dateChk)){
        wDateError.classList.add("error-hidden");
        wDateError.classList.remove("error-visible");
        wDateSubmit=true;
    }else if(wDatePicker.value == ""){
        wDateError.classList.add("error-hidden");
        wDateError.classList.remove("error-visible");
        wDateSubmit=true;
    }else{
        wDateError.classList.add("error-visible");
        wDateError.classList.remove("error-hidden");
        wDateError.innerText="Invalid date";
        wDateSubmit=false;
    }
});

//Photo Validation
wPhoto.addEventListener("input",()=>{
    if(wPhoto.value == null){
        wPhotoSubmit=true;
    }else{
        wPhotoSubmit=true;
    }
});


//Submit Button Visibility
const buttonCursor=document.querySelector(".wBtn");//To avoid poniterevent and cursor problem
addMemberForm.addEventListener("keyup",()=>{
    console.log(wFullnameSubmit, wEmailSubmit, wPhnoSubmit, wWrdnoSubmit, wDateSubmit, wPhotoSubmit);
    if(wFullnameSubmit==true && wEmailSubmit==true && wPhnoSubmit==true && wWrdnoSubmit==true && wDateSubmit==true &&  wPhotoSubmit==true){
        wAddBtn.classList.remove("disabled");
        buttonCursor.classList.remove("cursor-disabled");
    }else{
        wAddBtn.classList.add("disabled");
        buttonCursor.classList.add("cursor-disabled");
    }
});

//Date picker min today
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0 so need to add 1 to make it 1!
var yyyy = today.getFullYear();
if(dd<10){
  dd='0'+dd
} 
if(mm<10){
  mm='0'+mm
} 

today = yyyy+'-'+mm+'-'+dd;
wDatePicker.setAttribute("min", today);
//===============End of Validation Ward Member=====================

