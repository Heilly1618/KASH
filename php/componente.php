<?php
session_start();

if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    $IDusuario = $usuario['IDusuario'];

    // Conectar a la base de datos
    include('conectUser.php'); // Asegúrate de tener un archivo para la conexión

    // Consulta para contar cuántos componentes tiene el usuario
    $query = "SELECT COUNT(*) as total FROM componente WHERE IDusuario = ?";
    $stmt = $conectar->prepare($query);
    $stmt->bind_param("i", $IDusuario);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    if ($row['total'] >= 2) {
        // Si ya tiene 2 componentes registrados, mostrar mensaje de error
        echo "<script>alert('No puedes registrar más de 2 componentes.');</script>";
        echo "<script>window.location.href = '../html/aprendiz/solicitarComponentes.php';</script>";
        exit();
    }

    // Inserta el primer componente
if (isset($_POST['rol1']) && !empty($_POST['rol1'])) {
    $componente1 = $_POST['rol1'];
    $query1 = "INSERT INTO componente (nombre, IDusuario) VALUES ('$componente1', '$IDusuario')";
    echo "<script>alert('Componente registrado con exito');</script>";
        echo "<script>window.location.href = '../html/aprendiz/solicitarComponentes.php';</script>";
    if (!mysqli_query($conectar, $query1)) {
        echo "Error al insertar el primer componente: " . mysqli_error($conectar);
    }
}

// Inserta el segundo componente
if (isset($_POST['rol2']) && !empty($_POST['rol2'])) {
    $componente2 = $_POST['rol2'];
    $query2 = "INSERT INTO componente (nombre, IDusuario) VALUES ('$componente2', '$IDusuario')";
    echo "<script>alert('Componentes registrados con exito.');</script>";
        echo "<script>window.location.href = '../html/aprendiz/solicitarComponentes.php';</script>";
    if (!mysqli_query($conectar, $query2)) {
        echo "Error al insertar el segundo componente: " . mysqli_error($conectar);
    }
}

// Inserta un nuevo componente desde el modal
if (isset($_POST['nuevo-componente']) && !empty($_POST['nuevo-componente'])) {
    $nuevoComponente = $_POST['nuevo-componente'];
    $query3 = "INSERT INTO componente (nombre, IDusuario) VALUES ('$nuevoComponente', '$IDusuario')";
    echo "<script>alert('Component registrado con exito.');</script>";
        echo "<script>window.location.href = '../html/aprendiz/solicitarComponentes.php';</script>";
    if (!mysqli_query($conectar, $query3)) {
        echo "Error al insertar el nuevo componente: " . mysqli_error($conectar);
    }
}
} else {
    // Si no hay sesión iniciada, redirigir al login
    header("Location: ../principal2.html");
    exit();
}
?>
