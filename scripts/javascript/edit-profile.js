let fileInput=document.querySelector("#profile__picture");

fileInput.addEventListener("change", ()=>{
    let file = fileInput.files;

    const reader = new FileReader();
    reader.readAsDataURL(file[0])

    reader.addEventListener("load", (e)=>{
        const target = document.querySelector(".profile__picture-image");
        target.setAttribute("src", e.target.result+"");
    }, false);
})