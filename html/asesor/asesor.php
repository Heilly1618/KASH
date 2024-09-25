<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KASH asesor</title>
    <link rel="stylesheet" href="../../css/asesor/asesor.css">
    <?php
                session_start();

                if (isset($_SESSION['usuario'])) {
                    $usuario = $_SESSION['usuario'];
                } else {
                    // Redirigir a la página de inicio si no hay sesión iniciada
                    header("Location: ../principal2.html");
                    exit();
                }
    ?>
</head>
<body>
    <div class="barra">
        <div class="selection">
            <img class="icono" src="../../img/perfil.png" alt="">
            <a href="asesor.php" class="link">mi perfil</a>
        </div>
        <div class="selection">
            <img class="icono" src="../../img/componente.png" alt="">
            <a href="componente.php" class="link">Registrar componentes</a>
        </div>
        <div class="selection">
            <img class="icono" src="../../img/asesoria.png" alt="">
            <a href="asesorias.php" class="link">Solicitud de asesorias</a>
        </div>
        <div class="selection">
            <img class="icono" src="../../img/confirmar.png" alt="">
            <a href="confirmar.php" class="link">Confirmar asesorias</a>
        </div>
        <div class="selection">
            <img class="icono" src="../../img/asistencia.png" alt="">
            <a href="asistencia.php" class="link">Asistencia</a>
        </div>
        <div class="selection">
            <img class="icono" src="../../img/prueba.png" alt="">
            <a href="prueba.php" class="link">Asignar pruebas</a>
        </div>
        <div class="cerrar_sesion">
            <button class="btn-cerrar-sesion"><a href="../principal2.html" >Cerrar sesión</a></button>
        </div>
    </div>
    <div class="cuerpo">
        <header>
            <img class="logo" src="../../img/Logo-removebg-preview (1).png" alt="">
            <p>WELCOME</p>
            <h1>KASH</h1>
        </header>
        <div class="Perfil">
            <div class="Datos">
                <div class="Foto" id="foto-container">
                    <img id="foto-preview" src="" alt="Tu foto">
                    <label class="custom-file-upload">
                        Seleccionar Foto
                        <input type="file" id="foto-input" accept="image/*">
                    </label>
                </div>
                <div class="Datos2">
                                <p><strong>Usuario:</strong> <?php echo htmlspecialchars($usuario['usuario']); ?></p>
                                <p><strong>Tipo de documento:</strong> <?php echo htmlspecialchars($usuario['tdocumento']); ?></p>
                                <p><strong>Número de documento:</strong> <?php echo htmlspecialchars($usuario['IDusuario']); ?></p>
                                <p><strong>Rol:</strong> <?php echo htmlspecialchars($usuario['rol']); ?></p>
                                <p><strong>Trimestre:</strong> <?php echo htmlspecialchars($usuario['trimestre']); ?></p>
                                <p><strong>Correo:</strong> <?php echo htmlspecialchars($usuario['correo']); ?></p>
                                <p><strong>Número de contacto:</strong> <?php echo htmlspecialchars($usuario['numero']); ?></p>
                </div>
            </div>
            <div class="Historial">
                <h3>Hitorial de asesorias: </h3>
            </div>
        </div>
    </div>

</body>
</html>
