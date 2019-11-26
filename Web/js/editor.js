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
        [{'color' : ["#000000", "#e60000", "#ff9900", "#ffff00", "#008a00", "#0066cc", "#9933ff", "#ffffff", "#facccc", "#ffebcc", "#ffffcc", "#cce8cc", "#cce0f5", "#ebd6ff", "#bbbbbb", "#f06666", "#ffc266", "#ffff66", "#66b966", "#66a3e0", "#c285ff", "#888888", "#a10000", "#b26b00", "#b2b200", "#006100", "#0047b2", "#6b24b2", "#444444", "#5c0000", "#663d00", "#666600", "#003700", "#002966", "#3d1466", "#fad390", "#f8c291", "#6a89cc", "#82ccdd", "#b8e994", "#f6b93b", "#e55039", "#4a69bd", "#60a3bc", "#78e08f",
        "#fa983a", "#eb2f06", "#1e3799", "#3c6382", "#38ada9", "#e58e26", "#b71540", "#0c24610", "#0a3d62", "#079992", 'custom-color'] }, 
        { 'background' : ["#000000", "#e60000", "#ff9900", "#ffff00", "#008a00", "#0066cc", "#9933ff", "#ffffff", "#facccc", "#ffebcc", "#ffffcc", "#cce8cc", "#cce0f5", "#ebd6ff", "#bbbbbb", "#f06666", "#ffc266", "#ffff66", "#66b966", "#66a3e0", "#c285ff", "#888888", "#a10000", "#b26b00", "#b2b200", "#006100", "#0047b2", "#6b24b2", "#444444", "#5c0000", "#663d00", "#666600", "#003700", "#002966", "#3d1466", "#fad390", "#f8c291", "#6a89cc", "#82ccdd", "#b8e994", "#f6b93b", "#e55039", "#4a69bd", "#60a3bc", "#78e08f",
        "#fa983a", "#eb2f06", "#1e3799", "#3c6382", "#38ada9", "#e58e26", "#b71540", "#0c2461", "#0a3d62", "#079992", 'custom-color'] }],
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

    //Adding custom colors
    quill.getModule('toolbar').addHandler('color', value =>{
        if(value == 'custom-color'){
            value = prompt('Enter HEX/RGB/RGBA');
        }

        quill.format('color', value);
    });

    quill.getModule('toolbar').addHandler('background', value =>{
        if(value == 'custom-color'){
            value = prompt('Enter HEX/RGB/RGBA');
        }

        quill.format('background', value);
    });

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
