    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>KASH</title>
        <link rel="stylesheet" href="../css/foro.css">
    </head>
    <body>
        <header>
            <img class="logo" src="../img/Logo-removebg-preview (1).png" alt="Logo de KASH">
            <h1>Foro</h1>
            <h2>KASH</h2>
        </header>

        <button class="btn-flotante" id="btnPQR" aria-label="Registrar PQRS"><img src="../img/icono pqrs.png" alt="Icono PQR"></button>
        <button class="btn-flotante2" id="Forobtn" aria-label="Crear Foro"><img src="../img/Crear-foro.png" alt="Crear Foro"></button>

        <!-- Formulario PQR -->
        <div class="formulario-pqr" id="formPQR" role="dialog" aria-labelledby="pqrHeader" aria-hidden="true">
            <div class="formulario-pqr-header">
                <img src="../img/icono pqrs.png" alt="Icono PQR">
                <h4 id="pqrHeader">Registrar PQRS</h4>
            </div>
            <form action="../php/registrarPQR.php" method="post">
                <label for="nombre">Nombre de usuario:</label>
                <input type="text" id="nombre" name="nombre" required>
                <label for="num_documento">Número de documento:</label>
                <input type="text" id="num_documento" name="num_documento" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required>
                <label for="tipo">Tipo:</label>
                <input type="text" id="tipo" name="tipo" list="list" required>
                <datalist id="list">
                    <option value="Pregunta"></option>
                    <option value="Queja"></option>
                    <option value="Reclamo"></option>
                    <option value="Otra"></option>
                </datalist>
                <label for="detalles">Detalles:</label>
                <textarea id="detalles" name="detalles" rows="4" required></textarea>
                <div class="button-container">
                    <button type="submit">Enviar</button>
                    <button type="button" id="cerrarPQR">Cerrar</button>
                </div>
            </form>
        </div>
        
        <div id="loginModal" class="modal" role="dialog" aria-labelledby="loginHeader" aria-hidden="true"> 
            <div class="modal-content">
                <span class="close" aria-label="Cerrar modal">&times;</span>
                <h2 id="loginHeader">Inicia sesión para crear un foro</h2>
                <form action="../php/ingresoForo.php" method="post" class="formulario">
                    <label for="usuario">Usuario:</label>
                    <input type="text" id="usuario" name="usuario" placeholder="Ingrese el usuario" required>
                    <label for="pass">Contraseña:</label>
                    <input type="password" id="pass" name="pass" placeholder="Ingrese la contraseña" required>
                    <div class="enlaces">
                        <button class="boton" type="submit">Ingresar</button>
                        <a href="#">Olvidé mi contraseña</a>
                    </div>
                </form>
            </div>
        </div>
        
        <main>
        <?php
            $host = "localhost";
            $user = "root";
            $pass = "";
            $db = "kash";

            $conectar = mysqli_connect($host, $user, $pass, $db);

            if (!$conectar) {
                die("Conexión fallida: " . mysqli_connect_error());
            }

            $sql = "SELECT ID, nombre, tema, contenido FROM foro"; 
            $result = $conectar->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    echo "<div class='foro-item'>";
                    echo "<h3>" . htmlspecialchars($row["tema"]) . "</h3>";
                    echo "<p class='autor-fecha'>Publicado por: " . htmlspecialchars($row["nombre"]) . " | Fecha: " . date('d/m/Y') . "</p>";
                    echo "<p class='contenido'>" . nl2br(htmlspecialchars($row["contenido"])) . "</p>";

                    echo "<div class='calificacion'>"; // Calificación aquí
                    echo "<label>Califica este foro:</label>";
                    echo "<span class='estrellas'>";
                    for ($i = 1; $i <= 5; $i++) {
                        echo "<input type='radio' name='calificacion_" . htmlspecialchars($row['tema']) . "' value='" . $i . "' id='star_" . $i . "_" . htmlspecialchars($row['tema']) . "' onclick='alert(\"Calificado con " . $i . " estrellas\")'>";
                        echo "<label for='star_" . $i . "_" . htmlspecialchars($row['tema']) . "'>★</label>";
                    }
                    echo "</span></div>";

                    echo "<div class='botones-comentarios'>";
                    echo "<button class='btn-ver-comentarios' data-id-foro='" . htmlspecialchars($row['ID']). "'>Ver Comentarios</button>";
                    echo "<button class='btn-comentar' data-id-foro='" . htmlspecialchars($row['ID']) . "' data-tema='" . htmlspecialchars($row['tema']) . "'>Comentar</button>";
                    echo "</div></div>";
                }
            } else {
                echo "<p class='no-foros'>No hay foros disponibles.</p>";
            }

            $conectar->close();
            ?>


            <div id="comentarioModal" class="modal" role="dialog" aria-labelledby="comentarioHeader" aria-hidden="true">
                <div class="modal-content">
                    <span class="close" aria-label="Cerrar modal">&times;</span>
                    <h2 id="comentarioHeader">Comentar</h2>
                    <form id="formComentario" action="../php/comentario.php" method="post">
                    <input type="hidden" name="id_foro" id="idForoComentario" value="ID_DEL_FORO_AQUI"> <!-- Campo oculto con el ID del foro -->
                    <input type="hidden" name="tema" id="temaComentario">
                    
                    <label for="anonimo">¿Quieres hacer el comentario anónimo?</label>
                    <select id="anonimo" name="anonimo">
                        <option value="si">Sí</option>
                        <option value="no">No</option>
                    </select>
                    
                    <div id="usuarioInput" style="display:none;">
                        <label for="nombre">Nombre de usuario:</label>
                        <input type="text" name="nombre" id="nombre" >
                        <label for="pass">Contraseña:</label>
                        <input type="password" name="pass" id="pass" >
                    </div>

                    <textarea name="comentario" rows="4" placeholder="Escribe tu comentario..." required></textarea>
                    <button type="submit">Enviar Comentario</button>
                </form>

                </div>
            </div>

            <div id="comentariosModal" class="modal" role="dialog" aria-labelledby="verComentariosHeader" aria-hidden="true"> 
                <div class="modal-content">
                    <span class="close" aria-label="Cerrar modal">&times;</span>
                    <h2 id="verComentariosHeader">Comentarios</h2>
                    <div id="comentariosContainer"></div>
                </div>
            </div>
            
        </main>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var btnPQR = document.getElementById("btnPQR");
                var formPQR = document.getElementById("formPQR");
                var cerrarPQR = document.getElementById("cerrarPQR");
            
                formPQR.style.display = "none";

                btnPQR.onclick = function() {
                    formPQR.style.display = formPQR.style.display === "none" ? "flex" : "none";
                };

                cerrarPQR.onclick = function() {
                    formPQR.style.display = "none";
                };

                // Modal de login
                var modal = document.getElementById("loginModal");
                var btn = document.getElementById("Forobtn");
                var span = document.getElementsByClassName("close")[0];

                modal.style.display = "none";

                btn.onclick = function() {
                    modal.style.display = "flex";
                };

                span.onclick = function() {
                    modal.style.display = "none";
                };

                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                };

                // Modal de comentario
                var modalComentario = document.getElementById("comentarioModal");
                var spanComentario = document.querySelectorAll(".modal-content .close")[1];
                var btnsComentar = document.querySelectorAll(".btn-comentar");

                modalComentario.style.display = "none";

                btnsComentar.forEach(function(btn) {
                    btn.onclick = function() {
                        document.getElementById("temaComentario").value = this.getAttribute("data-tema");
                        modalComentario.style.display = "flex";
                    };
                });

                spanComentario.onclick = function() {
                    modalComentario.style.display = "none";
                };

                // Modal de ver comentarios
    var modalComentarios = document.getElementById("comentariosModal");
    var spanVerComentarios = document.querySelectorAll(".modal-content .close")[2];
    var btnsVerComentarios = document.querySelectorAll(".btn-ver-comentarios");

    modalComentarios.style.display = "none";

    btnsVerComentarios.forEach(function(btn) {
        btn.onclick = function() {
            var idForo = this.getAttribute("data-id-foro");
            
            // Solicitud AJAX para obtener los comentarios
            fetch(`../php/obtenerComentarios.php?id_foro=${idForo}`)
                .then(response => response.json())
                .then(comentarios => {
                    var comentariosContainer = document.getElementById("comentariosContainer");
                    comentariosContainer.innerHTML = ""; // Limpiar contenido previo

                    if (comentarios.length > 0) {
                        comentarios.forEach(comentario => {
                            comentariosContainer.innerHTML += `<p><strong>${comentario.nombre}</strong>: ${comentario.contenido}</p>`;
                        });
                    } else {
                        comentariosContainer.innerHTML = "<p>No hay comentarios para este foro.</p>";
                    }
                })
                .catch(error => {
                    console.error("Error al obtener comentarios:", error);
                });

            modalComentarios.style.display = "flex";
        };
    });

    spanVerComentarios.onclick = function() {
        modalComentarios.style.display = "none";
    };


                document.getElementById("anonimo").addEventListener("change", function() {
                var usuarioInput = document.getElementById("usuarioInput");
                if (this.value === "no") {
                    usuarioInput.style.display = "block";
                    document.getElementById("nombreComentario").required = true;
                    document.getElementById("passComentario").required = true;
                } else {
                    usuarioInput.style.display = "none";
                    document.getElementById("nombreComentario").required = false;
                    document.getElementById("passComentario").required = false;
                }
            });

            });
            document.querySelectorAll('.btn-comentar').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var tema = this.getAttribute('data-tema');
                var idForo = this.getAttribute('data-id-foro'); // Suponiendo que este atributo contenga el ID del foro
                document.getElementById('temaComentario').value = tema;
                document.getElementById('idForoComentario').value = idForo;
                document.getElementById('comentarioModal').style.display = 'flex';
            });
        });

        </script>
    </body>
    </html>
