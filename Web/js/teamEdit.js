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
            }).done( rep => {
                let bio = JSON.parse(rep);
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

    $("#fullnamepos").change( () => {
        let val = $("#fullnamepos").val();
        if(val != "none"){
            $.ajax({
                url: "ajax-equipe.php",
                type: "POST",
                data:{
                    memberpos: val
                }
            }).done( rep => {

                let pos = JSON.parse(rep);
                let option = document.createElement('option');
                option.setAttribute("value", pos);
                option.setAttribute("selected", "");
                option.innerHTML = pos;
               
                document.getElementById("memberpos").innerHTML = "";
                document.getElementById("memberpos").appendChild(option);

                $.ajax({
                    url: "ajax-equipe.php",
                    type: "POST",
                    data:{
                        allpos: pos
                    }
               }).done( rep => {
                    let positions = JSON.parse(rep);
                    
                    positions.forEach(e => {
                        let option = document.createElement('option');
                        option.setAttribute("value", e);
                        option.innerHTML = e;
                        document.getElementById("memberpos").appendChild(option);
                    });
               });
            });
        }
        else{
            document.getElementById("memberpos").innerHTML = "";
        }
    });

    $("#memberpos").change( () => {
        let name = $("#fullnamepos").val();
        let newpos = $("#memberpos").val();
        if(name != "none"){
            $.ajax({
                url: "ajax-equipe.php",
                type: "POST",
                data:{
                    membereditpos: name,
                    membernewpos: newpos
                }
            }).done( () => {
                window.location.href = "equipe.php";
            });
        }
    })

})