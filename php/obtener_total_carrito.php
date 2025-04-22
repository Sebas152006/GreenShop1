<?php
    session_start();
    include 'conexion_be.php';

    if (!isset($_SESSION['usuario'])) {
        echo json_encode(["total" => 0]);
        exit;
    }

    $correo = $_SESSION['usuario'];
    $query = "SELECT id FROM usuarios WHERE correo_electronico = '$correo'";
    $result = mysqli_query($conexion, $query);
    $datos = mysqli_fetch_assoc($result);
    $id_usuario = $datos['id'];

    // SUMAR TODAS LAS CANTIDADES (no solo contar filas)
    $sql = "SELECT SUM(cantidad) as total FROM carrito_compras WHERE usuario_id = $id_usuario";
    $res = mysqli_query($conexion, $sql);
    $row = mysqli_fetch_assoc($res);

    echo json_encode(["total" => $row['total'] ?? 0]);
?>
