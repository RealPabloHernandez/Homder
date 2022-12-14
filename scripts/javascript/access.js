const access_ref=document.getElementById("access-ref");
const header = document.querySelector(".header");
const menuToggler = document.querySelector(".header__profile__container");
const menu = document.querySelector(".menu");
const postbtn = document.querySelector("#make-a-post");

document.body.addEventListener("click", ()=>{
    if(menu){
        if(!menu.classList.contains("menu--hidden")){
            menu.classList.toggle("menu--hidden");
        }
    }
});

if(menuToggler){
    menuToggler.addEventListener("click", (e)=>{
        e.stopPropagation();
        if(menu){
            menu.classList.toggle("menu--hidden");
        }
    })
}

if(access_ref){access_ref.addEventListener("click", ()=>{initAccess_modal()})}

function initAccess_modal(reff="login_ref", message=""){
    run_modal(reff, message);
}

function run_modal(reff, message=""){
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

    if(message!=""){
        let messageElement = document.createElement("a");
        messageElement.className="access-modal__message";
        messageElement.innerText=message;
        modal.appendChild(messageElement);
    }

    header.appendChild(modal);
    modal.showModal();

    let next = document.getElementById(nextReff);
    
    next.addEventListener("click",(e)=>{
        e.stopPropagation();
        header.removeChild(modal);
        run_modal(nextReff);
    });

    let closeModal = document.getElementById("close-modal");
    closeModal.addEventListener("click",()=>{
        modal.close();
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

        <form id="access-modal__form" method="post">
            <input type="email" class="text-input" name="email" autocomplete="username" placeholder="Correo electr??nico" aria-label="Correo electr??nico" required>
            <input type="password" class="text-input" name="password" autocomplete="current-password" placeholder="Contrase??a" aria-label="Contrase??a" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,16}$" title="Contrase??a no v??lida" required>
            <input type="submit" value="Iniciar sesi??n" name="login" class="button button--green button--bigger">
        </form>

        <div class="access-modal__extra">
            <p>??No est??s registrado?</p>
            <a class="link access-modal-reff" id ="signin_ref">Registrate aqu??</a>
        </div>
    `;

    modal.addEventListener("click", (e)=>{e.stopPropagation();});

    modal.addEventListener("close", (e)=>{
        e.stopPropagation();
        if(location.search!=""){
            location.replace(location.protocol + '//' + location.host + location.pathname);
        } 
    });

    trimInput(modal.querySelectorAll('[name="email"]')[0]);
    return modal;
}

function getSigninModal(){
    let modal = document.createElement("dialog");
    modal.setAttribute("id", "access-modal");
    // action="scripts/php/signin.php"
    modal.innerHTML=`
        <span id="close-modal"></span>
        <div class="access-modal__logo">
            <img alt="Homder Logo" class="logo">
        </div>

        <form id="access-modal__form"  method="post">
            <input type="text" class="text-input" name="name" autocomplete="name" placeholder="Nombre" aria-label="Nombre" required>
            <input type="email" class="text-input" name="email" autocomplete="email" placeholder="Correo electr??nico" aria-label="Correo electr??nico" required>
            <input type="password" class="text-input" name="password" autocomplete="new-password" placeholder="Contrase??a" aria-label="Contrase??a" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,16}$" title="Debe contener al menos un n??mero, una l??tra may??scula, una min??scula, y de 8 a 16 car??cteres." required>
            <input type="password" class="text-input" name="confirm-password" autocomplete="new-password" placeholder="Confirma tu contrase??a" aria-label="Contrase??a" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,16}$" title="Debe contener al menos un n??mero, una l??tra may??scula, una min??scula, y de 8 a 16 car??cteres." required>
            <input type="submit" value="Registrarse" name="signin" class="button button--green button--bigger">
        </form>

        <div class="access-modal__extra">
            <p>??Ya tienes cuenta?</p>
            <a class="link access-modal-reff" id ="login_ref">Inicia sesi??n</a>
        </div>
    `;


    trimInput(modal.querySelectorAll('[name="email"]')[0]);
    trimInput(modal.querySelectorAll('[name="name"]')[0]);

    let passwords=modal.querySelectorAll('[name="password"]');
    let confirms=modal.querySelectorAll('[name="confirm-password"]');
    confirms[0].addEventListener("change", ()=>{confirmPassword(passwords[0], confirms[0])});

    modal.addEventListener("close", ()=>{
        if(location.search!=""){
            location.replace(location.protocol + '//' + location.host + location.pathname);
        } 
    });
    
    return modal;
}

function confirmPassword(password, confirm){
    if(password.value!=confirm.value){
        confirm.setCustomValidity("Las contrase??as no coinciden");
        return;
    }

    confirm.setCustomValidity("");
}

function trimInput(el){
    el.addEventListener("change", ()=>{takeTrim(el)});
    el.addEventListener("focusout", ()=>{takeTrim(el)});

    function takeTrim(x){
        x.value=x.value.trim();
    }
}
