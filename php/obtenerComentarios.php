    <?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "kash";

    $conectar = mysqli_connect($host, $user, $pass, $db);

    if (!$conectar) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    if (isset($_GET['id_foro'])) {
        $id_foro = intval($_GET['id_foro']);
        $sql = "SELECT nombre, contenido FROM comentario WHERE IDforo = ?";
        $stmt = $conectar->prepare($sql);
        $stmt->bind_param("i", $id_foro);
        $stmt->execute();
        $result = $stmt->get_result();

        $comentarios = [];
        while ($row = $result->fetch_assoc()) {
            $comentarios[] = [
                'nombre' => htmlspecialchars($row['nombre']),
                'contenido' => nl2br(htmlspecialchars($row['contenido'])),
            ];
        }

        echo json_encode($comentarios);
    }

    $conectar->close();
    ?>
