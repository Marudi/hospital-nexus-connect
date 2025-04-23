var myEditor;
$(document).ready(function () {

    ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                editor.ui.view.editable.element.style.height = '300px';

                myEditor = editor;
            })
            .catch(error => {
                console.error(error);
            });

});