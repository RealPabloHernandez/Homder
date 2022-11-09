let postFile=document.querySelector("#postFiles");
let fileText = document.querySelector(".fileText");
let price = document.querySelector("#price");
let fileLabel = document.querySelector(".fileLabel");

if(fileLabel){
    fileLabel.addEventListener("click", ()=>{
        let pr=fileLabel.previousSibling;
        pr.click();
    })
}

if(price){
    price.addEventListener("change", ()=>{
        price.value=formatCurrency(price.value);
    })

    price.addEventListener("focusout",()=>{
        price.value=formatCurrency(price.value);
    })

    price.addEventListener("focus", ()=>{
        price.value=cleanCurrency(price.value);
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
    value=cleanCurrency(value);
    value=isNaN(value)? "":value;

    return new Intl.NumberFormat("en-US",{
        style:"currency",
        currency:"COP",
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(value)
}

function cleanCurrency(value){
    value=value.replaceAll("COP","");
    value=value.replaceAll(",","");
    value=value.replaceAll(".","");
    return value;
}