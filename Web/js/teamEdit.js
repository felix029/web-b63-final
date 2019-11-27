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

    $("#newmemberbtn").click( e =>{
        
        let check = true;

        if($("#newfullname").val() == ""){
            $("#newfullname").css("border", "solid red 2px");
            check = false;
        }
        if($("#newjob").val() == "none"){
            $("#newjob").css("border", "solid red 2px");
            check = false;
        }
        if($("#newbio").val() == ""){
            $("#newbio").css("border", "solid red 2px");
            check = false;
        }

        if(document.getElementById("newphoto").files.length == 0){
            $("#newphoto").css("border", "solid red 2px");
            check = false;
        }

        if(!check){
            e.preventDefault();
        }
    });

})