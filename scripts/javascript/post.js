let postFile=document.querySelector("#postFiles");
let fileText = document.querySelector(".fileText");
let price = document.querySelector("#price");

if(price){
    price.addEventListener("change", ()=>{
        price.value=price.value.replaceAll(",",".");
        price.value=formatCurrency(price.value);
    })
}

if(postFile){
    postFile.addEventListener("change", ()=>{
        let f=postFile.files;

        let text="";
        for(let i=0; i<f.length; i++){
            text+=f[i].name;
            if(i<f.length-1){
                text+=", ";
            }
        }

        if(f.length===0){
            text="Sin archivos seleccionados";
        }
        fileText.textContent=text;
    })
}

function formatCurrency(value){
    return new Intl.NumberFormat("es-CO",{
        style:"currency",
        currency:"COP"
    }).format(value)
}