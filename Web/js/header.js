let ctrlKey = false;
let oneKey = false;
let pos = 0;
let elements;

document.onkeydown = event =>{
    if(event.which == 17) ctrlKey = true;
    if(event.which == 49) oneKey = true;

    if(ctrlKey && oneKey) window.location.href = "admin-login.php"
}

document.onkeyup = event =>{
    if(event.which == 17) ctrlKey = false;
    if(event.which == 49) oneKey = false;
}


window.addEventListener("load", () =>{
    let done = true;


    $('#hamburger').click( () => {
        
        if($('#list:hidden') && done == true){
            done = false;
            $('#list').slideDown(1000, () => {
                $('#hamburger').css("background-image", "url(images/x.png)");
                done = true;
            });
        }
        
        if($('#list:visible') && done == true){
            done = false;
            $('#list').slideUp(1000, () => {
                $('#hamburger').css("background-image", "url(images/hamburger.png)");
                done = true;
            });
        }        
    });

    elements = document.getElementById("carousel").children;

    setInterval(carousel, 20000);

})

const carousel = () => {
  
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