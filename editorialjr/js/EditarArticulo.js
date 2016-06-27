$("#btnGuardar").click(function(){
    var markupStr = $('#summernote').summernote('code');
    alert(markupStr);
});