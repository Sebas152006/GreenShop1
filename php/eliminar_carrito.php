<?php
    session_start();
    include 'conexion_be.php';

    if (!isset($_SESSION['usuario'])) exit;

    $correo = $_SESSION['usuario'];
    $query = "SELECT id FROM usuarios WHERE correo_electronico = '$correo'";
    $result = mysqli_query($conexion, $query);
    $datos = mysqli_fetch_assoc($result);
    $id_usuario = $datos['id'];

    $data = json_decode(file_get_contents("php://input"), true);
    $producto_id = $data['producto_id'];

    $sql = "DELETE FROM carrito_compras WHERE usuario_id = ? AND producto_id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ii", $id_usuario, $producto_id);
    $stmt->execute();
?>
