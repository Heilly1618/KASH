<?php
require 'conectUser.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = $_POST['name'];
    $firstLastname = $_POST['first_Lastname'];
    $secondLastname = $_POST['second_Lastname'];
    $dateOfBirth = $_POST['date_of_birth'];
    $tipoDocumento = $_POST['Tipo_Documento'];
    $numeroDocumento = $_POST['Numero_Documento'];
    $trimestre = $_POST['Trimestre'];
    $rolSeleccionado = $_POST['rolSeleccionado'];
    $correo = $_POST['correo'];
    $numero = $_POST["numero_telefonico"];
    $usuario = $_POST["usuario"];
    $pass = $_POST["contraseña"];

    $insertarUsuario = "INSERT INTO usuarios (IDusuario, rol, nombres, primerA, segundoA, fnacimiento, tdocumento, trimestre , correo, numero, usuario, pass )
        VALUES ('$numeroDocumento', '$rolSeleccionado','$name', '$firstLastname', '$secondLastname', '$dateOfBirth', '$tipoDocumento', '$trimestre', '$correo','$numero','$usuario','$pass')";

    $queryUsuario = mysqli_query($conectar, $insertarUsuario);

    if ($queryUsuario) {
        
        if ($rolSeleccionado == 'asesor') {
            $insertarAsesor = "INSERT INTO asesor (ID, IDusuario, rol)
                VALUES ('$numeroDocumento','$numeroDocumento' ,'$rolSeleccionado' )";
            mysqli_query($conectar, $insertarAsesor);
        } elseif ($rolSeleccionado == 'aprendiz') {
            $insertarAprendiz = "INSERT INTO aprendiz (ID, IDusuario, rol)
                VALUES ('$numeroDocumento','$numeroDocumento' ,'$rolSeleccionado' )";
            mysqli_query($conectar, $insertarAprendiz);
        }

        
        echo "<script>
            alert('Registro exitoso');
            window.location.href = '../html/principal2.html';
        </script>";
    } else {
        echo "Error al registrar el usuario.";
    }
} else {
    echo "No se han enviado datos";
}

mysqli_close($conectar);
?>
