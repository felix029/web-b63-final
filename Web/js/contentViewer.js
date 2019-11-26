window.addEventListener("load", () => {
    let quill = new Quill("#content", {
        theme: 'snow'
    })

    let pageContent = document.getElementById("contentValue").innerHTML;

    if(pageContent != "null"){
        let deltaobj = JSON.parse(pageContent);
        quill.setContents(deltaobj);
    }

    quill.enable(false);

})