<?php
    require 'conectUser.php'; 

    
    $nombre = $_POST['nombre'];
    $numDocumento = $_POST['num_documento'];
    $email = $_POST['email'];
    $fecha = $_POST['fecha'];
    $tipo = $_POST['tipo'];
    $detalles = $_POST['detalles'];

    session_start();
    $_SESSION['IDusuario'] = $numDocumento; 

    $consultaUsuario = "SELECT IDusuario FROM usuarios WHERE IDusuario = '$numDocumento'";
    $resultadoUsuario = mysqli_query($conectar, $consultaUsuario);

    if (mysqli_num_rows($resultadoUsuario) > 0) {
       
        $consultaCoordinador = "SELECT ID FROM coordinador LIMIT 1"; 
        $resultadoCoordinador = mysqli_query($conectar, $consultaCoordinador);

        if (mysqli_num_rows($resultadoCoordinador) > 0) {
            $filaCoordinador = mysqli_fetch_assoc($resultadoCoordinador);
            $IDcoordinador = $filaCoordinador['ID']; 
            $insertar = "INSERT INTO pqrs (IDusuario, IDcoordinador, nombre, email, fecha, tipo, detalles)
                         VALUES ('$numDocumento', '$IDcoordinador', '$nombre', '$email', '$fecha', '$tipo', '$detalles')";

           
            if (mysqli_query($conectar, $insertar)) {
                echo "<script>
                        alert('PQRS registrada con exito');
                        window.location.href = '../html/foro.html';
                     </script>";
            } else {
                echo "Error al registrar la PQRS: " . mysqli_error($conectar);
            }
        } else {
            echo "No se encontró ningún coordinador.";
        }
    } else {
        echo "<script>
                alert('El usuario no está registrado');
                window.location.href = '../html/foro.html';
             </script>";
    }

    mysqli_close($conectar); 
?>
