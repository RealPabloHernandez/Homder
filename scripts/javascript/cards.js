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