<?php 
require 'conectUser.php';

$usuario = $_POST['usuario'];
$pass = $_POST['pass'];

session_start();

// Escapar las entradas para evitar inyecciones SQL
$usuario = mysqli_real_escape_string($conectar, $usuario);
$pass = mysqli_real_escape_string($conectar, $pass);

// Consulta para usuarios
$consultaUsuario = "SELECT * FROM usuarios WHERE usuario='$usuario' AND pass='$pass'";
$resultadoUsuario = mysqli_query($conectar, $consultaUsuario);

if (mysqli_num_rows($resultadoUsuario) > 0) {
    // Obtener los datos del usuario
    $fila = mysqli_fetch_assoc($resultadoUsuario); 

    // Guardar todos los datos del usuario en la sesión
    $_SESSION['usuario'] = [
        'usuario' => $fila['usuario'],
        'tdocumento' => $fila['tdocumento'],
        'IDusuario' => $fila['IDusuario'],
        'rol' => $fila['rol'],
        'trimestre' => $fila['trimestre'],
        'correo' => $fila['correo'],
        'numero' => $fila['numero']
    ];

    // Redirigir según el rol del usuario
    if ($fila['rol'] == 'asesor') {
        header("location:../html/asesor/asesor.php");
    } else if ($fila['rol'] == 'aprendiz') {
        header("location:../html/aprendiz/aprendiz.php");
    } else {
        echo "Rol no reconocido.";
    }
} else {
    // Si no es un usuario normal, verificamos si es coordinador
    $consultaCoordinador = "SELECT * FROM coordinador WHERE usuario='$usuario' AND pass='$pass'";
    $resultadoCoordinador = mysqli_query($conectar, $consultaCoordinador);

    if (mysqli_num_rows($resultadoCoordinador) > 0) {
        // Obtener los datos del coordinador
        $fila = mysqli_fetch_assoc($resultadoCoordinador);

        // Guardar los datos del coordinador en la sesión
        $_SESSION['coordinador'] = [
            'usuario' => $fila['usuario'],
            'IDcoordinador' => $fila['ID'],
            'correo' => $fila['correo'],
            // Puedes agregar otros campos relevantes
        ];

        // Redirigir al coordinador
        header("location:../html/coordinador/coordinador.php");
    } else {
        // Si no se encuentra el usuario en ambas tablas
        echo "<script>
                alert('Usuario o contraseña incorrectos');
                window.location.href = '../html/principal2.html';  
              </script>";
    }
}

mysqli_free_result($resultadoUsuario);
mysqli_free_result($resultadoCoordinador);
mysqli_close($conectar);
?>