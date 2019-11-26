let save = null;

window.addEventListener("load", () => {

    let pageContent = document.getElementById("contentValue").innerHTML;

    let Font = Quill.import('formats/font');
    Font.whitelist = ['above', 'hasta', 'inconsolata', 'roboto', 'mirza', 'arial'];
    Quill.register(Font, true);

    let toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],
        [{'font' : ['', 'above', 'hasta', 'inconsolata', 'roboto', 'mirza', 'arial']}],
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

    // let Font = Quill.import('');
    // Font.whitelist = ["above", "hasta"];
    // Quill.register(Font, true);

    let quill = new Quill("#content", {
        modules: {
            toolbar: toolbarOptions
        },
        placeholder: "Cette page est vide... écrivez quelque chose!",
        theme: 'snow'
    })

    if(pageContent != "null"){
        let deltaobj = JSON.parse(pageContent);
        quill.setContents(deltaobj);
    }

    save = document.getElementById("save-btn");

    save.onclick = () => {
        let path = window.location.pathname;
        let page = path.split("/").pop();

        let deltaObj = quill.getContents()
        let content = JSON.stringify(deltaObj);

        let form = document.createElement('form');
        form.setAttribute('method', 'POST');
        form.setAttribute('action', page);

        let contentInput = document.createElement('input');
        contentInput.setAttribute('name', 'content');
        contentInput.setAttribute('type', 'hidden');
        contentInput.setAttribute('value', content);
        form.appendChild(contentInput);

        document.body.appendChild(form);
        form.submit();
    }
})
