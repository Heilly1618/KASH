<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coordinador - Control de Usuarios</title>
    <link rel="stylesheet" href="../../css/coordinador/usuarios.css">
</head>
<body>
    <div class="barra">
        <div class="selection">
            <img class="icono" src="../../img/perfil.png" alt="">
            <a href="coordinador.php" class="link">Mi perfil</a>
        </div>
        <div class="selection">
            <img class="icono" src="../../img/pqrs.png" alt="">
            <a href="PQRS.php" class="link">Revisar PQRS</a>
        </div>
        <div class="selection">
            <img class="icono" src="../../img/asesoria.png" alt="">
            <a href="usuarios.php" class="link">Control de usuarios</a>
        </div>
        <div class="selection">
            <img class="icono" src="../../img/foro.png" alt="">
            <a href="foros.php" class="link">Control de foros</a>
        </div>
        <div class="cerrar_sesion">
                <button class="btn-cerrar-sesion"><a href="../principal2.html">Cerrar sesión</a></button>
        </div>
    </div>

    <div class="cuerpo">
        <header>
            <img class="logo" src="../../img/Logo-removebg-preview (1).png" alt="">
            <p>WELCOME</p>
            <h1>KASH</h1>
        </header>

        <!-- Formulario de búsqueda -->
        <div class="form-container">
            <form method="POST" action="">
                <label for="buscar">Buscar por IDusuario:</label>
                <input type="text" name="buscar" id="buscar" placeholder="Ingrese IDusuario">
                <button type="submit">Buscar</button>
            </form>
        </div>

        <!-- Mostrar la lista de usuarios -->
        <h2>Lista de Usuarios:</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Tipo de documento</th>
                        <th>Numero documento</th>
                        <th>Nombre</th>
                        <th>Rol</th>
                        <th>Fecha de nacimiento</th>
                        <th>Trimestre</th>
                        <th>Correo</th>
                        <th>Número</th>
                        <th>Usuario</th>
                        <th>Password</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                
                $host = "localhost";
                $username = "root";
                $pass = "";
                $db = "kash"; 

                $conectar = new mysqli($host, $username, $pass, $db);

                // Verificar la conexión
                if ($conectar->connect_error) {
                    die("Conexión fallida: " . $conectar->connect_error);
                }

                // Obtener el término de búsqueda
                $buscar = isset($_POST['buscar']) ? $_POST['buscar'] : '';

                // Consulta SQL para buscar usuarios
                if (!empty($buscar)) {
                    $sql = "SELECT * FROM usuarios WHERE IDusuario LIKE '%$buscar%'";
                } else {
                    $sql = "SELECT * FROM usuarios";
                }

                $result = $conectar->query($sql);

                if ($result->num_rows > 0) {
                    // Mostrar cada usuario en una fila de la tabla
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['tdocumento'] . "</td>
                                <td>" . $row['IDusuario'] . "</td>
                                <td>" . $row['nombres'] . " " . $row['primerA'] . " " . $row['segundoA'] . "</td>
                                <td>" . $row['rol'] . "</td>
                                <td>" . $row['fnacimiento'] . "</td>
                                <td>" . $row['trimestre'] . "</td>
                                <td>" . $row['correo'] . "</td>
                                <td>" . $row['numero'] . "</td>
                                <td>" . $row['usuario'] . "</td>
                                <td>" . $row['pass'] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No se encontraron usuarios</td></tr>";
                }

                // Cerrar conexión
                $conectar->close();
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
