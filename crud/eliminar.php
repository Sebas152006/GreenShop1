<?php
include '../php/conexion_be.php'; // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['txtId'];

    // Consulta SQL para eliminar el producto
    $sql = "DELETE FROM usuarios WHERE id = $id";

    // Ejecutamos la consulta
    if (mysqli_query($conexion, $sql)) {
        echo '<script>alert("Usuario eliminado con éxito."); window.location = "control_Usuarios.php";</script>';
    } else {
        echo '<script>alert("Error al eliminar el usuario."); window.location = "control_Usuarios.php";</script>';
    }
}
?>
