<section class="d-flex justify-content-between">
    <div class="container mt-4">
        <div class="row mt-4">
            <div class="col-md-3">..</div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Buscar Clientes por Cédula</h5>
                        <!-- Formulario con AJAX -->
                        <form id="searchForm">
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" placeholder="Buscar por cédula..." aria-label="Buscar por cédula..." id="searchInput" name="cedula">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Buscar</button>
                                </div>
                            </div>
                        </form>
                        <!-- Fin del formulario con AJAX -->
                        <!-- Contenedor para mostrar los resultados -->
                        <div id="searchResults">
                            <div id="clienteInfo"></div>
                            <ul id="mascotasList"></ul>
                            <select id="mascotaSelect" class="form-control" style="display: none;">
                            </select>
                            <button id="agendarBtn" class="btn btn-success" style="display: none;">Agendar Cita</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1">..</div>
        </div>
    </div>
</section>

<script>
    // Event listener para el formulario
    document.getElementById('searchForm').addEventListener('submit', function(event) {
        // Detener el comportamiento predeterminado del formulario
        event.preventDefault();
        // Obtener los datos del formulario
        const formData = new FormData(this);
        // Llamar a la función para realizar la búsqueda con AJAX
        searchClients(formData);
    });

    function searchClients(formData) {
        // Realizar la solicitud AJAX
        fetch('consultas/cedula.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) // Parsear la respuesta como JSON
        .then(data => {
            // Mostrar los resultados de la búsqueda en los contenedores correspondientes
            document.getElementById('clienteInfo').innerHTML = `<h2>Cliente: ${data.nombre}</h2><p>ID: ${data.id}</p>`;
            const mascotasList = document.getElementById('mascotasList');
            mascotasList.innerHTML = '<h2>Mascotas:</h2>';
            data.mascotas.forEach(mascota => {
                mascotasList.innerHTML += `<li>Nombre: ${mascota.nombre}, ID: ${mascota.id}</li>`;
            });
            // Mostrar el select de mascotas
            const mascotaSelect = document.getElementById('mascotaSelect');
            mascotaSelect.innerHTML = ''; // Limpiar opciones previas
            data.mascotas.forEach(mascota => {
                const option = document.createElement('option');
                option.value = mascota.id;
                option.textContent = mascota.nombre;
                mascotaSelect.appendChild(option);
            });
            mascotaSelect.style.display = 'block'; // Mostrar el select

            // Mostrar el botón de Agendar Cita
            document.getElementById('agendarBtn').style.display = 'block';

            // Event listener para el botón de Agendar Cita
            document.getElementById('agendarBtn').addEventListener('click', function() {
                const mascotaId = mascotaSelect.value;
                if (mascotaId) {
                    const clienteId = data.id; // Obtener el ID del cliente
                    window.location.href = `calendar.php?id_cliente=${clienteId}&id_mascota=${mascotaId}`;
                } else {
                    console.error('Por favor, selecciona una mascota para agendar la cita.');
                }
            });
        })
        .catch(error => console.error('Error:', error));
    }
</script>
