//-----------------------------HEADER------------------

 //Lăn chuột vẫn hiển thị header
    const header = document.querySelector("header");
    window.addEventListener("scroll",function(){
        x = window.pageYOffset;
        if(x > 0){
            header.classList.add("sticky");
        }
        else{
            header.classList.remove("sticky");
        }
    })
   const imgPosition = document.querySelectorAll(".aspect-ratio-169 img");
   const imgContainer = document.querySelector(".aspect-ratio-169");
   const dotItems = document.querySelectorAll(".dot");

   let imgNumber = imgPosition.length;
   let index = 0;
   //Để slide ảnh nằm ngang (ảnh đầu 0, kế 100%, 200%,....)
   imgPosition.forEach(function(image,index){
       image.style.left = index*100 + "%";
       
       //Bấm vào dot
       dotItems[index].addEventListener("click",function(){
           slider(index);
       })
   })

   function imgSlide(){
       index ++;
       if(index >= imgNumber){
           index=0;
       }
       slider(index); 
   }

   //Thẻ cha dịch chuyển sang bên trái giá trị âm
   function slider(index) {
       imgContainer.style.left = "-" +index*100+ "%";

       const dotActive = document.querySelector(".active");
       dotActive.classList.remove("active");

       dotItems[index].classList.add("active"); 
   }
   setInterval(imgSlide,5000);


//------------------------CARTEGORY--------------------------------
const itemsSliderBar = document.querySelectorAll(".cartegory-left-li");
itemsSliderBar.forEach(function(menu,index){
    menu.addEventListener("click", function(){
        menu.classList.toggle("block");
   })
})

// ------------------------PRODUCT----------------

//
const bigImg = document.querySelector(".product-content-left-big-img img");
const smallImg = document.querySelectorAll(".product-content-left-small-img img");
smallImg.forEach(function(imgItem,X){
    imgItem.addEventListener("click",function(){
        bigImg.src = imgItem.src
    })
})

//Khi click vào chi tiết chỉ hiển thị chi tiết, bảo quản thì hiển thị bảo quản
const maintain = document.querySelector(".maintain");
const detail = document.querySelector(".detail");
if(maintain){
    maintain.addEventListener("click",function(){
        document.querySelector(".product-content-right-bottom-content-detail").style.display = "none";
        document.querySelector(".product-content-right-bottom-content-maintain").style.display = "block";
    })
}
if(detail){
    detail.addEventListener("click",function(){
        document.querySelector(".product-content-right-bottom-content-detail").style.display = "block";
        document.querySelector(".product-content-right-bottom-content-maintain").style.display = "none";
    })
}

//Ấn vào để hiển thị chi tiết
const buttonUpDown = document.querySelector(".product-content-right-bottom-top");
if(buttonUpDown){
    buttonUpDown.addEventListener("click",function(){
        document.querySelector(".product-content-right-bottom-content-big").classList.toggle("activeUpDown");
    })
}