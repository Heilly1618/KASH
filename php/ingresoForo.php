<?php 
    require 'conectUser.php';

    $usuario = $_POST['usuario'];
    $pass = $_POST['pass'];

    session_start();
    $_SESSION['usuario'] = $usuario;

    $consulta = "SELECT * FROM usuarios WHERE usuario='$usuario' AND pass='$pass'";
    $resultado = mysqli_query($conectar, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado); 

        // Si el usuario es asesor, redirigir a la página de creación de foros
        if ($fila['rol'] == 'asesor') {
            header("location:../html/formulario_foro.html");

        } else if ($fila['rol'] == 'aprendiz') {
            echo "<script>
                    alert('No puedes crear un foro si no eres un asesor');
                    window.location.href = '../html/foro.html';  
                  </script>";

        } else {
            echo "Rol no reconocido.";
        }
    } else {
        echo "<script>
                alert('No eres un usuario registrado');
                window.location.href = '../html/foro.html'; 
              </script>";
    }

    mysqli_free_result($resultado);
    mysqli_close($conectar);
?>
