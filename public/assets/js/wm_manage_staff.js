// Update office staff
const upStaffBtn=document.querySelector(".update-btn");
const closeModal=document.querySelector(".modal-close-btn");
const overlay=document.querySelector(".overlay");
const updateModal=document.querySelector(".modal-box1");

//Update office staff
upStaffBtn.addEventListener("click",()=>{
    overlay.classList.remove("modal-hidden");
    updateModal.classList.remove("modal-hidden");
})

//Close button 
closeModal.addEventListener("click",()=>{
    overlay.classList.add("modal-hidden");
    updateModal.classList.add("modal-hidden");
})

//===============Validate office staff=====================
const updateOfficeStaff=document.querySelector("#up-office-staff");
const hAddBtn=document.querySelector("#up-of");
const ofFullName=document.querySelector("#up-full-name");
const ofEmail=document.querySelector("#up-email-id");
const ofPhno=document.querySelector("#up-phn-number");
const ofPhoto=document.querySelector("#up-photo");


//Error Message Class
const ofFullNameError=document.querySelector(".of-fullname .error");
const ofEmailError=document.querySelector(".of-email .error");
const ofPhnoError=document.querySelector(".of-phno .error");
const ofPhotoError=document.querySelector(".of-photo .error");
var ofFullNameSubmit=true;
var ofEmailSubmit=true;
var ofPhnoSubmit=true;
var ofPhotoSubmit=true;

//Check name
var nameChk=/^[a-z A-Z]+$/;
ofFullName.addEventListener("input",()=>{
    if(ofFullName.value.match(nameChk)){
        ofFullNameError.classList.add("error-hidden");
        ofFullNameError.classList.remove("error-visible");
        ofFullNameSubmit=true;
    }else if(ofFullName.value==""){
        ofFullNameError.classList.add("error-visible");
        ofFullNameError.classList.remove("error-hidden");
        ofFullNameError.innerText="Field cannot be blank";
        ofFullNameSubmit=false;
    }else{
        ofFullNameError.classList.add("error-visible");
        ofFullNameError.classList.remove("error-hidden");
        ofFullNameError.innerText="Name should not contain numbers";
        ofFullNameSubmit=false;
    }
});

//Email Validation
var emailChk=/^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$/;
ofEmail.addEventListener("input",()=>{
    if(ofEmail.value.match(emailChk)){
        ofEmailError.classList.add("error-hidden");
        ofEmailError.classList.remove("error-visible");
        ofEmailSubmit=true;
    }else if(ofEmail.value==""){
        ofEmailError.classList.add("error-visible");
        ofEmailError.classList.remove("error-hidden");
        ofEmailError.innerText="Field cannot be blank";
        ofEmailSubmit=false;
    }else{
        ofEmailError.classList.add("error-visible");
        ofEmailError.classList.remove("error-hidden");
        ofEmailError.innerText="Invalid mail id";
        ofEmailSubmit=false;
    }
});

//Phno Validation
var phnoChk=/^([0-9_\-]{10,13})+$/;
ofPhno.addEventListener("input",()=>{
    if(ofPhno.value.match(phnoChk)){
       ofPhnoError.classList.add("error-hidden");
       ofPhnoError.classList.remove("error-visible");
       ofPhnoSubmit=true;
    }else if(ofPhno.value==""){
       ofPhnoError.classList.add("error-visible");
       ofPhnoError.classList.remove("error-hidden");
       ofPhnoError.innerText="Field cannot be blank";
       ofPhnoSubmit=false;
    }else{
       ofPhnoError.classList.add("error-visible");
       ofPhnoError.classList.remove("error-hidden");
       ofPhnoError.innerText="Invalid phone number";
       ofPhnoSubmit=false;
    }
});

//Photo Validation
ofPhoto.addEventListener("input",()=>{
    if(ofPhoto.value == null){
        ofPhotoError.classList.add("error-visible");
        ofPhotoError.classList.remove("error-hidden");
        ofPhotoError.innerText="Upload a file";
        ofPhotoSubmit=false;
    }else{
        ofPhotoSubmit=true;
    }
});


//Submit Button Visibility
const buttonCursor=document.querySelector(".hBtn");//To avoid poniterevent and cursor problem
updateOfficeStaff.addEventListener("input",()=>{
    if(ofFullNameSubmit==true && ofEmailSubmit==true && ofPhnoSubmit==true && ofPhotoSubmit==true){
        hAddBtn.classList.remove("disabled");
        buttonCursor.classList.remove("cursor-disabled");
    }else{
        hAddBtn.classList.add("disabled");
        buttonCursor.classList.add("cursor-disabled");
    }
});

//===============End of Validation office staff=====================

// ====================================================================
// ========================= Delete Staff =============================
// ====================================================================
const deleteHouse = document.querySelector(".remove-btn");
const closeDeleteModal=document.querySelector(".close-delete");
const delHouseModal = document.querySelector(".modal-box2");

//delete house
deleteHouse.addEventListener("click",()=>{
    overlay.classList.remove("modal-hidden");
    delHouseModal.classList.remove("modal-hidden");
})

//Close button
closeDeleteModal.addEventListener("click",()=>{
    overlay.classList.add("modal-hidden");
    delHouseModal.classList.add("modal-hidden");
})

//===============Validation for deletion=====================
const deleteForm=document.querySelector("#delete-staff-form");
const text=document.querySelector("#hdelreason");
const delBtn=document.querySelector("#delhBtn");
var textflag=false;

text.addEventListener("input",()=>{
    if(text.value==""){
        textflag=false;
    }else{
        textflag=true;
    }
});

const delButtonCursor=document.querySelector(".dBtn");//To avoid poniterevent and cursor problem
deleteForm.addEventListener("keyup",()=>{
    if(textflag==true){
        delBtn.classList.remove("disabled");
        delButtonCursor.classList.remove("cursor-disabled");
    }else{
        delBtn.classList.add("disabled");
        delButtonCursor.classList.add("cursor-disabled");
    }
});

// ====================================================================
// ====================== End of Delete Staff =========================
// ====================================================================