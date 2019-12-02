$(document).ready(function () {
    $("#edit-offer-title").change( () => {
        
        let val = $("#edit-offer-title").val();
        if(val != 'none'){
            let valInt = parseInt(val);
            $.ajax({
                url: "ajax-carrieres.php",
                type: "POST",
                data:{
                    id: valInt
                }
            }).done( rep => {
                let infos = JSON.parse(rep);

                console.log(infos[0]);
                console.log(infos[1]);
                $("#edit-offer-salary").val();
            })
        }
        else{
            $("#edit-offer-salary").val("");
            $("#edit-offer-desc").val("");
        }
    });

});