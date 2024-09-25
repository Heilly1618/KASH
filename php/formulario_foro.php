<?php
require 'conectUser.php'; 

$nombre = $_POST["nombre_completo"];
$fecha = $_POST["fecha"];
$trimestre = $_POST["trimestre"];
$tema = $_POST["tema"];
$contenido = $_POST["contenido"];

session_start(); 
$usuario = $_SESSION['usuario']; 


$consulta_rol = "SELECT rol, IDusuario FROM usuarios WHERE usuario = '$usuario'";
$resultado = mysqli_query($conectar, $consulta_rol);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    $fila = mysqli_fetch_assoc($resultado);
    $rol = $fila['rol'];
    $IDusuario = $fila['IDusuario'];  // Obtener el IDusuario del usuario logueado

    // Verificar si el usuario es un asesor
    if ($rol === 'asesor') {
        // Insertar el registro en la tabla foro con el IDusuario
        $insertar = "INSERT INTO foro (IDusuario, nombre, fecha, trimestre, tema, contenido)
        VALUES ('$IDusuario', '$nombre', '$fecha', '$trimestre', '$tema', '$contenido')";

        if (mysqli_query($conectar, $insertar)) {
            echo "<script>
                    alert('Foro registrado con exito');
                    window.location.href = '../html/foro.php';  
                  </script>";
        } else {
            echo "Error al insertar el registro en la tabla foro: " . mysqli_error($conectar);
        }
    } else {
        echo "No tienes permiso para realizar esta acción.";
    }
} else {
    echo "Error al verificar el rol del usuario.";
}

mysqli_close($conectar);
?>
