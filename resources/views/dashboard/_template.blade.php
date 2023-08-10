
{!! $templateContent !!}

<button id="save-button">
    save
</button>


<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    var templateName = "{{$templateName}}"

    tinymce.init({
        selector: 'div#template', // Replace this CSS selector to match the placeholder element for TinyMCE
        // inline: true,
        menubar: false,
        plugins: [
            'link', 'lists', 'powerpaste',
            'autolink', 'tinymcespellchecker'
        ],
        toolbar: [
            'undo redo | bold italic underline | fontfamily fontsize',
            'forecolor backcolor | alignleft aligncenter alignright alignfull | numlist bullist outdent indent'
        ],
        valid_styles: {
            '*': 'font-size,font-family,color,text-decoration,text-align'
        },

    });
    function getModifiedContent() {
        var modifiedContent = tinymce.activeEditor.getContent();
        return modifiedContent;
    }

    document.getElementById('save-button').addEventListener('click', function() {
        // Get the modified content from TinyMCE
        var modifiedContent = getModifiedContent();
        const beginningContent = "<div id=\"template\">\n"
        const endingContent = "\n</div>"
        var resultModification = beginningContent + modifiedContent + endingContent

        console.log(modifiedContent)
        // Update the template with the modified content

        axios.post('/save-template/'+templateName, {
            modifiedBody: resultModification,
        }).then(response => {
            window.location.replace("http://localhost:8000/dashboard");
        }).catch(error => {
            console.log(error)
        })







        // You can also send the modifiedContent to the server-side for saving
        // For example, use Ajax to send the data back to the server
        // ...
        // console.log(document.getElementById('template1'))

        // Optionally, show a success message to the user
        // alert('Template updated and saved!');
    });
</script>




