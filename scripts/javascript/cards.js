const cards = document.getElementsByClassName("card");

Array.from(cards).forEach(card => {
    let save = card.querySelectorAll(".card__save");
    Array.from(save).forEach(s=>{
        s.addEventListener("click", (e)=>{
            console.log("Save");
            e.stopPropagation();
        })
        
    })

    card.addEventListener("click", ()=>{
        console.log("CARD");
    });    
});

let prices = document.getElementsByClassName("card__price");
let priceWidth = document.querySelector(".card__preview");
//let timeOutFunctionID;
adaptPricesWidth();

addEventListener("resize",()=>{
    adaptPricesWidth();
    //clearTimeout(timeOutFunctionID);
    //timeOutFunctionID = setTimeout(adaptPricesWidth, 500);
})

function adaptPricesWidth(){
    let width=priceWidth.clientWidth;
    for (let i = 0; i < prices.length; i++) {
        prices[i].style.width=width+"px";
    }
}