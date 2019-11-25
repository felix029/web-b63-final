let altKey = false;
let oneKey = false;
let pos = 0;
let elements;

document.onkeydown = event =>{
    if(event.which == 18) altKey = true;
    if(event.which == 49) oneKey = true;

    if(altKey && oneKey) window.location.href = "admin-login.php"
}

document.onkeyup = event =>{
    if(event.which == 18) altKey = false;
    if(event.which == 49) oneKey = false;
}

window.addEventListener('resize', () => {
    resize();
});


window.addEventListener("load", () =>{
    let done = true;

    resize();

    $('#hamburger').click( () => {

        if($('#list:hidden') && done == true){
            done = false;
            $('#hamburger').css("background-color", "#f8c291");
            $('#list').slideDown(1000, () => {
                $('#hamburger').css("background-image", "url(images/x.png)");
                done = true;
            });
        }

        if($('#list:visible') && done == true){
            done = false;
            $('#list').slideUp(1000, () => {
                $('#hamburger').css("background-image", "url(images/hamburger.png)");
                $('#hamburger').css("background-color", "transparent");
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

const resize = () => {
    //Adjusting div #content height for mobile
    //source: https://css-tricks.com/the-trick-to-viewport-units-on-mobile/
    let vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);
}