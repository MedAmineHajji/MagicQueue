@extends('layout')


@section('content')
    <div style="margin-top: 60px">
        <div class="row w-100">
            <div class="col-lg-3 vh-100" style="background-color: azure">
                <h3>
                    Templates List
                </h3>
                <ul>
                    @foreach ($templates as $template)
                        <li>
                            <a href="{{ '/dashboard?template=' . $template->getFilename() }}">
                                {{ str_replace('.blade.php', '', $template->getFilename()) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            
                <div class="col-lg vh-100" >
                    <div style="margin-left: auto; margin-right: auto; margin-top: 10%; width: 60%; height:400px; background-color:white">
                        @if (isset($templateContent))
                            <div id="template">
                                @include('dashboard._template')
                            </div>
                    </div>
                            <button id="save-button" style="margin-left: 20%; margin-right: auto; ">
                                save
                            </button>
                        @else 
                            <div id="template">
                                <p>Please select a template</p>
                            </div>
                    </div>
                            <button style="margin-left: 20%; margin-right: auto; " id="save-button" disabled>
                                save
                            </button>
                        @endif
                    </div>

                    
                    {{-- <div style="margin-left: auto; margin-right: auto; width: 60%;">
                        
                    </div> --}}
                    
                </div>
            

        </div>
        
    </div>
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        var templateName = "{{$templateName}}";
        var templateSelector = {
            selector: 'div#template', // Replace this CSS selector to match the placeholder element for TinyMCE
            // inline: true,
            menubar: false,
            plugins: [
                'link', 'lists',
                'autolink'
            ],
            toolbar: [
                'undo redo | bold italic underline | fontfamily fontsize',
                'forecolor backcolor | alignleft aligncenter alignright alignfull | numlist bullist outdent indent'
            ],
            valid_styles: {
                '*': 'font-size,font-family,color,text-decoration,text-align'
            },
        };

        tinymce.init(templateSelector);
        function getModifiedContent() {
            var modifiedContent = tinymce.activeEditor.getContent();
            return modifiedContent;
        }

        document.getElementById('save-button').addEventListener('click', function() {
            // Get the modified content from TinyMCE
            var modifiedContent = getModifiedContent();

            console.log(modifiedContent)
            // Update the template with the modified content

            axios.post('/save-template/'+templateName, {
                modifiedBody: modifiedContent,
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
@endsection
