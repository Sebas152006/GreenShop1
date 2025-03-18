<?php
include '../php/conexion_be.php'; // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']); // Escapa caracteres especiales
    $precio = $_POST['precio'];

    // Construimos la consulta SQL
    $sql = "UPDATE productos SET nombre = '$nombre', descripcion = '$descripcion', precio = '$precio'";

    // Verifica si se subió una nueva imagen
    if (!empty($_FILES['imagen']['tmp_name'])) {
        $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name'])); // Convierte la imagen a binario
        $sql .= ", imagen = '$imagen'";
    }

    $sql .= " WHERE id = $id";

    // Ejecutamos la consulta SQL
    if (mysqli_query($conexion, $sql)) {
        echo '<script>alert("Producto actualizado con éxito."); window.location = "catalogo.php";</script>';
    } else {
        echo '<script>alert("Error al actualizar el producto.");</script>';
    }
}
?>
