<?php
include '../php/conexion_be.php'; // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Consulta SQL para eliminar el producto
    $sql = "DELETE FROM productos WHERE id = $id";

    // Ejecutamos la consulta
    if (mysqli_query($conexion, $sql)) {
        echo '<script>alert("Producto eliminado con éxito."); window.location = "productos.php";</script>';
    } else {
        echo '<script>alert("Error al eliminar el producto."); window.location = "productos.php";</script>';
    }
}
?>
