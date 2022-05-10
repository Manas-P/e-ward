// ====================================================================
// =================== Update House Details ===========================
// ====================================================================
const updateHouse = document.querySelector("#up-house");
const closeModal=document.querySelector(".modal-close-btn");
const overlay=document.querySelector(".overlay");
const upHouseModal = document.querySelector(".modal-box1");

//Add Member
updateHouse.addEventListener("click",()=>{
    overlay.classList.remove("modal-hidden");
    upHouseModal.classList.remove("modal-hidden");
})

//Close button
closeModal.addEventListener("click",()=>{
    overlay.classList.add("modal-hidden");
    upHouseModal.classList.add("modal-hidden");
})

//===============Validation update house=====================
const updateForm=document.querySelector("#update-house");
const hName=document.querySelector("#h-name");
const hLocality=document.querySelector("#h-locality");
const hPost=document.querySelector("#h-post");
const hRation=document.querySelector("#h-ration");

//Error Message Class
const hNameError=document.querySelector(".h-name .error");
const hLocalityError=document.querySelector(".h-locality .error");
const hPostError=document.querySelector(".h-post .error");
const hRationError=document.querySelector(".h-ration .error");
var hNameSubmit=true;
var hLocalitySubmit=true;
var hPostSubmit=true;
var hRationSubmit = true;

//Check name
var nameChk=/^[a-z A-Z 0-9_]+$/;
hName.addEventListener("input",()=>{
    if(hName.value.match(nameChk)){
        hNameError.classList.add("error-hidden");
        hNameError.classList.remove("error-visible");
        hNameSubmit=true;
    }else if(hName.value==""){
        hNameError.classList.add("error-visible");
        hNameError.classList.remove("error-hidden");
        hNameError.innerText="Field cannot be blank";
        hNameSubmit=false;
    }else{
        hNameError.classList.add("error-visible");
        hNameError.classList.remove("error-hidden");
        hNameError.innerText="Name should not contain characters";
        hNameSubmit=false;
    }
});

//Check Locality
hLocality.addEventListener("input",()=>{
    if(hLocality.value.match(nameChk)){
        hLocalityError.classList.add("error-hidden");
        hLocalityError.classList.remove("error-visible");
        hLocalitySubmit=true;
    }else if(hLocality.value==""){
        hLocalityError.classList.add("error-visible");
        hLocalityError.classList.remove("error-hidden");
        hLocalityError.innerText="Field cannot be blank";
        hLocalitySubmit=false;
    }else{
        hLocalityError.classList.add("error-visible");
        hLocalityError.classList.remove("error-hidden");
        hLocalityError.innerText="Name should not contain characters";
        hLocalitySubmit=false;
    }
});

//Check Post office
hPost.addEventListener("input",()=>{
    if(hPost.value.match(nameChk)){
        hPostError.classList.add("error-hidden");
        hPostError.classList.remove("error-visible");
        hPostSubmit=true;
    }else if(hPost.value==""){
        hPostError.classList.add("error-visible");
        hPostError.classList.remove("error-hidden");
        hPostError.innerText="Field cannot be blank";
        hPostSubmit=false;
    }else{
        hPostError.classList.add("error-visible");
        hPostError.classList.remove("error-hidden");
        hPostError.innerText="Name should not contain characters";
        hPostSubmit=false;
    }
});

//Check Ration number
var rationnoChk=/^[0-9]{10}$/;
hRation.addEventListener("input",()=>{
    if(hRation.value.match(rationnoChk)){
        hRationError.classList.add("error-hidden");
        hRationError.classList.remove("error-visible");
        hRationSubmit=true;
    }else if(hRation.value==""){
        hRationError.classList.add("error-visible");
        hRationError.classList.remove("error-hidden");
        hRationError.innerText="Field cannot be blank";
        hRationSubmit=false;
    }else{
        hRationError.classList.add("error-visible");
        hRationError.classList.remove("error-hidden");
        hRationError.innerText="Invalid ration number";
        hRationSubmit=false;
    }
});

//Submit Button Visibility
const hUpBtn=document.querySelector("#up-h");
const buttonCursor=document.querySelector(".hBtn");//To avoid poniterevent and cursor problem
updateForm.addEventListener("keyup",()=>{
    if(hNameSubmit==true && hLocalitySubmit==true && hPostSubmit==true && hRationSubmit==true){
        hUpBtn.classList.remove("disabled");
        buttonCursor.classList.remove("cursor-disabled");
    }else{
        hUpBtn.classList.add("disabled");
        buttonCursor.classList.add("cursor-disabled");
    }
});

// ====================================================================
// =============== End of Update House Details ========================
// ====================================================================



// ====================================================================
// ========================= Delete House =============================
// ====================================================================
const deleteHouse = document.querySelector("#delete-house");
const closeDeleteModal=document.querySelector(".close-delete");
const delHouseModal = document.querySelector(".modal-box2");

//Add Member
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
const deleteForm=document.querySelector("#delete-house-form");
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
// ====================== End of Delete House =========================
// ====================================================================


// ====================================================================
// ====================== Delete House Member =========================
// ====================================================================
const deleteBtn=document.querySelectorAll("#delete-member-btn");
const closeMemDelModal=document.querySelector(".close-delete-mem");
const delMemModal = document.querySelector(".modal-box3");

//Delete member
for (eachdel of deleteBtn){
    eachdel.addEventListener("click", () => {
        overlay.classList.remove("modal-hidden");
        delMemModal.classList.remove("modal-hidden");
    });
}

//Close button
closeMemDelModal.addEventListener("click",()=>{
    overlay.classList.add("modal-hidden");
    delMemModal.classList.add("modal-hidden");
})

//===============Validation for deletion=====================
const deleteMemForm=document.querySelector("#delete-member-form");
const delText=document.querySelector("#mdelreason");
const delmBtn=document.querySelector("#delmBtn");
var delTextflag=false;

delText.addEventListener("input",()=>{
    if(delText.value==""){
        delTextflag=false;
    }else{
        delTextflag=true;
    }
});

const delmButtonCursor=document.querySelector(".dmBtn");//To avoid poniterevent and cursor problem
deleteMemForm.addEventListener("keyup",()=>{
    if(delTextflag==true){
        delmBtn.classList.remove("disabled");
        delmButtonCursor.classList.remove("cursor-disabled");
    }else{
        delmBtn.classList.add("disabled");
        delmButtonCursor.classList.add("cursor-disabled");
    }
});