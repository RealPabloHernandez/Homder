let galleryItems=new Array();
let gallery = createGallery();
let currentImage=0;
let nextImage=1;
let previousImage=-1;

gallery.addEventListener("close", ()=>{
    gallery.close();
})

gallery.addEventListener("click", (e)=>{
    let rect = gallery.getBoundingClientRect();
    let isInDialog=(e.target!=gallery);
    if (!isInDialog) {
        gallery.close();
    }
})

function addToGallery(image){
    galleryItems.push(image);
}

function createGallery(){
    let gallery = document.createElement("dialog");
    gallery.className="galleryViewer";
    gallery.innerHTML=`
        <img src="" alt="Vista" class="galleryViewer__view">
    `
    if(galleryItems.length>1){
        gallery.innerHTML+=`
        <div class="galleryViewer__left"><img src="http://localhost/Homder/img/icons/angle-left-solid.svg" alt="Imagen anterior"></div>
        <div class="galleryViewer__right"><img src="http://localhost/Homder/img/icons/angle-right-solid.svg" alt="Imagen siguiente"></div>`;
    }
    return gallery;
}

function openGallery(){
    if(!document.querySelector(".galleryViewer")){
        document.body.appendChild(gallery);
    }
    updateGalleryView(galleryItems[currentImage]);
    if(galleryItems.length>1){
        gallery.querySelector(".galleryViewer__left").addEventListener("click", previousGalleryView);
        gallery.querySelector(".galleryViewer__right").addEventListener("click", nextGalleryView);
    }
    gallery.showModal();
    gallery.scrollIntoView({behavior:"smooth", block:"center", inline:"center"});
    console.info(galleryItems);
}

function updateGalleryView(){
    let image = gallery.querySelector(".galleryViewer__view");
    image.setAttribute("src", galleryItems[currentImage]);
    image.style.height=screen.height*0.7+"px";
    image.style.objectFit="cover";
    image.style.width="100%";
}

function nextGalleryView(){

    previousImage=currentImage;
    currentImage=nextImage;
    nextImage++;

    if(nextImage>=galleryItems.length){
        nextImage=0;
    }

    updateGalleryView();
}

function previousGalleryView(){
    if(previousImage<0){
        previousImage=galleryItems.length-1;
    }

    nextImage=currentImage;
    currentImage=previousImage;
    previousImage--;

    updateGalleryView();
}


