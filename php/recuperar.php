<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

   require 'conectUser.php';
    

    if ($conectar->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Consulta para verificar si el correo existe
    $sql = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = $conectar->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        // Si el correo existe, puedes generar un token para el restablecimiento y enviarlo por correo
        // Aquí tendrías que configurar un servicio de envío de correo
        echo "<script>
                alert('Se ha enviado un enlace de recuperación a tu correo.');
                window.location.href = '../html/principal2.html'; 
              </script>";
    } else {
        echo "<script>
                alert('El correo no está registrado.');
                window.location.href = '../html/contraseña.php'; 
              </script>";
    }

    $stmt->close();
    $conectar->close();
}
?>
