<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="css/stylesFront.css">

</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="front.php">Front-End</a></li>
                <li><a href="index.php" target="self">Backend</a></li>
            </ul>
        </nav>
    </header>
    <h1>Listado de Usuarios Obtenidos con JQuery</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Fecha de Creación</th>
                    <th>Fecha de Actualización</th>
                </tr>
            </thead>
            <tbody id="userList">
                <!-- Acá mostramos la lista de usuarios -->
            </tbody>
        </table>

    <script>
        $(document).ready(function() {
            // Realizar una solicitud AJAX para obtener los datos de los usuarios
            $.ajax({
                url: 'getUserList.php', // URL del script que obtiene los datos de los usuarios
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Recorrer la respuesta y agregar cada usuario a la tabla
                    $.each(response, function(index, user) {
                        $('#userList').append('<tr><td>' + user.id + '</td><td>' + user.name + '</td><td>' + user.surname + '</td><td>' + user.email + '</td><td>' + user.created_at + '</td><td>' + user.updated_at + '</td></tr>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error al obtener los datos de los usuarios:', error);
                }
            });
        });
    </script>
    <footer>
        <p>Challenge Urbano - Front-End</p>
    </footer>
</body>
</html>