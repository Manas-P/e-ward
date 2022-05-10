// Add document task modal
const addDoc=document.querySelector(".add-doc");
const closeModal=document.querySelector(".modal-close-btn");
const overlay=document.querySelector(".overlay");
const addDocBox=document.querySelector(".modal-box");

//Add task
addDoc.addEventListener("click",()=>{
    overlay.classList.remove("modal-hidden");
    addDocBox.classList.remove("modal-hidden");
})

//Close button 
closeModal.addEventListener("click",()=>{
    overlay.classList.add("modal-hidden");
    addDocBox.classList.add("modal-hidden");
})

//===============Validate task====================
const addDocForm=document.querySelector("#add-doc");
const addDocBtn=document.querySelector("#add-doc-btn");
const docName = document.querySelector("#doc-name");
const edoc=document.querySelector("#up-doc");


//Error Message Class
const docNameError = document.querySelector(".docName .error");
const edocError=document.querySelector(".edoc .error");
var docNameSubmit = false;
var edocSubmit=false;

//Check name
docName.addEventListener("input",()=>{
    if(docName.value==""){
        docNameError.classList.add("error-visible");
        docNameError.classList.remove("error-hidden");
        docNameError.innerText="Field cannot be blank";
        docNameSubmit=false;
    }else{
        docNameError.classList.add("error-hidden");
        docNameError.classList.remove("error-visible");
        docNameSubmit=true;
    }
});

//document
edoc.addEventListener("change",()=>{
    if(edoc.value == null){
        edocSubmit=false;
    }else{
        edocSubmit=true;
    }
});


//Submit Button Visibility
const buttonCursor=document.querySelector(".dBtn");//To avoid poniterevent and cursor problem
addDocForm.addEventListener("change",()=>{
    if(docNameSubmit==true && edocSubmit==true){
        addDocBtn.classList.remove("disabled");
        buttonCursor.classList.remove("cursor-disabled");
    }else{
        addDocBtn.classList.add("disabled");
        buttonCursor.classList.add("cursor-disabled");
    }
});

//===============End of validate task=====================