// Función para actualizar la hora cada segundo
function actualizarHora() {
    // Obtener el elemento <p> donde se muestra la hora
    var horaElement = document.getElementById('hora');

    // Función para obtener la hora actual en formato de 12 horas con AM/PM
    function obtenerHora() {
        var fecha = new Date();
        var horas = fecha.getHours();
        var minutos = fecha.getMinutes();
        var segundos = fecha.getSeconds();
        var ampm = horas >= 12 ? 'PM' : 'AM';
        horas = horas % 12;
        horas = horas ? horas : 12; // Las 12 horas en punto deben mostrarse como 12, no como 0
        minutos = minutos < 10 ? '0' + minutos : minutos;
        segundos = segundos < 10 ? '0' + segundos : segundos;
        return horas + ':' + minutos + ':' + segundos + ' ' + ampm;
    }

    // Actualizar el contenido del elemento <p> con la hora actual
    horaElement.textContent = 'Barrancabermeja ' + obtenerHora();
}

// Llamar a la función actualizarHora cada segundo
setInterval(actualizarHora, 1000);