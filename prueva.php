<!DOCTYPE html>
<html lang="en">
<head>


SELECT 
    b.*,
    c.id_Comentario,
    c.comentario,
    u.nombre AS nombre_usuario,
    u.imagen AS imagen_usuario,
    rc.id_Respuesta,
    rc.respuesta,
    a.nombre AS nombre_admin,
    a.imagen AS imagen_admin
    
FROM 
    blogs AS b
LEFT JOIN 
    comentarios_blog AS c ON b.id_Blog = c.id_Blog
LEFT JOIN 
    usuarios AS u ON c.id_User = u.id_User
LEFT JOIN 
    respuestas_comentario_blog AS rc ON c.id_Comentario = rc.id_Comentario
LEFT JOIN 
    administradores AS a ON rc.id_Admin = a.id_Admin;
    










    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Importa los estilos CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/2.0.1/css/select.dataTables.css">
</head>
<body>
<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>
            <th>Start date</th>
            <th>Salary</th>
        </tr>
    </thead>
    <tbody>
        <!-- Tu contenido de la tabla -->
    </tbody>
    <tfoot>
        <tr>
            <th>Name</th>
            <th>Position</th>
            <th>Office</th>
            <th>Age</th>
            <th>Start date</th>
            <th>Salary</th>
        </tr>
    </tfoot>
</table>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/select/2.0.1/js/dataTables.select.js"></script>
<script src="https://cdn.datatables.net/select/2.0.1/js/select.dataTables.js"></script>
<script>
    new DataTable('#example', {
        layout: {
            topStart: {
                buttons: [
                    'copy',
                    'csv',
                    'excel',
                    'pdf',
                    {
                        extend: 'print',
                        text: 'Print all (not just selected)',
                        exportOptions: {
                            modifier: {
                                selected: null
                            }
                        }
                    }
                ]
            }
        },
        select: true
    });
</script>
</body>
</html>
