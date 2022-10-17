const access_ref=document.getElementById("access-ref");
const login_modal=document.getElementById("access-modal");
const close_modal=document.getElementById("close-modal");

access_ref.addEventListener("click", ()=>{
    login_modal.showModal();
});

close_modal.addEventListener("click", ()=>{
    login_modal.close();
});