const pics_src = ["../html/assets/img/beer1.jpg","../html/assets/img/beer2.jpg","../html/assets/img/beer3.jpg","../html/assets/img/beer4.jpg","../html/assets/img/beer5.jpg"];
let num = -1;
function slideshow_timer(){
  if (num === 4){
    num = 0;
  } 
  else {
    num ++;
  }
  document.getElementById("mypic").src = pics_src[num];
}
setInterval(slideshow_timer, 2500);