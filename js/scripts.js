/*$(document).ready(function() {
    // Este código se ejecuta cuando el documento HTML ha sido completamente cargado

    // Ejemplo: Obtener la lista de usuarios al cargar la página
    obtenerUsuarios();

    // Función para obtener la lista de usuarios
    function obtenerUsuarios() {
        $.ajax({
            url: '/Controllers/UserController.php?action=obtenerUsuarios', // URL del script PHP que obtiene la lista de usuarios
            type: 'GET',
            success: function(response) {
                // Manipular la respuesta y mostrar la lista de usuarios en la página
                $('#usuarios-lista').html(response);
            },
            error: function(xhr, status, error) {
                // Manejar errores de la solicitud AJAX
                console.error(xhr.responseText);
            }
        });
    }

    // Ejemplo: Manejar el envío del formulario para agregar un nuevo usuario
    $('#formulario-agregar-usuario').submit(function(event) {
        event.preventDefault(); // Evitar el envío del formulario por defecto

        // Obtener los datos del formulario
        var nombre = $('#nombre').val();
        var email = $('#email').val();

        // Realizar una solicitud AJAX para agregar el usuario
        $.ajax({
            url: 'backend/agregar_usuario.php', // URL del script PHP para agregar usuarios
            type: 'POST',
            data: { nombre: nombre, email: email }, // Datos a enviar al servidor
            success: function(response) {
                // Manipular la respuesta del servidor (por ejemplo, mostrar un mensaje de éxito)
                console.log('Usuario agregado correctamente.');
                // Actualizar la lista de usuarios después de agregar uno nuevo
                obtenerUsuarios();
            },
            error: function(xhr, status, error) {
                // Manejar errores de la solicitud AJAX
                console.error(xhr.responseText);
            }
        });
    });

    // Otros eventos y funciones de jQuery pueden agregarse según sea necesario
});*/



