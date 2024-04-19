document.getElementById('imagen').addEventListener('change', function() {
    var file = this.files[0];
    var reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('imagen-preview').src = e.target.result;
    }
    reader.readAsDataURL(file);
});