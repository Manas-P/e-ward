// ============== Tab content toggle ==============
const tabBtn1=document.querySelector("#tabBtn1");
const tabBtn2=document.querySelector("#tabBtn2");

const tabCon1=document.querySelector("#tabCon1");
const tabCon2=document.querySelector("#tabCon2");

tabBtn1.addEventListener("click",()=>{
  tabBtn1.classList.add("tab-active");
  tabBtn2.classList.remove("tab-active");

  tabCon1.classList.add("tab-con-active");
  tabCon2.classList.remove("tab-con-active");
});

tabBtn2.addEventListener("click",()=>{
  tabBtn2.classList.add("tab-active");
  tabBtn1.classList.remove("tab-active");

  tabCon2.classList.add("tab-con-active");
  tabCon1.classList.remove("tab-con-active");
});


// ========== End of Tab content toggle ==========