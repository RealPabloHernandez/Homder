const access_ref=document.getElementById("access-ref");
const header = document.querySelector(".header");

access_ref.addEventListener("click", ()=>{initAccess_modal();});

function initAccess_modal(){
    let reff = "login_ref";
    run_modal(reff);
}

function run_modal(reff){
    let modal;
    let nextReff;

    if(reff==="login_ref"){
        modal=getLoginModal();
        nextReff="signin_ref";
    }

    else{
        modal=getSigninModal();
        nextReff="login_ref";
    }

    header.appendChild(modal);
    modal.showModal();

    let next = document.getElementById(nextReff);
    next.addEventListener("click",()=>{
        modal.close();
        header.removeChild(modal);
        run_modal(nextReff);
    });

    let closeModal = document.getElementById("close-modal");
    closeModal.addEventListener("click",()=>{
        modal.close;
        header.removeChild(modal);
    });

}

function getLoginModal(){
    let modal=document.createElement("dialog");
    modal.setAttribute("id", "access-modal");

    modal.innerHTML=`
        <span id="close-modal"></span>
        <div class="access-modal__logo">
            <img alt="Homder Logo" class="logo">
        </div>

        <form action="" id="access-modal__form">
            <input type="email" class="text-input" name="email" autocomplete="username" placeholder="Correo electrónico" aria-label="Correo electrónico" required>
            <input type="password" class="text-input" name="password" autocomplete="current-password" placeholder="Contraseña" aria-label="Contraseña" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener al menos un número, una létra mayúscula, una minúscula, y al menos 8 carácteres." required>
            <input type="submit" value="Iniciar sesión" class="button button--green button--bigger">
        </form>

        <div class="access-modal__extra">
            <p>¿No estás registrado?</p>
            <a class="link access-modal-reff" id ="signin_ref" href="#">Registrate aquí</a>
        </div>
    `;

    return modal;
}

function getSigninModal(){
    let modal = document.createElement("dialog");
    modal.setAttribute("id", "access-modal");

    modal.innerHTML=`
        <span id="close-modal"></span>
        <div class="access-modal__logo">
            <img alt="Homder Logo" class="logo">
        </div>

        <form action="" id="access-modal__form">
            <input type="email" class="text-input" name="email" autocomplete="username" placeholder="Correo electrónico" aria-label="Correo electrónico" required>
            <input type="password" class="text-input" name="password" autocomplete="current-password" placeholder="Contraseña" aria-label="Contraseña" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener al menos un número, una létra mayúscula, una minúscula, y al menos 8 carácteres." required>
            <input type="password" class="text-input" name="confirm-password" autocomplete="confirm-password" placeholder="Confirma tu contraseña" aria-label="Contraseña" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener al menos un número, una létra mayúscula, una minúscula, y al menos 8 carácteres." required>
            <input type="submit" value="Iniciar sesión" class="button button--green button--bigger">
        </form>

        <div class="access-modal__extra">
            <p>¿Ya tienes cuenta?</p>
            <a class="link access-modal-reff" id ="login_ref" href="#">Inicia sesión</a>
        </div>
    `;

    return modal;
}
