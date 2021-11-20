// Add Ward Member Modal 
const addMember=document.querySelector(".add-member");
const addpresident=document.querySelector(".add-president");
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

//Add president
addpresident.addEventListener("click",()=>{
    overlay.classList.remove("modal-hidden");
    presidentBox.classList.remove("modal-hidden");
})

//Close button ward member
closeModal.addEventListener("click",()=>{
    overlay.classList.add("modal-hidden");
    memberBox.classList.add("modal-hidden");
})

//Close button President
closeModalPresident.addEventListener("click",()=>{
    overlay.classList.add("modal-hidden");
    presidentBox.classList.add("modal-hidden");
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
var wFullnameSubmit=false;
var wEmailSubmit=false;
var wPhnoSubmit=false;
var wWrdnoSubmit=false;
var wDateSubmit=false;
var wPhotoSubmit=false;

//Check name
var nameChk=/^[a-z A-Z]+$/;
wFullname.addEventListener("input",()=>{
    if(wFullname.value.match(nameChk)){
        wFullnameError.classList.add("error-hidden");
        wFullnameError.classList.remove("error-visible");
        wFullnameSubmit=true;
    }else if(wFullname.value==""){
        wFullnameError.classList.add("error-visible");
        wFullnameError.classList.remove("error-hidden");
        wFullnameError.innerText="Field cannot be blank";
        wFullnameSubmit=false;
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
        wEmailError.classList.add("error-visible");
        wEmailError.classList.remove("error-hidden");
        wEmailError.innerText="Field cannot be blank";
        wEmailSubmit=false;
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
       wPhnoError.classList.add("error-visible");
       wPhnoError.classList.remove("error-hidden");
       wPhnoError.innerText="Field cannot be blank";
       wPhnoSubmit=false;
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
        wWardnoError.classList.add("error-visible");
        wWardnoError.classList.remove("error-hidden");
        wWardnoError.innerText="Field cannot be blank";
       wWrdnoSubmit=false;
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
        wDateError.classList.add("error-visible");
        wDateError.classList.remove("error-hidden");
        wDateError.innerText="Invalid date";
        wDateSubmit=false;
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
        wPhotoError.classList.add("error-visible");
        wPhotoError.classList.remove("error-hidden");
        wPhotoError.innerText="Upload a file";
        wPhotoSubmit=false;
    }else{
        wPhotoSubmit=true;
    }
});


//Submit Button Visibility
const buttonCursor=document.querySelector(".wBtn");//To avoid poniterevent and cursor problem
addMemberForm.addEventListener("keyup",()=>{
    console.log(wPhoto.value);
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


//===============Validation Presidentr=====================
const addPresidentForm=document.querySelector("#add-president");
const pFullname=document.querySelector("#p-full-name");
const pEmail=document.querySelector("#p-email-id");
const pPhno=document.querySelector("#p-phn-number");
const pWardno=document.querySelector("#p-ward-number");
const pAddBtn=document.querySelector("#add-p");
const pDatePicker=document.querySelector("#p-date");
const pPhoto=document.querySelector("#p-photo");


//Error Message Class
const pFullnameError=document.querySelector(".p-fullname .error");
const pEmailError=document.querySelector(".p-email .error");
const pPhnoError=document.querySelector(".p-phno .error");
const pWardnoError=document.querySelector(".p-wrdno .error");
const pDateError=document.querySelector(".p-date .error");
const pPhotoError=document.querySelector(".p-photo .error");
var pFullnameSubmit=false;
var pEmailSubmit=false;
var pPhnoSubmit=false;
var pWrdnoSubmit=false;
var pDateSubmit=false;
var pPhotoSubmit=false;

//Check name
pFullname.addEventListener("input",()=>{
    if(pFullname.value.match(nameChk)){
        pFullnameError.classList.add("error-hidden");
        pFullnameError.classList.remove("error-visible");
        pFullnameSubmit=true;
    }else if(wFullname.value==""){
        pFullnameError.classList.add("error-visible");
        pFullnameError.classList.remove("error-hidden");
        pFullnameError.innerText="Field cannot be blank";
        pFullnameSubmit=false;
    }else{
        pFullnameError.classList.add("error-visible");
        pFullnameError.classList.remove("error-hidden");
        pFullnameError.innerText="Name should not contain numbers";
        pFullnameSubmit=false;
    }
});

//Email Validation
pEmail.addEventListener("input",()=>{
    if(pEmail.value.match(emailChk)){
        pEmailError.classList.add("error-hidden");
        pEmailError.classList.remove("error-visible");
        pEmailSubmit=true;
    }else if(pEmail.value==""){
        pEmailError.classList.add("error-visible");
        pEmailError.classList.remove("error-hidden");
        pEmailError.innerText="Field cannot be blank";
        pEmailSubmit=false;
    }else{
        pEmailError.classList.add("error-visible");
        pEmailError.classList.remove("error-hidden");
        pEmailError.innerText="Invalid mail id";
        pEmailSubmit=false;
    }
});

//Phno Validation
pPhno.addEventListener("input",()=>{
    if(pPhno.value.match(phnoChk)){
       pPhnoError.classList.add("error-hidden");
       pPhnoError.classList.remove("error-visible");
       pPhnoSubmit=true;
    }else if(pPhno.value==""){
       pPhnoError.classList.add("error-visible");
       pPhnoError.classList.remove("error-hidden");
       pPhnoError.innerText="Field cannot be blank";
       pPhnoSubmit=false;
    }else{
       pPhnoError.classList.add("error-visible");
       pPhnoError.classList.remove("error-hidden");
       pPhnoError.innerText="Invalid phone number";
       pPhnoSubmit=false;
    }
});

//Ward Number Validation
pWardno.addEventListener("input",()=>{
    if(pWardno.value.match(wrdnoChk)){
        pWardnoError.classList.add("error-hidden");
        pWardnoError.classList.remove("error-visible");
       pWrdnoSubmit=true;
    }else if(wWardno.value==""){
        pWardnoError.classList.add("error-visible");
        pWardnoError.classList.remove("error-hidden");
        pWardnoError.innerText="Field cannot be blank";
        pWrdnoSubmit=false;
    }else{
        pWardnoError.classList.add("error-visible");
        pWardnoError.classList.remove("error-hidden");
        pWardnoError.innerText="Invalid ward number";
        pWrdnoSubmit=false;
    }
});

//Datepicker Validation
pDatePicker.addEventListener("input",()=>{
    if(pDatePicker.value.match(dateChk)){
        pDateError.classList.add("error-hidden");
        pDateError.classList.remove("error-visible");
        pDateSubmit=true;
    }else if(pDatePicker.value == ""){
        pDateError.classList.add("error-visible");
        pDateError.classList.remove("error-hidden");
        pDateError.innerText="Invalid date";
        pDateSubmit=false;
    }else{
        pDateError.classList.add("error-visible");
        pDateError.classList.remove("error-hidden");
        pDateError.innerText="Invalid date";
        pDateSubmit=false;
    }
});

//Photo Validation
pPhoto.addEventListener("input",()=>{
    if(pPhoto.value == null){
        pPhotoError.classList.add("error-visible");
        pPhotoError.classList.remove("error-hidden");
        pPhotoError.innerText="Upload a file";
        pPhotoSubmit=false;
    }else{
        pPhotoSubmit=true;
    }
});


//Submit Button Visibility
const pbuttonCursor=document.querySelector(".pBtn");//To avoid poniterevent and cursor problem
addPresidentForm.addEventListener("keyup",()=>{
    console.log(pFullnameSubmit, pEmailSubmit, pPhnoSubmit, pWrdnoSubmit, pDateSubmit, pPhotoSubmit);
    if(pFullnameSubmit==true && pEmailSubmit==true && pPhnoSubmit==true && pWrdnoSubmit==true && pDateSubmit==true &&  pPhotoSubmit==true){
        pAddBtn.classList.remove("disabled");
        pbuttonCursor.classList.remove("cursor-disabled");
    }else{
        pAddBtn.classList.add("disabled");
        pbuttonCursor.classList.add("cursor-disabled");
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
pDatePicker.setAttribute("min", today);
//===============End of Validation Presidentr=====================