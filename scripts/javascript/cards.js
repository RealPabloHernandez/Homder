const cards = document.getElementsByClassName("card");

if(cards){
    Array.from(cards).forEach(card => {
        let save = card.querySelectorAll(".card__save");
        Array.from(save).forEach(s=>{
            s.addEventListener("click", (e)=>{
                console.log("Save");
                e.stopPropagation();
            })
        })
    });
}
let prices = document.getElementsByClassName("card__price");
let priceWidth = document.querySelector(".card__preview");
adaptPricesWidth();

addEventListener("resize",()=>{
    adaptPricesWidth();
})

function adaptPricesWidth(){
    if(priceWidth && prices){
        let width=priceWidth.clientWidth;
        for (let i = 0; i < prices.length; i++) {
            prices[i].style.width=width+"px";
        }
    }
}