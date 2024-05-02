<?php include_once("views/header.php");?>
    <body>
        <h1>Listado de Usuarios</h1>

        </br></br>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Surname</th>
                <th>E-Mail</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
            <?php
            foreach ($datos as $dato) {
                echo "<tr><td>" . $dato["id"] . "</td>";
                echo "<td>" . $dato["name"] . "</td>";
                echo "<td>" . $dato["surname"] . "</td>";
                echo "<td>" . $dato["email"] . "</td>";
                echo "<td>" . $dato["created_at"] . "</td>";
                echo "<td>" . $dato["updated_at"] . "</td>";
                echo "<td>";
                echo "<a href='?controller=user&action=updateUser&id=" . $dato["id"] . "'>Editar</a> | ";
                echo "<a href='?controller=user&action=deleteUser&id=" . $dato["id"] . "' onclick='confirmDelete(" . $dato["id"] . ")'>Eliminar</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <script>
            function confirmDelete(userId) {
                if (confirm("¿Estás seguro de que deseas eliminar este usuario?")) {
                   // window.location.href = "?controller=user&action=deleteUser&id=" + userId;
                }
            }
        </script>
    </body>
<?php include_once("views/footer.php");?>
