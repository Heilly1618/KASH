<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
    <link rel="stylesheet" href="../css/contraseña.css"></link>
</head>
<body>
        <header>
            <div class="logo">
                <img src="../img/logo kash.png" alt="">
                <h1>KASH</h1>
            </div>
        </header>

        <form action="../php/recuperar.php" method="POST">
        <h2>Recuperar Contraseña</h2>

            <label for="email">Ingresa tu correo electrónico:</label><br>
            <input type="email" id="email" name="email" required><br><br>
            <button type="submit">Recuperar Contraseña</button>
        </form>
</body>
</html>