$("#btnGuardar").click(function(){
    var markupStr = $('#summernote').summernote('code');
    alert(markupStr);
    $('#summernote').summernote('code', markupStr + puto);

});