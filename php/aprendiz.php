<?php
    require 'conectUser.php';

    $IDusuario = $_SESSION['IDusuario'];
    $_SESSION['IDusuario'] = $fila['IDusuario'];


    $sql = "SELECT usuario FROM usuarios WHERE id = $IDusuario";
    $stmt = $conn->query($sql);

    $row = $stmt->fetch();
    $usuario = $row['usuario'];
?>