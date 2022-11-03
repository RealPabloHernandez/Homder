let postFile=document.querySelector("#postFiles");
let fileText = document.querySelector(".fileText");

postFile.addEventListener("change", ()=>{
    f=postFile.files;

    let text="";
    for(let i=0; i<f.length; i++){
        text+=f[i].name;
        if(i<f.length-1){
            text+=", ";
        }
    }
    
    if(f.length==0){
        text="Sin archivos seleccionados";
    }
    fileText.textContent=text;
})