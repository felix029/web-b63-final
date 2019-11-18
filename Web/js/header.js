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

})