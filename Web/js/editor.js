let save = null;

window.addEventListener("load", () => {    
    
    let toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],
        [{'font' : []}],
        [{'align' : []}],
        [{'color' : [] }, { 'background' : [] }],
        ['blockquote', 'code-block'],
        [{'header': [1, 2, 3, 4, 5, 6, false]}],
        [{'list': 'ordered'}, {'list': 'bullet'}],
        [{'script':'sub'},{'script':'super'}],
        [{'indent':'-1'},{'indent':'+1'}],
        [{'direction':'rtl'}],
        [{'size':['small', false, 'large', 'huge']}],
        ['link', 'image', 'video', 'formula'],
    ];
    let quill = new Quill("#content", {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow'
    })

    save = document.getElementById("save-btn");
    
    save.onclick = () => {
        document.getElementById("content").innerHTML = quill.container.firstChild.innerHTML;
    }
})
