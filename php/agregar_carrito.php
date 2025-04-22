<?php
    session_start();
    include 'conexion_be.php';

    if (!isset($_SESSION['usuario'])) {
        echo json_encode(["error" => "Usuario no autenticado"]);
        exit;
    }

    $correo = $_SESSION['usuario'];
    $query = "SELECT id FROM usuarios WHERE correo_electronico = '$correo'";
    $result = mysqli_query($conexion, $query);
    $datos = mysqli_fetch_assoc($result);
    $id_usuario = $datos['id'];

    $data = json_decode(file_get_contents("php://input"), true);
    $producto_id = $data['producto_id'];
    $cantidad = $data['cantidad']; // <- cantidad enviada desde el formulario

    // Revisar si ya existe ese producto en el carrito
    $sql = "SELECT * FROM carrito_compras WHERE usuario_id = ? AND producto_id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ii", $id_usuario, $producto_id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $sql = "UPDATE carrito_compras SET cantidad = cantidad + ? WHERE usuario_id = ? AND producto_id = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("iii", $cantidad, $id_usuario, $producto_id);
        $stmt->execute();
    } else {
        $sql = "INSERT INTO carrito_compras (usuario_id, producto_id, cantidad) VALUES (?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("iii", $id_usuario, $producto_id, $cantidad);
        $stmt->execute();
    }

    echo json_encode(["status" => "ok"]);
?>
