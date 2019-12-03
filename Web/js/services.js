window.addEventListener("load", () => {
    let done = true;
    
    $('#reservation-mobile').click( () => {
        if($('#reservation:hidden') && done == true){
            done = false;
            document.getElementById("reservation-mobile").innerHTML = "<h1>Quitter</h1>"
            $('#reservation').fadeIn(1000, () => {
                done = true;
            });
        }

        if($('#reservation:visible') && done == true){
            done = false;
            document.getElementById("reservation-mobile").innerHTML = "<h1>Cliquez ici pour réserver</h1>"
            $('#reservation').fadeOut(1000, () => {
                done = true;
            });
        }
    })
})