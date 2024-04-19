$(document).ready(function() {
    $('#dropdownMenuButton').on('click', function(e) {
        e.preventDefault();
        cargarListaMascotas();
    });

    function cargarListaMascotas() {
        $.ajax({
            url: 'obtener_mascotas.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                mostrarMascotas(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function mostrarMascotas(mascotas) {
        // Limpiar la tabla actual, si es necesario
        $('#myTable tbody').empty();

        // Agregar las mascotas a la tabla
        mascotas.forEach(function(mascota) {
            $('#myTable tbody').append(`
                <tr>
                    <td>${mascota.idmascota}</td>
                    <td>${mascota.nombre}</td>
                    <td>${mascota.idespecie}</td>
                    <td>${mascota.idraza}</td>
                    <td>${mascota.idusuarios}</td>
                    <td>${mascota.peso}</td>
                    <td>${mascota.sexo}</td>
                    <td>${mascota.color}</td>
                    <td>${mascota.edad}</td>
                    <td>${mascota.fecha_creada}</td>
                    <td>${mascota.active}</td>
                </tr>
            `);
        });
    }
});