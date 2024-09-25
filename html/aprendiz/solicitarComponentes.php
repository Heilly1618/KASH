<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KASH aprendiz</title>
    <link rel="stylesheet" href="../../css/aprendiz/componentes.css">
    <?php
    session_start();

    if (isset($_SESSION['usuario'])) {
        $usuario = $_SESSION['usuario'];
        $IDusuario = $usuario['IDusuario']; // Obtener el ID del usuario
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
                <a href="aprendiz.php" class="link">mi perfil</a>
            </div>
            <div class="selection">
                <img class="icono" src="../../img/componente.png" alt="">
                <a href="solicitarComponentes.php" class="link">solicitar componentes</a>
            </div>
            <div class="selection">
                <img class="icono" src="../../img/asesoria.png" alt="">
                <a href="asesorias.php" class="link">solicitar asesorias</a>
            </div>
            <div class="selection">
                <img class="icono" src="../../img/confirmar.png" alt="">
                <a href="confirmar.php" class="link">confirmacion asesorias</a>
            </div>
            <div class="selection">
                <img class="icono" src="../../img/asistencia.png" alt="">
                <a href="asistencia.php" class="link">asistencia</a>
            </div>
            <div class="selection">
                <img class="icono" src="../../img/prueba.png" alt="">
                <a href="prueba.php" class="link">Pruebas</a>
            </div>
            <div class="cerrar_sesion">
                <button class="btn-cerrar-sesion"><a href="../principal2.html">Cerrar sesión</a></button>
            </div>
        </div>
    
    <div class="cuerpo">
        <header>
            <img class="logo" src="../../img/Logo-removebg-preview (1).png" alt="">
            <p>WELCOME<p>
            <h1>KASH</h1>   
        </header>
        <div class="componente">
            <h1>Seleccione los Componentes</h1>
            <div class="select">
                <form action="../../php/componente.php" method="post">
                    <label for="cantidad-componentes">¿Cuántos componentes desea solicitar para recibir asesoria?</label>
                    <select name="cantidad" id="cantidad-componentes">
                        <option value="">Seleccione una opción</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>

                    <label for="componente-1" id="label-componente-1" style="display:none;">Seleccione el primer componente:</label>
                    <select name="rol1" id="componente-1" style="display:none;">
                        <option value="">Seleccione un componente</option>
                        <option value="Kotlin">Kotlin</option>
                        <option value="Java">Java</option>
                        <option value="MySQL">Base de datos MySQL</option>
                        <option value="NoSQL">Base de datos no relacionales</option>
                        <option value="Python">Python</option>
                        <option value="JavaScript">JavaScript</option>
                        <option value="PHP">PHP</option>
                        <option value="HTML_CSS">HTML y CSS</option>
                        <option value="Algoritmos">Algoritmos</option>
                        <option value="Diagramas">Diagramas</option>
                    </select>

                    <label for="componente-2" id="label-componente-2" style="display:none;">Seleccione el segundo componente:</label>
                    <select name="rol2" id="componente-2" style="display:none;">
                        <option value="">Seleccione un componente</option>
                        <option value="Kotlin">Kotlin</option>
                        <option value="Java">Java</option>
                        <option value="MySQL">Base de datos MySQL</option>
                        <option value="NoSQL">Base de datos no relacionales</option>
                        <option value="Python">Python</option>
                        <option value="JavaScript">JavaScript</option>
                        <option value="PHP">PHP</option>
                        <option value="HTML_CSS">HTML y CSS</option>
                        <option value="Algoritmos">Algoritmos</option>
                        <option value="Diagramas">Diagramas</option>
                    </select>

                    <!-- Botón para enviar el formulario -->
                    <button type="submit">Listo</button>
                </form>
            </div>

            <!-- Texto y botón alineados -->
            <div class="no-componente">
                <p>¿No aparece el componente que buscas?</p>
                <button id="btn-ingresalo">Ingresalo</button>
            </div>
        </div>
    </div>

    <!-- Ventana Modal -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>¿Qué componente buscas?</h2>
            <form id="form-componente" action="../../php/componente.php" method="post">
                <input type="text" id="nuevo-componente" name="nuevo-componente" placeholder="Ingresa el componente" required>
                <button type="submit">Enviar</button>
            </form>
        </div>
    </div>

    <script>
        // Mostrar/ocultar los selects según la cantidad de componentes
        document.getElementById('cantidad-componentes').addEventListener('change', function() {
            var cantidad = this.value;
            var componente1 = document.getElementById('componente-1');
            var componente2 = document.getElementById('componente-2');
            var labelComponente1 = document.getElementById('label-componente-1');
            var labelComponente2 = document.getElementById('label-componente-2');
    
            // Ocultar ambos selects inicialmente
            componente1.style.display = 'none';
            componente2.style.display = 'none';
            labelComponente1.style.display = 'none';
            labelComponente2.style.display = 'none';
    
            if (cantidad == "1") {
                componente1.style.display = 'block';
                labelComponente1.style.display = 'block';
            } else if (cantidad == "2") {
                componente1.style.display = 'block';
                componente2.style.display = 'block';
                labelComponente1.style.display = 'block';
                labelComponente2.style.display = 'block';
            }
        });
    
        // Código para manejar la ventana modal
        var modal = document.getElementById("modal");
        var btnIngresalo = document.getElementById("btn-ingresalo");
        var spanClose = document.getElementsByClassName("close")[0];
    
        btnIngresalo.onclick = function() {
            modal.style.display = "block";
        }
    
        spanClose.onclick = function() {
            modal.style.display = "none";
        }
    
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    
        // Manejar el envío del formulario del modal
        document.getElementById('form-componente').addEventListener('submit', function(e) {
            // e.preventDefault(); // Eliminar esta línea para permitir el envío del formulario
        });
    </script>
    
</body>
</html>
