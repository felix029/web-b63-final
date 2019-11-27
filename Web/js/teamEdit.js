$(document).ready(function () {
    $("#editname").change( () => {
        let val = $("#editname").val();
        if(val != 'none'){
            $.ajax({
                url: "ajax-equipe.php",
                type: "POST",
                data:{
                    value: val
                }
            }).done( bio => {
               $("#editbio").val(bio);
            })
        }
        else{
            $("#editbio").val("");
        }
    });
})