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

                $("#edit-offer-salary").val(infos[0]);
                $("#edit-offer-desc").val(infos[1]);
            })
        }
        else{
            $("#edit-offer-salary").val("");
            $("#edit-offer-desc").val("");
        }
    });

});