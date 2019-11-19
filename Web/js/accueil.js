let pos = 0;
let elements;

$(document).ready( () => {

  elements = document.getElementById("caroussel").children;

  setInterval(caroussel, 13000);
});

const caroussel = () => {
  
  
  if(pos == elements.length-1){ 
    $(elements[pos]).fadeOut(2000, () => {
      $(elements[0]).fadeIn(1000, () => {
        pos = 0;
      });
    });
      
  } 
  else{
    $(elements[pos]).fadeOut(2000, () => {
      $(elements[pos+1]).fadeIn(1000, () => {
        pos++;
      });
    });
  }
}