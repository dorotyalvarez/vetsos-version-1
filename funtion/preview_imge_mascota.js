document.getElementById('imagen-mascota').addEventListener('change', function() {
    var file = this.files[0];
    var reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('imagen-preview-mascota').src = e.target.result;
    }
    reader.readAsDataURL(file);
});