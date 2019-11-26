window.addEventListener("load", () => {
    
    let pageContent = document.getElementById("contentValue").innerHTML;
    
    let Font = Quill.import('formats/font');
    Font.whitelist = ['above', 'hasta', 'inconsolata', 'roboto', 'mirza', 'arial'];
    Quill.register(Font, true);
    
    let quill = new Quill("#content", {
        theme: 'snow'
    })


    if(pageContent != "null"){
        let deltaobj = JSON.parse(pageContent);
        quill.setContents(deltaobj);
    }

    quill.enable(false);

    $(".ql-toolbar").hide();
    $(".ql-container").css("border", "none");
})