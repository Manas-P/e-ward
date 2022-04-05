// Add Ward Member Modal 
const addMember=document.querySelector(".add-member");
const closeModal=document.querySelector(".modal-close-btn");
const overlay=document.querySelector(".overlay");
const memberBox=document.querySelector(".modal-box");

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
const addMemberForm=document.querySelector("#add-house-member");
const hFullname=document.querySelector("#h-full-name");
const hEmail=document.querySelector("#h-email-id");
const hPhno=document.querySelector("#h-phn-number");
const hBlood=document.querySelector("#h-blood");
const hAddBtn=document.querySelector("#add-hm");
const hDatePicker=document.querySelector("#h-date");
const hPhoto=document.querySelector("#h-photo");


//Error Message Class
const hFullnameError=document.querySelector(".h-fullname .error");
const hEmailError=document.querySelector(".h-email .error");
const hPhnoError=document.querySelector(".h-phno .error");
const hBloodError=document.querySelector(".h-blood .error");
const hDateError=document.querySelector(".h-date .error");
const hPhotoError=document.querySelector(".h-photo .error");
var hFullnameSubmit=false;
var hEmailSubmit=true;
var hPhnoSubmit=false;
var hBloodSubmit=false;
var hDateSubmit=false;
var hPhotoSubmit=false;

//Check name
var nameChk=/^[a-z A-Z]+$/;
hFullname.addEventListener("input",()=>{
    if(hFullname.value.match(nameChk)){
        hFullnameError.classList.add("error-hidden");
        hFullnameError.classList.remove("error-visible");
        hFullnameSubmit=true;
    }else if(hFullname.value==""){
        hFullnameError.classList.add("error-visible");
        hFullnameError.classList.remove("error-hidden");
        hFullnameError.innerText="Field cannot be blank";
        hFullnameSubmit=false;
    }else{
        hFullnameError.classList.add("error-visible");
        hFullnameError.classList.remove("error-hidden");
        hFullnameError.innerText="Name should not contain numbers";
        hFullnameSubmit=false;
    }
});

//Email Validation
var emailChk=/^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$/;
hEmail.addEventListener("input",()=>{
    if(hEmail.value.match(emailChk)){
        hEmailError.classList.add("error-hidden");
        hEmailError.classList.remove("error-visible");
        hEmailSubmit=true;
    }else if(hEmail.value==""){
        //No error shown for blank
        hEmailError.classList.add("error-hidden");
        hEmailError.classList.remove("error-visible");
        hEmailSubmit=true;
    }else{
        hEmailError.classList.add("error-visible");
        hEmailError.classList.remove("error-hidden");
        hEmailError.innerText="Invalid mail id";
        hEmailSubmit=false;
    }
});

//Phno Validation
var phnoChk=/^([0-9_\-]{10,13})+$/;
hPhno.addEventListener("input",()=>{
    if(hPhno.value.match(phnoChk)){
       hPhnoError.classList.add("error-hidden");
       hPhnoError.classList.remove("error-visible");
       hPhnoSubmit=true;
    }else if(hPhno.value==""){
       hPhnoError.classList.add("error-visible");
       hPhnoError.classList.remove("error-hidden");
       hPhnoError.innerText="Field cannot be blank";
       hPhnoSubmit=false;
    }else{
       hPhnoError.classList.add("error-visible");
       hPhnoError.classList.remove("error-hidden");
       hPhnoError.innerText="Invalid phone number";
       hPhnoSubmit=false;
    }
});

//Blood Group Validation
var bloodChk=/^(A|B|AB|O|a|b|ab|o)[+-]$/;
hBlood.addEventListener("input",()=>{
    if(hBlood.value.match(bloodChk)){
        hBloodError.classList.add("error-hidden");
        hBloodError.classList.remove("error-visible");
       hBloodSubmit=true;
    }else if(hBlood.value==""){
        hBloodError.classList.add("error-visible");
        hBloodError.classList.remove("error-hidden");
        hBloodError.innerText="Field cannot be blank";
       hBloodSubmit=false;
    }else{
        hBloodError.classList.add("error-visible");
        hBloodError.classList.remove("error-hidden");
        hBloodError.innerText="Invalid blood group";
        hBloodSubmit=false;
    }
});

//Datepicker Validation
var dateChk=/^(((19|20)([2468][048]|[13579][26]|0[48])|2000)[/-]02[/-]29|((19|20)[0-9]{2}[/-](0[4678]|1[02])[/-](0[1-9]|[12][0-9]|30)|(19|20)[0-9]{2}[/-](0[1359]|11)[/-](0[1-9]|[12][0-9]|3[01])|(19|20)[0-9]{2}[/-]02[/-](0[1-9]|1[0-9]|2[0-8])))$/;
hDatePicker.addEventListener("input",()=>{
    if(hDatePicker.value.match(dateChk)){
        hDateError.classList.add("error-hidden");
        hDateError.classList.remove("error-visible");
        hDateSubmit=true;
    }else if(hDatePicker.value == ""){
        hDateError.classList.add("error-visible");
        hDateError.classList.remove("error-hidden");
        hDateError.innerText="Invalid date";
        hDateSubmit=false;
    }else{
        hDateError.classList.add("error-visible");
        hDateError.classList.remove("error-hidden");
        hDateError.innerText="Invalid date";
        hDateSubmit=false;
    }
});

//Photo Validation
hPhoto.addEventListener("input",()=>{
    if(hPhoto.value == null){
        hPhotoError.classList.add("error-visible");
        hPhotoError.classList.remove("error-hidden");
        hPhotoError.innerText="Upload a file";
        hPhotoSubmit=false;
    }else{
        hPhotoSubmit=true;
    }
});


//Submit Button Visibility
const buttonCursor=document.querySelector(".hBtn");//To avoid poniterevent and cursor problem
addMemberForm.addEventListener("keyup",()=>{
    if(hFullnameSubmit==true && hEmailSubmit==true && hPhnoSubmit==true && hBloodSubmit==true && hDateSubmit==true &&  hPhotoSubmit==true){
        hAddBtn.classList.remove("disabled");
        buttonCursor.classList.remove("cursor-disabled");
    }else{
        hAddBtn.classList.add("disabled");
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
hDatePicker.setAttribute("max", today);
//===============End of Validation Ward Member=====================

