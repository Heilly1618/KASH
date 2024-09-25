<?php
    require 'conectUser.php';

    if (!$conectar) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    $tema = $_POST['tema'];
    $contenido = $_POST['comentario'];
    $anonimo = $_POST['anonimo'];
    $id_foro = $_POST['id_foro']; 
    $nombre = $_POST['nombre'];
    $pass = $_POST['pass'];

    // Verificar si el id_foro existe en la tabla foro
    $query_foro = "SELECT ID FROM foro WHERE ID = ?";
    $stmt_foro = $conectar->prepare($query_foro);
    $stmt_foro->bind_param("i", $id_foro);
    $stmt_foro->execute();
    $result_foro = $stmt_foro->get_result();

    if ($result_foro->num_rows == 0) {
        echo "<script>alert('El ID del foro no es válido.');</script>";
        exit();
    }

    // Validar usuario si no es anónimo
    if ($anonimo == "si") {
        $nombreUsuario = "Anónimo";
    } else {
       
        $query = "SELECT usuario FROM usuarios WHERE usuario = ? AND pass = ?";
        $stmt = $conectar->prepare($query);
        $stmt->bind_param("ss", $nombre, $pass); // Especificar tipos de datos
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $nombreUsuario = $user['usuario']; 
        } else {
            echo "<script>alert('Usuario no registrado o datos incorrectos.');window.location.href = '../html/foro.php';</script>";
            exit();
        }
    }

    // Insertar el comentario
    $sql = "INSERT INTO comentario (IDforo, nombre, contenido) VALUES (?, ?, ?)";
    $stmt = $conectar->prepare($sql);
    $stmt->bind_param("iss", $id_foro, $nombreUsuario, $contenido);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Comentario guardado exitosamente.'); window.location.href = '../html/foro.php';</script>";
    } else {
        echo "<script>alert('Error al guardar el comentario.');</script>";
    }

    $conectar->close();
?>
